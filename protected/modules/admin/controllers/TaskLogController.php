<?php

class TaskLogController extends Controller
{
    public function actionIndex()
	{
	    $model = new TaskLog('search');
        $model->unsetAttributes();
        $data=array();
		if(isset($_GET['TaskLog']))
			$data=$model->attributes=$_GET['TaskLog'];
            
        $dp = $model->allProcess($data);
		$this->render('index',array(
            'model'=>$model,
            'dp'=>$dp,
		));
	}
    
    public function actionAll()
    {
        $dataProvider=new CActiveDataProvider('TaskLog');
		$this->render('all',array(
			'dataProvider'=>$dataProvider,
		));
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
