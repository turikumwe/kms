<?php
/* @var $this IndividualController */
/* @var $model Individual */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'IndividualID'); ?>
		<?php echo $form->textField($model,'IndividualID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OtherName'); ?>
		<?php echo $form->textField($model,'OtherName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DOB'); ?>
		<?php echo $form->textField($model,'DOB'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PassportNumber'); ?>
		<?php echo $form->textField($model,'PassportNumber',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Phone'); ?>
		<?php echo $form->textField($model,'Phone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CivilStatusID'); ?>
		<?php echo $form->textField($model,'CivilStatusID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'GenderID'); ?>
		<?php echo $form->textField($model,'GenderID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CountryID'); ?>
		<?php echo $form->textField($model,'CountryID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ProvinceID'); ?>
		<?php echo $form->textField($model,'ProvinceID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DistrictID'); ?>
		<?php echo $form->textField($model,'DistrictID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SectorID'); ?>
		<?php echo $form->textField($model,'SectorID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CellID'); ?>
		<?php echo $form->textField($model,'CellID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VillageID'); ?>
		<?php echo $form->textField($model,'VillageID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CreatedOn'); ?>
		<?php echo $form->textField($model,'CreatedOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UserName'); ?>
		<?php echo $form->textField($model,'UserName',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Comment'); ?>
		<?php echo $form->textField($model,'Comment',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NationalID'); ?>
		<?php echo $form->textField($model,'NationalID',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->