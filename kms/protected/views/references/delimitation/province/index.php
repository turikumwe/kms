<?php
/* @var $this ProvinceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Provinces',
);
$this->renderPartial('../_delimitationMenu', array('active' => 'Province'));
?>

<div class="span9">
    <h1>Provinces</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'Name', 'header' => 'Province Name',
                'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/province/view",array("id"=>$data->ProvinceID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '40%')),
            array('name' => 'ProvinceID', 'header' => 'Country',
                'value' => 'Country::model()->findByPk($data->CountryID)->Name', 'filter' => false,
                'type' => 'raw'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
    ?>
</div>