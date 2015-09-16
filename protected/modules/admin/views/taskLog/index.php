<?php
/* @var $this TaskLogController */
/* @var $model TaskLog */

$this->breadcrumbs=array(
	'Task Logs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TaskLog', 'url'=>array('index')),
	array('label'=>'Create TaskLog', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#task-log-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Task Logs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'task-log-grid',
	'dataProvider'=>$dp,
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'Юзер',
			'value' => '$data->username',
		),
        array(
            'header'=>'Таск',
			'value' => '!empty($data->inProcess->inAsana->name) ?
                $data->inProcess->inAsana->name : "-"',
		),
        array(
            'header'=>'Статус',
            'type'=>'raw',
            'value'=>'!empty($data->inProcess) ?
                $data->inProcess->statusIcon ." &nbsp;&nbsp; ". $data->inProcess->statusLable : "-"',
        ),
        array(
            'header'=>'Потратил времени',
            'value'=>'!empty($data->inProcess) ?
                AsanaApi::convertTsToHours($data->inProcess->timeSpent) : "-"',
        ),
        array(
            'header'=>'Осталось времени',
            'value'=>'!empty($data->inProcess) ?
                AsanaApi::convertTsToHours($data->timeLeft) : "-"',
        ),
        array(
            'header'=>'Дедлайн',
            'value'=>'!empty($data->inProcess) ?
                AsanaApi::convertTimestamp($data->inProcess->deadline) : "-"',
        ),
		/*
		'complate',
		'total',
		'user_id',
		'comment',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
