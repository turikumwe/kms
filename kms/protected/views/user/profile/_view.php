<?php
/* @var $this UserController */
/* @var $model User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->UserID), array('view', 'id'=>$data->UserID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserGroupID')); ?>:</b>
	<?php echo CHtml::encode($data->UserGroupID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserName')); ?>:</b>
	<?php echo CHtml::encode($data->UserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Token')); ?>:</b>
	<?php echo CHtml::encode($data->Token); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ResetKey')); ?>:</b>
	<?php echo CHtml::encode($data->ResetKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UpdatedOn')); ?>:</b>
	<?php echo CHtml::encode($data->UpdatedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastLoginOn')); ?>:</b>
	<?php echo CHtml::encode($data->LastLoginOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PasswordResetOn')); ?>:</b>
	<?php echo CHtml::encode($data->PasswordResetOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsLoggedIn')); ?>:</b>
	<?php echo CHtml::encode($data->IsLoggedIn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Status')); ?>:</b>
	<?php echo CHtml::encode($data->Status); ?>
	<br />

	*/ ?>

</div>