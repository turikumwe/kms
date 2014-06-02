<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Users',
);
$this->renderPartial('../_ToolsMenu', array('active' => 'user', 'userOption'=>false));
?>

<div class="span9">
    <h1>User list</h1>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'LastName', 'header' => 'Names',
                'value' => 'CHtml::link($data->LastName." ".$data->FirstName, Yii::app()
 ->createUrl("/admin/user/view",array("id"=>$data->UserID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '30%')),
            array('name' => 'Phone', 'header' => 'Phone',),
            array('name' => 'Email', 'header' => 'Email',),
            array('name' => 'UserGroupID', 'header' => 'UserGroupID',),
            array('name' => 'Status', 'header' => 'Status',),
        ),
    ));
    ?>

</div>
