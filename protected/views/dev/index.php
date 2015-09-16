<?php
/* @var $this DevController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Devs',
);

$this->menu=array(
	array('label'=>'Create Dev', 'url'=>array('create')),
	array('label'=>'Manage Dev', 'url'=>array('admin')),
);
?>

<h1>Devs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
