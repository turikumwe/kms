<?php
/* @var $this DistrictController */
/* @var $model District */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('DistrictID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->DistrictID), array('view', 'id'=>$data->DistrictID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ProvinceID')); ?>:</b>
	<?php echo CHtml::encode($data->ProvinceID); ?>
	<br />


</div>