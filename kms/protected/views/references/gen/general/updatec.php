<?php
/* @var $this GeneralController */
/* @var $model Gender */

$this->breadcrumbs = array(
    'Genders' => array('index'),
    $model->Name => array('view', 'id' => $model->CivilStatusID),
    'Update',
);
$this->renderPartial('../_genMenu', array('active' => 'Civil'));
?>

<div class="span6">
    <h1>Civil status update</h1>
    <br /><br />
    <?php echo $this->renderPartial('_civilForm', array('model' => $model)); ?>
</div>