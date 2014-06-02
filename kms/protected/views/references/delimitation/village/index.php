<?php
/* @var $this VillageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Villages',
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Village'));
?>

<div class="span9">
    <h1>Villages</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'Name', 'header' => 'Village Name',
                'type' => 'raw', 'htmlOptions' => array('width' => '40%')),
            array('name' => 'CellID', 'header' => 'Cell',
                'value' => 'Cell::model()->findByPk($data->CellID)->Name', 'filter' => false,
                'type' => 'raw'),
        ),
    ));
    ?>
</div>
