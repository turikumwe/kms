<?php
/* @var $this CellController */
/* @var $model Cell */

$this->breadcrumbs=array(
	'Cells'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cell', 'url'=>array('index')),
	array('label'=>'Manage Cell', 'url'=>array('admin')),
);
?>

<h1>Create Cell</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>