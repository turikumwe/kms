<?php
/* @var $this GeneralController */
/* @var $model Gender */

$this->breadcrumbs = array(
    'Genders' => array('index'),
    $model->Name => array('view', 'id' => $model->GenderID),
    'Update',
);
$this->renderPartial('../_genMenu', array('active' => 'Gender'));
?>

<div class="span6">
    <h1>Gender update</h1>
    <br /><br />
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>