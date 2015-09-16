<?php
/**
* @modifed_by olijen
*/

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Управление',
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
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
Для поиска разрешено использовать следующие операторы: (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>)</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		'password',
		'cash',
		'active_ts',
		'xp',
		/*
		'avatar',
		'status',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
