<?php
/* @var $this ProvinceController */
/* @var $model Province */

$this->breadcrumbs=array(
	'Provinces'=>array('index'),
	$model->Name=>array('view','id'=>$model->ProvinceID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Province', 'url'=>array('index')),
	array('label'=>'Create Province', 'url'=>array('create')),
	array('label'=>'View Province', 'url'=>array('view', 'id'=>$model->ProvinceID)),
	array('label'=>'Manage Province', 'url'=>array('admin')),
);
?>

<h1>Update Province <?php echo $model->ProvinceID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>