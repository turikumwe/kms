<?php
/* @var $this CatController */
/* @var $model ContactCategory */

$this->breadcrumbs = array(
    'Contact Categories' => array('index'),
    $model->Name => array('view', 'id' => $model->SocialNetworkID),
    'Update',
);
$this->renderPartial('../_CMenu', array('active' => 'addCat'));
?>
<div class="span6">
    <h1>Update Category </h1>
    <p>
        <?php echo $this->renderPartial('_form', array('model' => $model)); ?>  
    </p>
</div>
