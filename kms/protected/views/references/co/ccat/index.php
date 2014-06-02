<?php
/* @var $this CatController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Contact Categories',
);
$this->renderPartial('../_CMenu', array('active' => 'Category'));
?>
<div class="span6">
    <h1>Contact Categories</h1>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'Name', 'header' => 'Category Name',
                'value' => 'CHtml::link($data->Name, Yii::app()
 ->createUrl("/references/co/ccat/view",array("id"=>$data->SocialNetworkID)))',
                'type' => 'raw', 'htmlOptions' => array('width' => '60%')),
            array('name' => 'isSocialNetwork', 'header' => 'Is social network',
                'value' => 'ContactCategory::getContactType($data->SocialNetworkID)', 'filter' => false,
                'type' => 'raw', 'htmlOptions' => array('width' => '30%')),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'delete' => array(
                        'visible' => 'ContactCategory::canBeDeleted($data->SocialNetworkID)',
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>
