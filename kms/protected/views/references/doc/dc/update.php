<?php
/* @var $this DcController */
/* @var $model DocumentCategory */

$this->breadcrumbs = array(
    'Document Categories' => array('index'),
    $model->Name => array('view', 'id' => $model->DocumentTypeID),
    'Update',
);
$this->renderPartial('../_DCMenu', array('active' => 'addCat'));
?>

<div class="span6">
    <h1>Update Document Category </h1>
    <p>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </p>
</div>