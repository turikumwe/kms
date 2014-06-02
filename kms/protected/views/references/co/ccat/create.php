<?php
/* @var $this CatController */
/* @var $model ContactCategory */

$this->breadcrumbs = array(
    'Contact Categories' => array('index'),
    'Create',
);
$this->renderPartial('../_CMenu', array('active' => 'addCat'));
?>
<div class="span6">
    <h1>Create Category</h1>
    <p>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
    </p>
</div>
