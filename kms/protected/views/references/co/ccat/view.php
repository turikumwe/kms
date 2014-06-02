<?php
/* @var $this CatController */
/* @var $model ContactCategory */

$this->breadcrumbs=array(
	'Contact Categories'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List ContactCategory', 'url'=>array('index')),
	array('label'=>'Create ContactCategory', 'url'=>array('create')),
	array('label'=>'Update ContactCategory', 'url'=>array('update', 'id'=>$model->SocialNetworkID)),
	array('label'=>'Delete ContactCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SocialNetworkID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContactCategory', 'url'=>array('admin')),
);
?>

<h1>View ContactCategory #<?php echo $model->SocialNetworkID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SocialNetworkID',
		'Name',
		'isSocialNetwork',
	),
)); ?>
