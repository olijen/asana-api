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
	'$label'=>array('index'),
	'Создать',
);\n";
?>

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

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
