<?php
/* @var $this DcController */
/* @var $model DocumentCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DocumentTypeID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DocumentTypeID), array('view', 'id'=>$data->DocumentTypeID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />


</div>