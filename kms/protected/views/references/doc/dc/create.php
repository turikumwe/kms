<?php
/* @var $this DcController */
/* @var $model DocumentCategory */

$this->breadcrumbs = array(
    'Document Categories' => array('index'),
    'Create',
);
$this->renderPartial('../_DCMenu', array('active' => 'addCat'));
?>
<div class="span6">
    <h1>Create Document Category</h1>
    <p>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </p>
</div>