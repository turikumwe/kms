<?php
/* @var $this ContactAddressController */
/* @var $model ContactAddress */

$this->breadcrumbs=array(
	'Contact Addresses'=>array('index'),
	$model->SocialNetworkID,
);

$this->menu=array(
	array('label'=>'List ContactAddress', 'url'=>array('index')),
	array('label'=>'Create ContactAddress', 'url'=>array('create')),
	array('label'=>'Update ContactAddress', 'url'=>array('update', 'id'=>$model->SocialNetworkID)),
	array('label'=>'Delete ContactAddress', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SocialNetworkID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactAddress', 'url'=>array('admin')),
);
?>

<h1>View ContactAddress #<?php echo $model->SocialNetworkID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SocialNetworkID',
		'SocialNetworkTypeID',
		'IndividualID',
		'Address',
		'CreatedOn',
	),
)); ?>
