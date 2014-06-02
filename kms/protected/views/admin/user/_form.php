
<div class="row-fluid" style="min-height: 400px;">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'user-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="span5">
        <fieldset>
            <legend>Identification</legend>
            <div class="row">
                <?php echo $form->labelEx($model, 'FirstName'); ?>
                <?php echo $form->textField($model, 'FirstName', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'FirstName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'LastName'); ?>
                <?php echo $form->textField($model, 'LastName', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'LastName'); ?>
            </div>
            <div class="row">
                <?php echo $form->labelEx($model, 'UserName'); ?>
                <?php echo $form->textField($model, 'UserName', array('size' => 20, 'maxlength' => 20)); ?>
                <?php echo $form->error($model, 'UserName'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'Password'); ?>
                <?php echo $form->passwordField($model, 'Password', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'Password'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'PasswordConfirm'); ?>
                <?php echo $form->passwordField($model, 'PasswordConfirm', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'PasswordConfirm'); ?>
            </div>

        </fieldset>
    </div>
    <div class="span3">
        <fieldset>
            <legend>Contacts</legend>

            <div class="row">
                <?php echo $form->labelEx($model, 'Phone'); ?>
                <?php echo $form->textField($model, 'Phone', array('size' => 60, 'maxlength' => 15)); ?>
                <?php echo $form->error($model, 'Phone'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model, 'Email'); ?>
                <?php echo $form->textField($model, 'Email', array('size' => 60, 'maxlength' => 100)); ?>
                <?php echo $form->error($model, 'Email'); ?>
            </div>
        </fieldset>
    </div>
</div>
<div class="form-actions">
    <?php echo BHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>
<?php $this->endWidget(); ?>

