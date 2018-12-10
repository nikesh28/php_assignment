<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
    'Contact',
);
?>

<h1>Contact Us</h1>

<?php if (Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

<?php else: ?>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>

    <fieldset>

        <?php $form = $this->beginWidget('CActiveForm'); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'name'); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'name'); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'email'); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'email'); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'subject'); ?>
            <div class="controls">
            <?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>
        </div>
            </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'body'); ?>
            <div class="controls">
            <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
        </div>
            </div>

        <?php if (CCaptcha::checkRequirements()): ?>
            <div class="control-group">
                <?php echo $form->labelEx($model, 'verifyCode'); ?>
                <div class="controls">
                    <?php $this->widget('CCaptcha'); ?>
                    <?php echo $form->textField($model, 'verifyCode'); ?>
                </div>
                <div class="hint">Please enter the letters as they are shown in the image above.
                    <br/>Letters are not case-sensitive.</div>
            </div>
        <?php endif; ?>

        <div class="row submit">
            <?php echo CHtml::submitButton('Submit'); ?>
        </div>

        <?php $this->endWidget(); ?>

    </fieldset>

<?php endif; ?>