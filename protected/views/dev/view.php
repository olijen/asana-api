<?php
/* @var $this DevController */
/* @var $model Dev */

$this->breadcrumbs=array(
	'Devs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Dev', 'url'=>array('index')),
	array('label'=>'Create Dev', 'url'=>array('create')),
	array('label'=>'Update Dev', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Dev', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dev', 'url'=>array('admin')),
);
?>

<h1>View Dev #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'install',
	),
)); ?>
