<?php
/* @var $this DcController */
/* @var $model DocumentCategory */
/* @var $form CActiveForm */
?>

<div class="form" style="margin-left: 30px !important;">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'document-category-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>

    <div class="row" style="margin-left: 0px !important">
        <?php echo $form->labelEx($model, 'Name'); ?>
<?php echo $form->textField($model, 'Name', array('size' => 60, 'maxlength' => 100)); ?>
<?php echo $form->error($model, 'Name'); ?>
    </div>

    <div class="form-actions">
    <?php echo BHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->