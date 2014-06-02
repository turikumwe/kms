
<div class="span2" style="margin-left: 0 !important">  
    <ul class="nav nav-list">  
        <li class="nav-header" >General</li>  
        <li <?php
        if ($active == 'Category') {
            echo 'class="active"';
        }
        ?> ><a href="<?php echo Yii::app()->createUrl("/references/co/ccat/"); ?>"><i class="icon-home"></i> Categories</a></li>  
        <li <?php
        if ($active == 'addCat') {
            echo 'class="active"';
        }
        ?> ><a href="<?php echo Yii::app()->createUrl("/references/co/ccat/create"); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<i class="icon-plus-sign"></i> Create </a></li>
        <li class="divider"></li>  
        <li><a href="#"><i class="icon-book"></i> Help</a></li>  
    </ul> 
</div>