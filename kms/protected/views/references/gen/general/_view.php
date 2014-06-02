<?php
/* @var $this GeneralController */
/* @var $model Gender */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('GenderID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->GenderID), array('view', 'id'=>$data->GenderID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />


</div>