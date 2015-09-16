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
$nameColumn=$this->guessNameColumn($this->tableSchema->columns);
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array('index'),
	\$model->{$nameColumn}=>array('view','id'=>\$model->{$this->tableSchema->primaryKey}),
	'Редактировать',
);\n";
?>
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
        'label'=>'Просмотр',
        'url'=>array('view', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),
        'linkOptions'=>array('class'=>'fa fa-search btn btn-warning'),),
	array(
        'label'=>'Удаление',
        'url'=>'#',
        'linkOptions'=>array(
            'submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),
            'confirm'=>'Are you sure you want to delete this item?',
            'class'=>'fa fa-trash-o btn btn-danger')),
	array(
        'label'=>'Управление',
        'url'=>array('admin'),
        'linkOptions'=>array('class'=>'fa fa-sitemap btn btn-info'),),
);
?>

<?php echo "<?php \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>