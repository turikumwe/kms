<?php
/* @var $this ContactAddressController */
/* @var $model ContactAddress */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SocialNetworkID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SocialNetworkID), array('view', 'id'=>$data->SocialNetworkID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SocialNetworkTypeID')); ?>:</b>
	<?php echo CHtml::encode($data->SocialNetworkTypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IndividualID')); ?>:</b>
	<?php echo CHtml::encode($data->IndividualID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedOn')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedOn); ?>
	<br />


</div>