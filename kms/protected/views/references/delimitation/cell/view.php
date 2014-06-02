<?php
/* @var $this CellController */
/* @var $model Cell */

$this->breadcrumbs = array(
    'Cells' => array('index'),
    $model->Name,
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Cell'));
?>

<div class="span9">
    <h1>Cell details</h1>

    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'Name',
            array('name' => 'SectorID', 'value' => Sector::model()->findByPk($model->SectorID)->Name),
        ),
    ));
    ?>  
    <br />
    <h2><em>Cell villages</em></h2>
    <?php
    $village = new Village();
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $village->searchByCellID($model->CellID),
        'columns' => array(
            array('name' => 'Name', 'header' => 'Village Name',
                'type' => 'raw'),
            array('name' => 'CellID', 'header' => 'Cell Name', 'value' => 'Cell::model()->findByPk($data->CellID)->Name',),
        ),
    ));
    ?>
</div>

