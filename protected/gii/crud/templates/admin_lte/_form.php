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
?>
<div class="row">

    <div class="col-md-6">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo "<?php echo \$model->isNewRecord ? 'Создать' : 'Сохранить'; ?>\n"; ?></h3>
            </div>
            <div class="box-body">
            
            <div class="form">

            <?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
            	'id'=>'".$this->class2id($this->modelClass)."-form',
            	'enableAjaxValidation'=>false,
            )); ?>\n"; ?>
        
        	<p class="note">Поля с <span class="required">*</span> обязательны.</p>
            
            <?php echo "<?php \$errorSum = \$form->errorSummary(\$model);
                if (!empty(\$errorSum)) :
            ?>\n"; ?>
                <div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo "<?php echo \$errorSum; ?>\n"; ?>
                </div>   
            <?php echo "<? endif ?>\n"; ?> 

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>

                    <?php echo "<?php \$error = \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
                    <div class="form-group<?php echo "<?= !empty(\$error) ? ' has-warning' : '' ?>";?>">
                        <?php echo "<?php if (empty(\$error)) : ?>\n
                                <?php echo ".$this->generateActiveLabel($this->modelClass,$column)."; ?>\n
                            <?php else : ?>\n"; ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo "<?php echo \$error ?>\n" ; ?>
                                </label>
                            <?php echo "<?php endif ?>\n"; ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column,'form-control')."; ?>\n"; ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

<?php
}
?>
            </div><!-- /.box-body -->
            <div class="box-footer">
        		<?php echo "<?php echo CHtml::submitButton(\$model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-success')); ?>\n"; ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>
<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->