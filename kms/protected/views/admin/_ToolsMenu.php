
<div class="span3" style="margin-left: 0 !important">  
    <ul class="nav nav-list">  
        <li class="nav-header" >Administration</li>  
        <li <?php
        if ($active == 'user') {
            echo 'class="active"';
        }
        ?> ><a href="<?php echo Yii::app()->createUrl("/admin/user/index"); ?>"><i class="icon-user"></i> Users</a></li>  
        <li <?php
        if ($active == 'addUser') {
            echo 'class="active"';
        }
        ?> >
            <a href="<?php echo Yii::app()->createUrl("/admin/user/create"); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                <i class="icon-plus-sign"></i> Create </a>
        </li>
        <?php
        if ($userOption) {
            ?>
            <li <?php
            if ($active == 'userEdit') {
                echo 'class="active"';
            }
            ?> >
                <a href="<?php echo Yii::app()->createUrl("/admin/user/update/id/" . $id); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-pencil"></i> Update info </a>
            </li>
            <li>
                <a  href="#reset_password" data-toggle="modal" >&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-cog"></i> Reset password </a>
            </li>
            <li>
                <a href="#change_permission" data-toggle="modal" >&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-cog"></i> Change permission </a>
            </li>
            <li>
                <a href="#" onclick="confirmDisable();">&nbsp;&nbsp;&nbsp;&nbsp;
                     <?php
                    if ($user->Status == 1) {
                        echo '<i class="icon-ban-circle"></i> ';
                        echo 'Disable user';
                    } else {
                        echo '<i class="icon-ok"></i> ';
                        echo 'Enable user';
                    }
                    ?>  </a>
            </li>
        <?php } ?>
        <li class="divider"></li>  
        <li><a href="#"><i class="icon-book"></i> Help</a></li>  
    </ul> 
</div>

