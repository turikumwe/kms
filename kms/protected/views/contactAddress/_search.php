<?php
/* @var $this ContactAddressController */
/* @var $model ContactAddress */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'SocialNetworkID'); ?>
		<?php echo $form->textField($model,'SocialNetworkID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SocialNetworkTypeID'); ?>
		<?php echo $form->textField($model,'SocialNetworkTypeID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IndividualID'); ?>
		<?php echo $form->textField($model,'IndividualID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatedOn'); ?>
		<?php echo $form->textField($model,'CreatedOn'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->