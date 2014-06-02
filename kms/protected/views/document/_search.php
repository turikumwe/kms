<div class="wide form">

<?php $form=$this->beginWidget('BActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="clearfix">
		<?php echo $form->label($model,'DocumentID'); ?>
		<div class="input">
			<?php echo $form->textField($model,'DocumentID'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'IndividualID'); ?>
		<div class="input">
			<?php echo $form->textField($model,'IndividualID'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'DocumentTypeID'); ?>
		<div class="input">
			<?php echo $form->textField($model,'DocumentTypeID'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'DocumentName'); ?>
		<div class="input">
			<?php echo $form->textField($model,'DocumentName',array('size'=>60,'maxlength'=>100)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'SubmitDate'); ?>
		<div class="input">
			<?php echo $form->textField($model,'SubmitDate'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'Path'); ?>
		<div class="input">
			<?php echo $form->textField($model,'Path',array('size'=>60,'maxlength'=>200)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'Extension'); ?>
		<div class="input">
			<?php echo $form->textField($model,'Extension',array('size'=>10,'maxlength'=>10)); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'DocFile'); ?>
		<div class="input">
			<?php echo $form->textField($model,'DocFile'); ?>
		</div>
	</div>

	<div class="clearfix">
		<?php echo $form->label($model,'DocSize'); ?>
		<div class="input">
			<?php echo $form->textField($model,'DocSize',array('size'=>60,'maxlength'=>255)); ?>
		</div>
	</div>

	<div class="actions">
		<?php echo BHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->