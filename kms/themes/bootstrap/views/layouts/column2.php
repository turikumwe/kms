<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
    <div class="appcontent" style="min-height: 400px;">
        <?php if ($this->pageCaption !== '') : ?>
            <div class="page-header">
                <h1><?php echo $this->page_title; ?></h1>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="span2">
                <h3><?php echo CHtml::encode($this->sidebarCaption); ?></h3>
                <?php
                $this->beginWidget('zii.widgets.CPortlet', array(
                    'title' => 'Operations',
                ));
                $this->widget('bootstrap.widgets.TbMenu', array(
                    'type' => 'list',
                    'items' => $this->menu,
                ));
                $this->endWidget();
                ?>
            </div>
            <div class="span9">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div> <!-- /container -->
<?php $this->endContent(); ?>