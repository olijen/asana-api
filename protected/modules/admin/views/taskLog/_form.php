<?php
/* @var $this TaskLogController */
/* @var $model TaskLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'task-log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'task_id'); ?>
		<?php echo $form->textField($model,'task_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'task_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start'); ?>
		<?php echo $form->textField($model,'start'); ?>
		<?php echo $form->error($model,'start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stop'); ?>
		<?php echo $form->textField($model,'stop'); ?>
		<?php echo $form->error($model,'stop'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'stop_total'); ?>
		<?php echo $form->textField($model,'stop_total'); ?>
		<?php echo $form->error($model,'stop_total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deadline'); ?>
		<?php echo $form->textField($model,'deadline'); ?>
		<?php echo $form->error($model,'deadline'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'complate'); ?>
		<?php echo $form->textField($model,'complate'); ?>
		<?php echo $form->error($model,'complate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'total'); ?>
		<?php echo $form->textField($model,'total'); ?>
		<?php echo $form->error($model,'total'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->