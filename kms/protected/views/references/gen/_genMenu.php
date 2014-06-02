<?php
$active = $active;
?>
<div class="span2" style="margin-left: 0 !important">  
    <ul class="nav nav-list">  
        <li class="nav-header" >General</li>  
        <li <?php if ($active == 'Gender') {
    echo 'class="active"';
} ?> ><a href="<?php echo Yii::app()->createUrl("/references/gen/general/gender"); ?>"><i class="icon-home"></i> Gender</a></li>  
        <li <?php if ($active == 'Civil') {
    echo 'class="active"';
} ?> class="dropdown"><a href="<?php echo Yii::app()->createUrl("/references/gen/general/civil"); ?>"><i class="icon-ok-sign"></i> Marital Status</a></li>  
        <li class="divider"></li>  
        <li><a href="#"><i class="icon-book"></i> Help</a></li>  
    </ul> 
</div>