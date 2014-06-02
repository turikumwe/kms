<?php
/* @var $this CellController */
/* @var $model Cell */

$this->breadcrumbs=array(
	'Cells'=>array('index'),
	$model->Name=>array('view','id'=>$model->CellID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cell', 'url'=>array('index')),
	array('label'=>'Create Cell', 'url'=>array('create')),
	array('label'=>'View Cell', 'url'=>array('view', 'id'=>$model->CellID)),
	array('label'=>'Manage Cell', 'url'=>array('admin')),
);
?>

<h1>Update Cell <?php echo $model->CellID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>