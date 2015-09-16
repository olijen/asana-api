<?php
/**
* @modifed_by olijen
*/

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array(
        'label'=>'Список',
        'url'=>array('index'),
        'linkOptions'=>array('class'=>'fa fa-list-ol btn btn-primary'),),
	array(
        'label'=>'Создание',
        'url'=>array('create'),
        'linkOptions'=>array('class'=>'fa fa-plus btn btn-success')),
	array(
        'label'=>'Изменение',
        'url'=>array('update', 'id'=>$model->id),
        'linkOptions'=>array('class'=>'fa fa-wrench btn btn-warning'),),
	array(
        'label'=>'Удаление',
        'url'=>'#',
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model->id),
            'confirm'=>'Are you sure you want to delete this item?',
            'class'=>'fa fa-trash-o btn btn-danger')),
	array(
        'label'=>'Управление',
        'url'=>array('admin'),
        'linkOptions'=>array('class'=>'fa fa-sitemap btn btn-info'),),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'cash',
		'active_ts',
		'xp',
		'avatar',
		'status',
	),
)); ?>
