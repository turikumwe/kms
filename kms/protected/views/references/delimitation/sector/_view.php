<?php
/* @var $this SectorController */
/* @var $model Sector */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SectorID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SectorID), array('view', 'id'=>$data->SectorID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DistrictID')); ?>:</b>
	<?php echo CHtml::encode($data->DistrictID); ?>
	<br />


</div>