<?php
/* @var $this ContactAddressController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contact Addresses',
);

$this->menu=array(
	array('label'=>'Create ContactAddress', 'url'=>array('create')),
	array('label'=>'Manage ContactAddress', 'url'=>array('admin')),
);
?>

<h1>Contact Addresses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
