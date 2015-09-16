<?php
/* @var $this DevController */
/* @var $model Dev */

$this->breadcrumbs=array(
	'Devs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dev', 'url'=>array('index')),
	array('label'=>'Create Dev', 'url'=>array('create')),
	array('label'=>'View Dev', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Dev', 'url'=>array('admin')),
);
?>

<h1>Update Dev <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>