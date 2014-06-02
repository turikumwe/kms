<?php
/* @var $this ProvinceController */
/* @var $model Province */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ProvinceID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ProvinceID), array('view', 'id'=>$data->ProvinceID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryID')); ?>:</b>
	<?php echo CHtml::encode($data->CountryID); ?>
	<br />


</div>