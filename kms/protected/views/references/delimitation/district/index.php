<?php
/* @var $this DistrictController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Districts',
);
?>
<?php
$this->renderPartial('../_delimitationMenu', array('active' => 'District'));
?>
<div class="span9">
    <h1>Districts</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'Name', 'header' => 'District Name',
                'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/delimitation/district/view",array("id"=>$data->DistrictID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '40%')),
            array('name' => 'DistrictID', 'header' => 'Province',
                'value' => 'Province::model()->findByPk($data->ProvinceID)->Name', 'filter' => false,
                'type' => 'raw'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{view}',
            ),
        ),
    ));
    ?>
</div>