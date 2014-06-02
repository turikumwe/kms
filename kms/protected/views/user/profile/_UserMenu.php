
<div class="span2" style="margin-left: 0 !important">  
    <ul class="nav nav-list">  
        <li class="nav-header" >User account</li>  
        <li <?php
        if ($active == 'user') {
            echo 'class="active"';
        }
        ?> ><a href="<?php echo Yii::app()->createUrl("/user/profile/index"); ?>"><i class="icon-user"></i> Account</a>
        </li>  
        <?php
        if ($userOption) {
            ?>
            <li <?php
            if ($active == 'userEdit') {
                echo 'class="active"';
            }
            ?> >
                <a href="<?php echo Yii::app()->createUrl("/user/profile/update"); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-pencil"></i> Update account </a>
            </li>
            <li>
                <a  href="#reset_password" data-toggle="modal" >&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-cog"></i> Change password </a>
            </li>
        <?php
        }
        if (User::isARegisteredUser(Yii::app()->user->id)) {
            ?>
            <li class="nav-header" >Profile</li> 
            <li <?php
            if ($active == 'user') {
                echo 'class="active"';
            }
            ?> ><a href="<?php echo Yii::app()->createUrl("/user/profile/view"); ?>"><i class="icon-user"></i> Profile</a>
            </li>  
            <li <?php
            if ($active == 'userEdit') {
                echo 'class="active"';
            }
            ?> >
                <a href="<?php echo Yii::app()->createUrl("/user/profile/up"); ?>">&nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="icon-pencil"></i> Update profile </a>
            </li>
        <?php } ?>
        <li class="divider"></li>  
        <li><a href="#"><i class="icon-book"></i> Help</a></li>  
    </ul> 
</div>

