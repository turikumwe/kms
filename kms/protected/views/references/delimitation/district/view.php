<?php
/* @var $this DistrictController */
/* @var $model District */

$this->breadcrumbs = array(
    'Districts' => array('index'),
    $model->Name,
);
$this->renderPartial('../_delimitationMenu', array('active' => 'District'));
?>
<div class="span9">
    <h1>District Details</h1>

    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'Name',
            array('name' => 'ProvinceID', 'value' => Province::model()->findByPk($model->ProvinceID)->Name),
        ),
    ));
    ?>

    <br />
    <h2><em>District Sectors</em></h2>
    <?php
    $sector = new Sector();
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $sector->searchByDistrictID($model->DistrictID),
        'columns' => array(
            array('name' => 'Name', 'header' => 'Sectort Name', 'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/sector/view",array("id"=>$data->SectorID)))',
                'type' => 'raw'),
            array('name' => 'DistrictID', 'header' => 'District Name', 'value' => 'District::model()->findByPk($data->DistrictID)->Name'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'Yii::app()->createUrl("/references/delimitation/sector/view",array("id"=>$data->DistrictID))', // the PHP expression for generating the URL of the button
                        'imageUrl' => '...', // image URL of the button. If not set or false, a text link is used
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>

