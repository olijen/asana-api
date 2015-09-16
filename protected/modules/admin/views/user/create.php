<?php
/**
* @modifed_by olijen
*/

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Создать',
);

$this->menu=array(
	array(
        'label'=>'Список',
        'url'=>array('index'),
        'linkOptions'=>array('class'=>'fa fa-list-ol btn btn-primary'),),
	array(
        'label'=>'Управление',
        'url'=>array('admin'),
        'linkOptions'=>array('class'=>'fa fa-sitemap btn btn-info'),),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>