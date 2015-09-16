<?php
/**
 * @property integer $id
 * @property integer $task_id
 * @property integer $start
 * @property integer $stop
 * @property integer $stop_total
 * @property integer $complate
 * @property integer $total
 * @property integer $user_id
 * @property string $comment
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class TaskLog extends CActiveRecord
{  
    protected $t = null;
    
    const STATUS_START     = 0;
    const STATUS_STOP      = 1;
    const STATUS_COMPLATE  = 2;
    const STATUS_DEADLINE  = 3;
    
    public function init()
    {
        $this->t = time();
    }
     
    //---FOR ACTIONS   
    
    public function start()
    {
        if ($this->isNewRecord) {
            $this->start = $this->t;
            $this->user_id = Yii::app()->user->id;
            $this->deadline = AsanaApi::convertToTs($this->inAsana->due_at);
            //echo $this->start . ' - '. $this->t . ' - '. $this->deadline . ' - '. $this->inAsana->due_at;
        } else {
            $this->stop_total = (int)$this->stop_total + $this->t - $this->stop;
            $this->stop = null;
        }
        $this->status = self::STATUS_START;
        if (!$this->save()) {
            $this->errorResponse();
			Yii::app()->end();
        }
    }
    
    public function stop()
    {
        $this->stop = $this->t;
        $this->status = self::STATUS_STOP;
        
        if (!$this->save()) {
            $this->errorResponse();
			Yii::app()->end();
        }
    }
    
    public function complate()
    {
        
        $this->complate = $this->t;
        $this->stop_total = (int)$this->stop_total + $this->t - $this->stop;
        $this->total = $this->t - $this->start + $this->stop_total;
        $this->stop = null;
        $this->status = self::STATUS_COMPLATE;
        
        if (!$this->save()) {
            $this->errorResponse();
			Yii::app()->end();
        }
    }

    //--- BY CRITERIA
    
    public function getProcessToAll()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = '
            complate IS NULL
            GROUP BY user_id
            ORDER BY stop
        ';
        return $this->search($criteria);
    }
    
    public function getProcess($userId)
    {
        return $this->find('
            user_id = '.(int)$userId.' AND
            complate IS NULL
            ORDER BY stop
        ');
    }
    
    //--- TIME
    
    protected $_timeLeft = null;
    public function getTimeLeft()
    {
        if ($this->_timeLeft === null) {
            $this->_timeLeft = $this->deadline - $this->t;
            if ($this->_timeLeft <= 0) $this->_timeIsOver = true;
        }
        return $this->_timeLeft;
    }
    
    protected $_timeSpent = null;
    public function getTimeSpent()
    {
        if ($this->_timeSpent === null) {
            if (!empty($this->stop)) {
                $this->_timeSpent = ($this->stop - $this->start) - (int)$this->stop_total;
            } else {
                //echo $this->t - $this->start.'sec ';
                $this->_timeSpent = $this->t - $this->start - (int)$this->stop_total;
            }
        }
        return $this->_timeSpent;
    }
    
    protected $_timeIsOver = false;
    public function getTimeIsOver()
    {
        $this->getTimeLeft();
        return $this->_timeIsOver;
    }

    protected $_inAsana = null;
    public function getInAsana()
    {
        if ($this->_inAsana === null)
            $this->_inAsana = json_decode(AsanaApi::model()->asana->getTask($this->task_id))->data;
        return $this->_inAsana;
    }
    
    
    
    //--- STATUSES
   
    public function getIsStart()
    {
        return $this->status == self::STATUS_START;
    }
    
    public function getIsStop()
    {
        return $this->status == self::STATUS_STOP;
    }
    
    public function getIsComplate()
    {
        return $this->status == self::STATUS_COMPLATE;
    }
    
    public function getStatusLable()
    {
        if ($this->isStart) return 'В процессе';
        if ($this->isStop) return 'Остановлен';
        if ($this->isComplate) return 'Закрыт';
    }
    
    public function getStatusIcon()
    {
        if ($this->isStart) return '<i class="fa fa-play"></i>';
        if ($this->isStop) return '<i class="fa fa-pause"></i>';
        if ($this->isComplate) return '<i class="fa fa-check"></i>';
    }
    
    //--- service
    public function errorResponse($errorMsg = null)
    {
        if ($errorMsg !== null) {
            echo $errorMsg;
        } elseif (!empty($this->errors)) {
            $data = '';
            foreach ($this->errors as $v) {
                $data = $v; break;
            }  
            echo $data[0];
        } else {
            echo 'Неизвестная ошибка';
        }
        
    }
    
    //--- DEFAULT GENERATE

	public function search($toMarge = null)
	{
        $criteria = new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('start',$this->start);
		$criteria->compare('stop',$this->stop);
		$criteria->compare('stop_total',$this->stop_total);
		$criteria->compare('complate',$this->complate);
		$criteria->compare('total',$this->total);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('deadline',$this->deadline);
        
        if ($toMarge !== null)
            $criteria->mergeWith($toMarge);
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function allProcess($data)
    {
        $criteria=new CDbCriteria;
        
        /*$criteria->compare('id',$this->id);
        $criteria->compare('username',$this->user->username,true);
        $criteria->compare('id',$this->id);
		$criteria->compare('task_id',$this->task_id);
		$criteria->compare('start',$this->start);
		$criteria->compare('stop',$this->stop);
		$criteria->compare('stop_total',$this->stop_total);
		$criteria->compare('complate',$this->complate);
		$criteria->compare('total',$this->total);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('deadline',$this->deadline);*/

        return new CActiveDataProvider('User', array(
            'criteria'=>$criteria,
        ));
    }
    
	public function tableName()
	{
		return 'task_log';
	}

	public function rules()
	{
		return array(
            array('task_id', 'validateInDb'),
            array('task_id', 'validateCheckIsAssignee'),
			array('task_id, user_id', 'required'),
			array('start, stop, stop_total, complate, total, user_id, status', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>255),
			array('id, task_id, start, stop, stop_total, complate, total, user_id, comment, status', 'safe', 'on'=>'search'),
		);
	}
    
    public function validateInDb($attribute, $params)
    {
        $proc = $this->getProcess(Yii::app()->user->id);
        if (!empty($proc) && $proc->task_id == $this->$attribute) return;
        if(!empty($proc) && $proc->isStart)
            $this->addError($attribute, 'Вы уже заняты таском '.$proc->task_id);
    }
    
    public function validateCheckIsAssignee($attribute, $params)
    {return;
        var_dump($this->inAsana);return;
        if(!preg_match($pattern, $this->$attribute))
            $this->addError($attribute, 'Это не твой таск');
    }

	public function relations()
	{
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'task_id' => 'Task',
			'start' => 'Start',
			'stop' => 'Stop',
			'stop_total' => 'Stop Total',
			'complate' => 'Complate',
			'total' => 'Total',
			'user_id' => 'User',
			'comment' => 'Comment',
			'status' => 'Status',
            'deadline' => 'Deadline',
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
