<?php

class ProfileController extends Controller {

    var $option;
    public $pageTitle = 'KMS';

    public function __construct($id, $module = null) {

        parent::__construct($id, $module);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        //user groups
        $userGroups = UserGroup::model()->findAll(array('order' => 'GroupID'));

        $this->render('index', array(
            'model' => User::model()->findByPk(Yii::app()->user->id),
            'userGroups' => $userGroups,
            'active_tab' => 'none',
        ));
        $this->render('index', array(
                )
        );
    }

}
