<?php
/* @var $this ProvinceController */
/* @var $model Province */

$this->breadcrumbs = array(
    'Provinces' => array('index'),
    $model->Name,
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Province'));
?>
<div class="span9">
    <h1>Province Details</h1>

    <?php
    $this->widget('zii.widgets.CDetailView', array(
        'data' => $model,
        'attributes' => array(
            'Name',
        ),
    ));
    ?>
    <br />
    <h2><em>Province Districts</em></h2>
    <?php
    $distict = new District();
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $distict->searchByProvinceID($model->ProvinceID),
        'columns' => array(
            array('name' => 'Name', 'header' => 'District Name', 'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/district/view",array("id"=>$data->DistrictID)))',
                'type' => 'raw'),
            array('name' => 'ProvinceID', 'header' => 'Province Name', 'value' => 'Province::model()->findByPk($data->ProvinceID)->Name'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
                'buttons' => array(
                    'view' => array(
                        'url' => 'Yii::app()->createUrl("/references/delimitation/district/view",array("id"=>$data->DistrictID))', // the PHP expression for generating the URL of the button
                        'imageUrl' => '...', // image URL of the button. If not set or false, a text link is used
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>
