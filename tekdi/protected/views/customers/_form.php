<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'customers-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => true,
        ));
?>
<fieldset>
    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'name'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'country', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'country', CHtml::listData(Country::model()->findAll(), 'country_id','country_name'), array('empty' => '----Select Country----')); ?>
            <?php echo $form->error($model, 'country'); ?>
        </div>
    </div>


    <div class="control-group">
        <?php echo $form->labelEx($model, 'email'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'mobile_number'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'mobile_number', array('size' => 12, 'maxlength' => 12)); ?>
            <?php echo $form->error($model, 'mobile_number'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'about_you'); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'about_you', array('rows' => 6, 'cols' => 50)); ?>
            <?php echo $form->error($model, 'about_you'); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'birthday'); ?>
        <div class="controls">
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'Customers[birthday]',
                'value' => $model->birthday,
                //'flat' => true, //remove to hide the datepicker
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'showAnim' => 'slide', //'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
                    'changeMonth' => true,
                    'changeYear' => true,
                    'yearRange' => '1960:2020',
                    'minDate' => '1960-01-01', // minimum date
                    'maxDate' => '2020-12-31', // maximum date
                ),
                'htmlOptions' => array(
                    'style' => ''
                ),
            ));
            ?>
            <?php echo $form->error($model, 'birthday'); ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><?php echo $model->isNewRecord ? 'Create' : 'Save' ?></button>
        <a class="btn" role="button" href="<?php echo $this->createUrl("customers/admin"); ?>">Cancel</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>