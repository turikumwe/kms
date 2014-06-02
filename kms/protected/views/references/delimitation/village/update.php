<?php
/* @var $this VillageController */
/* @var $model Village */

$this->breadcrumbs=array(
	'Villages'=>array('index'),
	$model->Name=>array('view','id'=>$model->VillageID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Village', 'url'=>array('index')),
	array('label'=>'Create Village', 'url'=>array('create')),
	array('label'=>'View Village', 'url'=>array('view', 'id'=>$model->VillageID)),
	array('label'=>'Manage Village', 'url'=>array('admin')),
);
?>

<h1>Update Village <?php echo $model->VillageID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>