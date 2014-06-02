<?php
/* @var $this SectorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sectors',
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Sector'));
?>

<div class="span9">
    <h1>Sectors</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'Name', 'header' => 'Sector Name',
                'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/sector/view",array("id"=>$data->SectorID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '40%')),
            array('name' => 'DistrictID', 'header' => 'District',
                'value' => 'District::model()->findByPk($data->DistrictID)->Name', 'filter' => false,
                'type' => 'raw'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
    ?>
</div>
