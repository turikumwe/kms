<?php
/* @var $this CellController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Cells',
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Cell'));
?>

<div class="span9">
    <h1>Cells</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'Name', 'header' => 'Cell Name',
                'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/cell/view",array("id"=>$data->CellID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '40%')),
            array('name' => 'SectorID', 'header' => 'Sector',
                'value' => 'Sector::model()->findByPk($data->SectorID)->Name', 'filter' => false,
                'type' => 'raw'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
    ?>
</div>
