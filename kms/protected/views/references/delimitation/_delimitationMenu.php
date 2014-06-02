<?php
$active = $active;
?>
<div class="span2" style="margin-left: 0 !important">  
    <ul class="nav nav-list">  
        <li class="nav-header">Delimitation</li>  
        <li <?php if($active == 'Province'){ echo 'class="active"'; }?> ><a href="<?php echo Yii::app()->createUrl("/references/delimitation/province"); ?>"><i class="icon-home"></i> Provinces</a></li>  
        <li <?php if($active == 'District'){ echo 'class="active"'; }?> ><a href="<?php echo Yii::app()->createUrl("/references/delimitation/district"); ?>"><i class="icon-ok-sign"></i> Districts</a></li>  
        <li <?php if($active == 'Sector'){ echo 'class="active"'; }?> ><a href="<?php echo Yii::app()->createUrl("/references/delimitation/sector"); ?>"><i class="icon-ok-sign"></i> Sectors</a></li>  
        <li <?php if($active == 'Cell'){ echo 'class="active"'; }?> ><a href="<?php echo Yii::app()->createUrl("/references/delimitation/cell"); ?>"><i class="icon-ok-sign"></i> Cells</a></li>  
        <li <?php if($active == 'Village'){ echo 'class="active"'; }?> ><a href="<?php echo Yii::app()->createUrl("/references/delimitation/village"); ?>"><i class="icon-ok-sign"></i> Villages</a></li>
        <li class="divider"></li>  
        <li><a href="#"><i class="icon-book"></i> Help</a></li>  
    </ul> 
</div>