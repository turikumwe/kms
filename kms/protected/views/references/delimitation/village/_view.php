<?php
/* @var $this VillageController */
/* @var $model Village */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('VillageID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->VillageID), array('view', 'id'=>$data->VillageID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CellID')); ?>:</b>
	<?php echo CHtml::encode($data->CellID); ?>
	<br />


</div>