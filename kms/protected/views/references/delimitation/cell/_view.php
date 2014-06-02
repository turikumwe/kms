<?php
/* @var $this CellController */
/* @var $model Cell */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CellID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CellID), array('view', 'id'=>$data->CellID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SectorID')); ?>:</b>
	<?php echo CHtml::encode($data->SectorID); ?>
	<br />


</div>