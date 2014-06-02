<?php
/* @var $this CatController */
/* @var $model ContactCategory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SocialNetworkID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SocialNetworkID), array('view', 'id'=>$data->SocialNetworkID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isSocialNetwork')); ?>:</b>
	<?php echo CHtml::encode($data->isSocialNetwork); ?>
	<br />


</div>