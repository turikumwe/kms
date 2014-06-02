<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DocumentID), array('view', 'id'=>$data->DocumentID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IndividualID')); ?>:</b>
	<?php echo CHtml::encode($data->IndividualID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->DocumentTypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentName')); ?>:</b>
	<?php echo CHtml::encode($data->DocumentName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubmitDate')); ?>:</b>
	<?php echo CHtml::encode($data->SubmitDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Path')); ?>:</b>
	<?php echo CHtml::encode($data->Path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Extension')); ?>:</b>
	<?php echo CHtml::encode($data->Extension); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DocFile')); ?>:</b>
	<?php echo CHtml::encode($data->DocFile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocSize')); ?>:</b>
	<?php echo CHtml::encode($data->DocSize); ?>
	<br />

	*/ ?>

</div>