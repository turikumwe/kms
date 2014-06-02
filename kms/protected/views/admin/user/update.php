<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->UserID => array('view', 'id' => $model->UserID),
    'Update',
);

$this->renderPartial('../_ToolsMenu', array('active' => 'editUser', 'userOption' => true, 'id' => $model->UserID, 'user' => $model));
?>
<div class="span9">
    <div style="margin-left: 0px;">
        <h1>User update</h1>
    </div>
            <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="info">
                <div class="alert in alert-block fade alert-success"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('success'); ?></div>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('error')):
            ?>
            <div class="info">
                <div class="alert in alert-block fade alert-error"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('error'); ?></div>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('warning')):
            ?>
            <div class="info">
                <div class="alert in alert-block fade alert-warning"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('warning'); ?></div>
            </div>
        <?php endif; ?>
    <div class="row-fluid" style="min-height: 200px;">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'user-form',
            'enableAjaxValidation' => false,
            'action'=>Yii::app()->createUrl('//admin/user/UpdateInfo'),
        ));
        ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>
        <div class="span5">
            <fieldset>
                <legend>Identification</legend>
                 <?php echo $form->hiddenField($model, 'UserID', array('size' => 45, 'maxlength' => 45)); ?>
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
</div>