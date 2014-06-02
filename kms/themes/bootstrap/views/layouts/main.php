<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo Yii::app()->name.' - '.CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/application.min.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rbac.css" />
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/datepicker/datetimepicker_css.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom_function.js" ></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/highcharts.js" ></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootbox.min.js" ></script>

        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
        <link rel="apple-touch-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-114x114.png">
    </head>
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="<?php echo Yii::app()->baseUrl; ?>"><?php echo CHtml::encode('KMS'); ?></a>
                    <?php
                    $loggedInUser = Yii::app()->user->id;
                    if (isset($loggedInUser)) {

                        $accesMenues = Menu::getMenuByUser($loggedInUser);
                        $userMenu = array();
                        foreach ($accesMenues as $menu) {
                            if (count(Menu::getMenuByParent($menu['MenuID'])) > 0) {
                                $currentSubMenues = array();
                                $subMenues = Menu::getMenuByParent($menu['MenuID']);
                                foreach ($subMenues as $submenu) {
                                    array_push($currentSubMenues, array('label' => '' . $submenu['Label'] . '', 'url' => array('' . $submenu['URL'] . '')));
                                }
                                array_push($userMenu, array('label' => '' . $menu['Label'] . '', 'url' => array('' . $menu['URL'] . ''), 'items' => $currentSubMenues));
                            } else {
                                if ($menu['ParentID'] == 0) {
                                    array_push($userMenu, array('label' => '' . $menu['Label'] . '', 'url' => array('' . $menu['URL'] . '')));
                                }
                            }
                        }
                        $this->widget('bootstrap.widgets.TbMenu', array(
                            'items' => $userMenu,
                            'htmlOptions' => array(
                                'class' => 'nav',
                            ),
                        ));

                        $this->widget('zii.widgets.TbMenu', array(
                            'items' => array(
                                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::app()->user->name, 'url' => '#', 'items' => array(
                                        array('label' => 'My Profile', 'url' => array('/user/profile')),
                                        array('label' => 'Admin tools', 'url' => array('admin/user/tools'), 'visible'=>  User::isOfGroup("Administrator")),
                                    )),
                                array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest, 'htmlOptions' => array('class' => 'btn'))
                            ),
                            'htmlOptions' => array(
                                'class' => 'nav pull-right',
                            ),
                        ));
                    } else {
                        $this->widget('zii.widgets.CMenu', array(
                            'items' => array(
                                array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => Yii::app()->user->name, 'url' => array('/user/profile'), 'visible' => !Yii::app()->user->isGuest),
                                array('label' => 'Logout', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest, 'htmlOptions' => array('class' => 'btn'))
                            ),
                            'htmlOptions' => array(
                                'class' => 'nav pull-right',
                            ),
                        ));
                    }
                    ?>

                </div>

            </div>
        </div>

        <div class="container">
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('BBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'separator' => ' / ',
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>
        </div>

        <?php echo $content; ?>

        <footer class="footer" style="min-width: 100% !important">
            <div class="container" style="min-width: 100% !important">
                <p>Copyright &copy; <?php echo date('Y'); ?> NCST. All Rights Reserved.<br/>
            </div>
        </footer>

    </body>
</html>