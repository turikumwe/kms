<?php
/* @var $this ContactAddressController */
/* @var $model ContactAddress */

$this->breadcrumbs=array(
	'Contact Addresses'=>array('index'),
	$model->SocialNetworkID=>array('view','id'=>$model->SocialNetworkID),
	'Update',
);

$this->menu=array(
	array('label'=>'List ContactAddress', 'url'=>array('index')),
	array('label'=>'Create ContactAddress', 'url'=>array('create')),
	array('label'=>'View ContactAddress', 'url'=>array('view', 'id'=>$model->SocialNetworkID)),
	array('label'=>'Manage ContactAddress', 'url'=>array('admin')),
);
?>

<h1>Update ContactAddress <?php echo $model->SocialNetworkID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>