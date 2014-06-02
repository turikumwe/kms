<?php
/* @var $this VillageController */
/* @var $model Village */

$this->breadcrumbs=array(
	'Villages'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Village', 'url'=>array('index')),
	array('label'=>'Create Village', 'url'=>array('create')),
	array('label'=>'Update Village', 'url'=>array('update', 'id'=>$model->VillageID)),
	array('label'=>'Delete Village', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->VillageID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Village', 'url'=>array('admin')),
);
?>

<h1>View Village #<?php echo $model->VillageID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'VillageID',
		'Name',
		'CellID',
	),
)); ?>
