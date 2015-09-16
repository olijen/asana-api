<?php
/* @var $this DevController */
/* @var $model Dev */

$this->breadcrumbs=array(
	'Devs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Dev', 'url'=>array('index')),
	array('label'=>'Manage Dev', 'url'=>array('admin')),
);
?>

<h1>Create Dev</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>