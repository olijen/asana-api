<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		$this->setImport(array(
			'application.models.*',
    		'application.components.*',
            'admin.models.*',
			'admin.components.*',
            'application.extensions.bootstrap.components.*',
            'bootstrap.helpers.TbHtml',
		));
        //$this->layoutPath = Yii::getPathOfAlias('admin.views.layouts');
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
		    //$controller->layout = 'admin_lte';
			return true;
		}
		else
			return false;
	}
}
