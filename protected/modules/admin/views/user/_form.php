<?php
/**
* @modifed_by olijen
*/
?>
<div class="row">

    <div class="col-md-6">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title"><?php echo $model->isNewRecord ? 'Создать' : 'Сохранить'; ?>
</h3>
            </div>
            <div class="box-body">
            
            <div class="form">

            <?php $form=$this->beginWidget('CActiveForm', array(
            	'id'=>'user-form',
            	'enableAjaxValidation'=>false,
            )); ?>
        
        	<p class="note">Поля с <span class="required">*</span> обязательны.</p>
            
            <?php $errorSum = $form->errorSummary($model);
                if (!empty($errorSum)) :
            ?>
                <div class="alert alert-warning alert-dismissable">
                    <i class="fa fa-warning"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $errorSum; ?>
                </div>   
            <? endif ?>
 


                    <?php $error = $form->error($model,'username'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'username'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <?php $error = $form->error($model,'password'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'password'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <?php $error = $form->error($model,'cash'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'cash'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->textField($model,'cash'); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <?php $error = $form->error($model,'active_ts'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'active_ts'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->textField($model,'active_ts'); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <?php $error = $form->error($model,'xp'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'xp'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->textField($model,'xp'); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <?php $error = $form->error($model,'avatar'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'avatar'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->textField($model,'avatar',array('size'=>50,'maxlength'=>50)); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <?php $error = $form->error($model,'status'); ?>
                    <div class="form-group<?= !empty($error) ? ' has-warning' : '' ?>">
                        <?php if (empty($error)) : ?>

                                <?php echo $form->labelEx($model,'status'); ?>

                            <?php else : ?>
                                <label class="control-label" for="inputWarning">
                                    <i class="fa fa-warning"></i> <?php echo $error ?>
                                </label>
                            <?php endif ?>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-th-list"></i>
                            </div>
                            <?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->

            </div><!-- /.box-body -->
            <div class="box-footer">
        		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class'=>'btn btn-success')); ?>
            </div>
        </div><!-- /.box -->
    </div>
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->