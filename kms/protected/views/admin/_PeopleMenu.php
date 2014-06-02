
<div class="span2" style="margin-left: 0 !important">  
    <ul class="nav nav-list">  
        <li class="nav-header" >People</li>  
        <li <?php
        if ($active == 'People') {
            echo 'class="active"';
        }
        ?> ><a href="<?php echo Yii::app()->createUrl("/admin/people"); ?>"><i class="icon-user"></i> Individuals</a></li>  
        <li <?php
        if ($active == 'addPeople') {
            echo 'class="active"';
        }
        ?> >
            <a href="<?php echo Yii::app()->createUrl("/admin/people/create"); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="icon-plus-sign"></i> Create </a>
        </li>
        <?php
        if (User::isOfGroup('Administrator') && $editAction) {
            ?>
            <li <?php
            if ($active == 'editPeople') {
                echo 'class="active"';
            }
            ?>>
                <a href="<?php echo Yii::app()->createUrl("/admin/people/update/id/".$id); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-pencil"></i> Update </a>
            </li>
        <?php } ?>
        <li class="divider"></li>  
        <li><a href="#"><i class="icon-book"></i> Help</a></li>  
    </ul> 
</div>