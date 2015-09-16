<?php

class TaskLogController extends Controller
{
    /*private $_taskLog = null;
    
    public function getTaskLog()
    {
        if ($this->_taskLog === null) {
            $taskId = Yii::app()->request->getParam('id');
            if (empty($taskId))
                throw new CException('Excepted id of task');

            $this->_taskLog = TaskLog::model()->findByAttributes(array('task_id'=>$taskId));

            if (Yii::app()->controller->action->id == 'start' && empty($this->_taskLog)) {
                $this->_taskLog = new TaskLog;
                $this->_taskLog->task_id = $taskId;
                return $this->_taskLog;
            } elseif (empty($this->_taskLog))
                throw new CException('Task is empty');
        }
        return $this->_taskLog;
    }
    */
    public function actionStart($id)
    {
        try {
            $this->asanaApi->start($id);
            $this->taskLog->start();
        } catch(CException $e) {
            echo $e; exit;       
        }
        echo 'Время пошло';
    }
    
    public function actionStop($id)
    {
        try {
            $this->asanaApi->stop($id);
            $this->taskLog->stop();
        } catch(CException $e) {
            echo $e; exit;       
        }
        echo 'Время остановлено';
    }
    
    public function actionComplate($id)
    {
        try {
            $this->asanaApi->complate($id);
            $this->taskLog->complate();
        } catch(CException $e) {
            echo $e; exit;       
        }
        echo 'Таск закрыт';
    }
    
    //--- C R U D
    
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionCreate()
	{
		$model=new TaskLog;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TaskLog']))
		{
			$model->attributes=$_POST['TaskLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TaskLog']))
		{
			$model->attributes=$_POST['TaskLog'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TaskLog');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		$model=new TaskLog('search');
		$model->unsetAttributes();
		if(isset($_GET['TaskLog']))
			$model->attributes=$_GET['TaskLog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function loadModel($id)
	{
		$model=TaskLog::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='task-log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	/*public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow',
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}*/
}
