<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	
    
    public $layout = '//layouts/admin_lte';
	public $menu=array();
	public $breadcrumbs=array();
    
    public function beforeAction($e)
    {
        parent::beforeAction($e);
        $action = $e->controller->action->id;
        if ($action == 'login' || $action == 'registration') return true;
        if (Yii::app()->user->isGuest) 
            $this->redirect('/user/login');
        return true;   
    }
    
    protected $_asanaApi = null;
    public function getAsanaApi()
    {
        if ($this->_asanaApi === null)
            $this->_asanaApi = new AsanaApi;
        return $this->_asanaApi;
    }
    
    private $_taskLog = null;
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
}