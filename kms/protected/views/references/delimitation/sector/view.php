<?php
/* @var $this SectorController */
/* @var $model Sector */

$this->breadcrumbs = array(
    'Sectors' => array('index'),
    $model->Name,
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Sector'));
?>
<div class="span9">
    <h1>Sector details</h1>

    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'Name',
            array('name' => 'DistrictID', 'value' => District::model()->findByPk($model->DistrictID)->Name),
        ),
    ));
    ?>   

    <br />
    <h2><em>Sector cells</em></h2>
    <?php
    $cell = new Cell();
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $cell->searchBySectorID($model->SectorID),
        'columns' => array(
            array('name' => 'Name', 'header' => 'Cell Name', 'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/cell/view",array("id"=>$data->CellID)))',
                'type' => 'raw'),
            array('name' => 'SectorID', 'header' => 'Sector Name', 'value' => 'Sector::model()->findByPk($data->SectorID)->Name',),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'Yii::app()->createUrl("/references/delimitation/cell/view",array("id"=>$data->CellID))', // the PHP expression for generating the URL of the button
                        'imageUrl' => '...', // image URL of the button. If not set or false, a text link is used
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>

