<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
/**
* @modifed_by olijen
*/

<?php
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label',
);\n";
?>

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

<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
