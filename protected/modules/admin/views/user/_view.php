<?php
/**
* @modifed_by olijen
*/
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cash')); ?>:</b>
	<?php echo CHtml::encode($data->cash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active_ts')); ?>:</b>
	<?php echo CHtml::encode($data->active_ts); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('xp')); ?>:</b>
	<?php echo CHtml::encode($data->xp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('avatar')); ?>:</b>
	<?php echo CHtml::encode($data->avatar); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>