<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Profile' => array('index'),
    $model->UserName,
);
$this->renderPartial('_UserMenu', array('active' => 'none', 'userOption' => true, 'id' => $model->UserID, 'user' => $model));
?>
<div class="span9">
    <h1 style="text-align: center;">Profile details</h1>
    <?php echo CHtml::errorSummary($model); ?>

    <div class="well" style="min-height: 350px;">
        <ul class="nav nav-tabs" style="width: 100% !important">
            <li class="" style="float: right !important" ><a data-toggle="tab" id="loc" href="#logs">Logs</a></li>
            <li class="active" style="float: right !important" ><a data-toggle="tab" id="ide" href="#identification">Identification</a></li>
        </ul>
        <?php if (Yii::app()->user->hasFlash('success')): ?>
            <div class="info">
                <div class="alert in alert-block fade alert-success"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('success'); ?></div>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('error')):
            ?>
            <div class="info">
                <div class="alert in alert-block fade alert-error"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('error'); ?></div>
            </div>
        <?php endif; ?>
        <?php if (Yii::app()->user->hasFlash('warning')):
            ?>
            <div class="info">
                <div class="alert in alert-block fade alert-warning"><a data-dismiss="alert" class="close">×</a><?php echo Yii::app()->user->getFlash('warning'); ?></div>
            </div>
        <?php endif; ?>
        <div class="tab-content" id="myTabContent">
            <div id="identification" class="tab-pane active">
                <table class="items table table-striped table-bordered table-condensed">
                    <tbody class="detail-data">
                        <tr class="even"><th>Names</th><td><?php echo $model->LastName . ' ' . $model->FirstName; ?></td></tr>
                        <tr class="odd"><th>Username</th><td><?php echo $model->UserName; ?></td></tr>
                        <tr class="even"><th>Email</th><td><?php echo $model->Email; ?></td></tr>
                        <tr class="odd"><th>Phone</th><td><?php echo $model->Phone; ?></td></tr>
                        <tr class="odd"><th>Group</th><td><?php echo UserGroup::getNameById($model->UserGroupID); ?></td></tr>
                        <tr class="odd"><th>Status</th><td><?php
                                if ($model->Status == 1) {
                                    echo 'Enabled';
                                } else {
                                    echo 'Disabled';
                                }
                                ?></td></tr>
                    </tbody>
                </table>                
            </div>
            <div id="logs" class="tab-pane">
                <table class="items table table-striped table-bordered table-condensed">
                    <tbody class="detail-data">
                        <tr class="odd"><th>Updated on</th><td><?php echo date('d-M, Y H:i:s', strtotime($model->UpdatedOn)); ?></td></tr>
                        <tr class="odd"><th>Password reset on</th><td><span class="null"><?php
                                    if (isset($model->PasswordResetOn)) {
                                        echo date('d-M, Y H:i:s', strtotime($model->PasswordResetOn));
                                    } else {
                                        echo 'None';
                                    }
                                    ?></span></td></tr>
                        <tr class="even"><th>Last login</th><td><span class="null"><?php
                                    if (isset($model->LastLoginOn)) {
                                        echo date('d-M, Y H:i:s', strtotime($model->LastLoginOn));
                                    } else {
                                        echo 'None';
                                    }
                                    ?></span></td></tr>
                        <tr class="even"><th>Login status</th><td><span class="null"><?php
                                    if (isset($model->IsLoggedIn) && $model->IsLoggedIn == 1) {
                                        echo 'Logged In';
                                    } else {
                                        echo 'Not Logged In';
                                    };
                                    ?></span></td></tr>
                    </tbody>
                </table>  
            </div>
        </div>
    </div>
</div>
<div id="reset_password" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Change password Password <em></em></h3>
    </div>
    <div class="modal-body">
        <form method="post" action="<?php echo Yii::app()->createUrl("/user/profile/resetPassword") ?>" id="verticalForm" class="well form-vertical" >

            <input type="hidden" name="UserID" value="<?php echo $model->UserID; ?>">
            <label for="current_password">Current password</label><input type="password" id="current" name="CurrentPassword">	
            <label for="new_password">New password</label><input type="password" id="new1" name="Password">	
            <label for="new_password1">Repeat password</label><input type="password" id="new2" name="PasswordConfirm">	
            <hr />
            <input type="submit" class="btn btn-primary" value="Save Password"/>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

        </form>
    </div>
</div>
<div id="change_permission" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Change Permission for<em><?php echo $model->UserName; ?></em></h3>
    </div>
    <div class="modal-body">
        <form method="post" action="<?php echo Yii::app()->createUrl("/admin/user/Permission") ?>" id="verticalForm" class="well form-vertical" >
            <input type="hidden" name="UserID" value="<?php echo $model->UserID; ?>">
            <?php
            if (count($userGroups) > 0) {
                ?>
                <select  id="UserGroupID" name="UserGroupID">
                    <?php
                    foreach ($userGroups as $group) {
                        if ($model->UserGroupID == $group->GroupID) {
                            echo '<option value=' . $group->GroupID . ' selected="selected" >' . $group->Name . '</option>';
                        } else {
                            echo '<option value=' . $group->GroupID . '>' . $group->Name . '</option>';
                        }
                    }
                    ?>
                </select>
                <?php
            }
            ?>
            <hr />
            <input type="submit" class="btn btn-primary" value="Update permission"/>
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

        </form>
    </div>
</div>
<form method="POST" action="<?php echo Yii::app()->createUrl("/admin/user/ChangeStatus") ?>" id="disable_form">
    <input type="hidden" value="<?php echo $model->UserID ?>" name="UserID" />
</form>
<script type="text/javascript">
    $(document).ready(function() {
        $("#<?php echo $active_tab; ?>").trigger("click");
    });
    function confirmDisable() {
        if (confirm("Disable user?")) {
            $("#disable_form").submit();
        }
    }
</script>
<style>
    .detail-data th {
        width: 20%;
    }
</style>

