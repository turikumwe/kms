<div class="form">

    <?php
    $form = $this->beginWidget('BActiveForm', array(
        'id' => 'document-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    ));
    ?>

    <?php
    $this->widget('BAlert', array(
        'content' => '<p>Fields with <span class="required">*</span> are required.</p>'
    ));
    ?>

        <?php echo $form->errorSummary($model); ?>

    <div class="<?php echo $form->fieldClass($model, 'IndividualID'); ?>">
            <?php echo $form->labelEx($model, 'IndividualID'); ?>
        <div class="input">
<?php echo $form->textField($model, 'IndividualID'); ?>
<?php echo $form->error($model, 'IndividualID'); ?>
        </div>
    </div>

    <div class="<?php echo $form->fieldClass($model, 'DocumentTypeID'); ?>">
            <?php echo $form->labelEx($model, 'DocumentTypeID'); ?>
        <div class="input">
<?php echo $form->textField($model, 'DocumentTypeID'); ?>
<?php echo $form->error($model, 'DocumentTypeID'); ?>
        </div>
    </div>

    <div class="<?php echo $form->fieldClass($model, 'DocumentName'); ?>">
            <?php echo $form->labelEx($model, 'DocumentName'); ?>
        <div class="input">
<?php echo $form->textField($model, 'DocumentName', array('size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'DocumentName'); ?>
        </div>
    </div>

    <div class="<?php echo $form->fieldClass($model, 'SubmitDate'); ?>">
            <?php echo $form->labelEx($model, 'SubmitDate'); ?>
        <div class="input">
<?php echo $form->textField($model, 'SubmitDate'); ?>
<?php echo $form->error($model, 'SubmitDate'); ?>
        </div>
    </div>

    <div class="<?php echo $form->fieldClass($model, 'DocFile'); ?>">
            <?php echo $form->labelEx($model, 'DocFile'); ?>
        <div class="input">
<?php echo $form->fileField($model, 'DocFile'); ?>
<?php echo $form->error($model, 'DocFile'); ?>
        </div>
    </div>


    <div class="actions">
    <?php echo BHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->