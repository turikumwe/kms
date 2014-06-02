<?php
/* @var $this DcController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Document Categories',
);
$this->renderPartial('../_DCMenu', array('active' => 'Category'));
?>
<div class="span6">
    <h1>Document Categories</h1>

    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type' => 'striped bordered condensed',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            array('name' => 'DocumentTypeID', 'header' => 'Id', 'htmlOptions' => array('width' => '20%')),
            array('name' => 'Name', 'header' => 'Name'),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
                'template' => '{update}{delete}',
                'buttons' => array(
                    'delete' => array(
                        'visible' => 'DocumentCategory::canBeDeleted($data->DocumentTypeID)',
                    ),
                ),
            ),
        ),
    ));
    ?>
</div>
