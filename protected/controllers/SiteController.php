<?php

class SiteController extends Controller
{   
	public function actionIndex()
	{
        $this->render('index');
	}
    
    public function actionTask($id, $user = null)
    {
        if (!empty($user)) {
            if (!thisUser()->superuser) {
                Yii::app()->user->setFlash('error', 'Only for admin');
                $this->redirect('/site/index');
            }
        } else
            $user = Yii::app()->user->id;
            
        $attr = array(
            'task_id'=>$id
        );
        
        $this->render('task', array(
            'id'=>$id,
            'model'=>TaskLog::model()->findByAttributes($attr)));
    }
    
    public function actionProject($id)
    {
        $this->render('project', array('id'=>$id));
    }
    
    public function actionUpdateRight()
    {
        $this->renderPartial('//site/rightStatus');
    }
    
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}