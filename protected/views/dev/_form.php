<?php
/* @var $this DevController */
/* @var $model Dev */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dev-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'install'); ?>
		<?php echo $form->textArea($model,'install',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'install'); ?>
	</div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'files'); ?>
        <?php $this->widget('CMultiFileUpload', array(
                'name' => 'files',
                'attribute' => 'files',
                'accept' => 'jpeg|jpg|gif|png',
                'duplicate' => 'Duplicate file!',
                'denied' => 'Invalid file type',
                'remove'=>'[x]',
            )); ?>
        <?php echo $form->error($model,'files'); ?>
    </div><hr />
    <div class="row">
        <?php if (!$model->isNewRecord) $this->renderPartial('_files', array('model'=>$model)) ?>
    </div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->