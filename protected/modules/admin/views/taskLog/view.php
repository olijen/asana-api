<?php
/* @var $this TaskLogController */
/* @var $model TaskLog */

$this->breadcrumbs=array(
	'Task Logs'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TaskLog', 'url'=>array('index')),
	array('label'=>'Create TaskLog', 'url'=>array('create')),
	array('label'=>'Update TaskLog', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TaskLog', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TaskLog', 'url'=>array('admin')),
);
?>

<h1>View TaskLog #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'task_id',
		'start',
		'stop',
		'stop_total',
		'deadline',
		'complate',
		'total',
		'user_id',
		'comment',
		'status',
	),
)); ?>
