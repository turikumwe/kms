<?php
/* @var $this GeneralController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Genders',
);

$this->renderPartial('../_genMenu', array('active' => 'Gender'));
?>
<div class="span6">
    <h1>Genders</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'GenderID', 'header' => 'Id', 'htmlOptions' => array('width' => '20%')),
            array('name' => 'Name', 'header' => 'Name'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}',
            ),
        ),
    ));
    ?>
</div>


