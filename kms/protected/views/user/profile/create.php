<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Users' => array('index'),
    'Create',
);
$this->renderPartial('../_ToolsMenu', array('active' => 'addUser', 'userOption'=>false));
?>

<div class="span9">
    <div style="margin-left: 0px;">
        <h1>User form</h1>
    </div>
    <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>