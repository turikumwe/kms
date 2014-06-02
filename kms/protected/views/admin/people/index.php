<?php
/* @var $this IndividualController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Individuals',
);

$this->renderPartial('../_PeopleMenu', array('active' => 'People', 'editAction'=>false));
?>
<div class="span10">
    <h1>Individuals list</h1>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'LastName', 'header' => 'Names',
                'value' => 'CHtml::link($data->LastName." ".$data->FirstName, Yii::app()
 ->createUrl("/admin/people/view",array("id"=>$data->IndividualID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '30%')),
            array('name' => 'NationalID', 'header' => 'NID',),
            array('name' => 'Phone', 'header' => 'Phone',),
            array('name' => 'Email', 'header' => 'Email',),
        ),
    ));
    ?>

</div>
