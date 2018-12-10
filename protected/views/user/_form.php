<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <fieldset>

        <div class="control-group">
            <label class="control-label" for="username">Username *</label>
            <div class="controls">
            <?php echo $form->textField($model,'username',array('class'=>'span3','size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'username'); ?>
            </div> <!-- /controls -->
        </div>

	<div class="control-group">
            <label class="control-label" for="password">Password *</label>
            <div class="controls">
            <input type="hidden" name="User[old_password]" value="<?php echo $model->password; ?>" />
            <?php echo $form->passwordField($model,'password',array('class'=>'span3','size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'password'); ?>
            </div> <!-- /controls -->
        </div>

	<div class="control-group">
            <label class="control-label" for="email">Email *</label>
            <div class="controls">
            <?php echo $form->textField($model,'email',array('class'=>'span3','size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'email'); ?>
            </div> <!-- /controls -->
        </div>

        <div class="control-group">
            <label class="control-label" for="profile">Profile</label>
            <div class="controls">
            <?php echo $form->textArea($model,'profile',array('class'=>'span3','rows'=>6, 'cols'=>50)); ?>
            <?php echo $form->error($model,'profile'); ?>
            </div> <!-- /controls -->
        </div>	

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <button class="btn" type="reset">Cancel</button>
        </div>

        </fieldset>
<?php $this->endWidget(); ?>

