<?php
/* @var $this ContactAddressController */
/* @var $model ContactAddress */

$this->breadcrumbs=array(
	'Contact Addresses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ContactAddress', 'url'=>array('index')),
	array('label'=>'Manage ContactAddress', 'url'=>array('admin')),
);
?>

<h1>Create ContactAddress</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>