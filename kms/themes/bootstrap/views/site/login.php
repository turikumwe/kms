<?php
$this->pageCaption = 'Login';
$this->pageTitle = $this->pageTitle;
$this->pageDescription = "Please provide your login credentials.";
$this->breadcrumbs = array(
    'Login',
);
?>

<p>Please fill out the following form with your login credentials:</p>

<div class="form">
    <?php
    $form = $this->beginWidget('BActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
    ?>

    <?php
    $this->widget('BAlert', array(
        'content' => '<p>Fields with <span class="required">*</span> are required.</p>',
    ));
    ?>

    <div class="<?php echo $form->fieldClass($model, 'username'); ?>">
        <?php echo $form->labelEx($model, 'username'); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username'); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
    </div>

    <div class="<?php echo $form->fieldClass($model, 'password'); ?>">
        <?php echo $form->labelEx($model, 'password'); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password'); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>

<!--    <div class="<?php echo $form->fieldClass($model, 'rememberMe'); ?>">
        <div class="controls">
            <?php echo $form->checkBox($model, 'rememberMe'); ?>
            <?php echo $form->error($model, 'rememberMe'); ?>
        </div>
    </div>-->

    <div class="form-actions">
        <?php echo BHtml::submitButton('Login'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>
