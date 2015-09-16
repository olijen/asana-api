<?php
/**
* @modifed_by olijen
*/

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array(
        'label'=>'Создание',
        'url'=>array('create'),
        'linkOptions'=>array('class'=>'fa fa-plus btn btn-success')),
	array(
        'label'=>'Управление',
        'url'=>array('admin'),
        'linkOptions'=>array('class'=>'fa fa-sitemap btn btn-info'),),
);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
