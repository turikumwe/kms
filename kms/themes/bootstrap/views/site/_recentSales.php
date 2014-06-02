<div id="warehouse_widget">
    <?php
    if (count($recent_sales->getData() > 0)) {
        $this->widget('bootstrap.widgets.TbGridView', array(
            'type' => 'striped bordered condensed',
            'dataProvider' => $recent_sales,
            'template' => "{items}\n{pager}",
            'columns' => array(
                array('name' => 'id',
                    'value' => 'CHtml::link($data->id, Yii::app()->createUrl("/back/sale/view",array("id"=>$data->id)))',
                    'type' => 'raw',
                    'type' => 'raw'),
                'total',
                array('name' => 'date_sale', 'value' => 'date("d-M-Y H:i:s",strtotime($data->date_sale))'),
                array('name' => 'user_id',
                    'value' => 'User::model()->findByPk($data->user_id)->names',
                    'type' => 'raw'),
                array('name' => 'warehouse_id',
                    'value' => 'ucfirst(Warehouse::model()->findByPk($data->warehouse_id)->name)',
                    'type' => 'raw'),
            /*
              'total',
             */
            ),
        ));
        ?>
        <a class="btn btn-success" style="float: right;" href="index.php?r=back/sale/index&wid=<?php echo $wid; ?>">
            <strong>More...</strong>
        </a>
        <?php
    } else {
        echo '<div class="empty_data" id="empty_chart">No sale found!</div>';
    }
    ?>
</div>
<script type="text/javascript">
    $('#recent_loading').hide();
</script>