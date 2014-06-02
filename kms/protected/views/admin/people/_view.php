<?php
/* @var $this IndividualController */
/* @var $model Individual */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('IndividualID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->IndividualID), array('view', 'id'=>$data->IndividualID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OtherName')); ?>:</b>
	<?php echo CHtml::encode($data->OtherName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DOB')); ?>:</b>
	<?php echo CHtml::encode($data->DOB); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PassportNumber')); ?>:</b>
	<?php echo CHtml::encode($data->PassportNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Phone')); ?>:</b>
	<?php echo CHtml::encode($data->Phone); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CivilStatusID')); ?>:</b>
	<?php echo CHtml::encode($data->CivilStatusID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('GenderID')); ?>:</b>
	<?php echo CHtml::encode($data->GenderID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryID')); ?>:</b>
	<?php echo CHtml::encode($data->CountryID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ProvinceID')); ?>:</b>
	<?php echo CHtml::encode($data->ProvinceID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DistrictID')); ?>:</b>
	<?php echo CHtml::encode($data->DistrictID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SectorID')); ?>:</b>
	<?php echo CHtml::encode($data->SectorID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CellID')); ?>:</b>
	<?php echo CHtml::encode($data->CellID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('VillageID')); ?>:</b>
	<?php echo CHtml::encode($data->VillageID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CreatedOn')); ?>:</b>
	<?php echo CHtml::encode($data->CreatedOn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UserName')); ?>:</b>
	<?php echo CHtml::encode($data->UserName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Comment')); ?>:</b>
	<?php echo CHtml::encode($data->Comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NationalID')); ?>:</b>
	<?php echo CHtml::encode($data->NationalID); ?>
	<br />

	*/ ?>

</div>