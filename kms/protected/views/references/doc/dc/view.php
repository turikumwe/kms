<?php
/* @var $this DcController */
/* @var $model DocumentCategory */

$this->breadcrumbs=array(
	'Document Categories'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List DocumentCategory', 'url'=>array('index')),
	array('label'=>'Create DocumentCategory', 'url'=>array('create')),
	array('label'=>'Update DocumentCategory', 'url'=>array('update', 'id'=>$model->DocumentTypeID)),
	array('label'=>'Delete DocumentCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DocumentTypeID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DocumentCategory', 'url'=>array('admin')),
);
?>

<h1>View DocumentCategory #<?php echo $model->DocumentTypeID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DocumentTypeID',
		'Name',
	),
)); ?>
