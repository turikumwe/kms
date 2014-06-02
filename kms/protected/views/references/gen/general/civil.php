<?php
/* @var $this GeneralController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Civil Status',
);

$this->renderPartial('../_genMenu', array('active' => 'Civil'));
?>
<div class="span6">
    <h1>Civil Status</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'CivilStatusID', 'header' => 'Id', 'htmlOptions' => array('width' => '20%')),
            array('name' => 'Name', 'header' => 'Name'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}',
                'buttons' => array(
                    'update' => array(
                        'url' => 'Yii::app()->createUrl("/references/gen/general/updatec",array("id"=>$data->CivilStatusID))', // the PHP expression for generating the URL of the button
                        'imageUrl' => '...', // image URL of the button. If not set or false, a text link is used
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>


