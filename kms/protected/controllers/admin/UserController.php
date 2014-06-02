<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/empty';
    public $pageTitle = 'Users';

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        if (User::isOfGroup('Administrator')) {
            //User has right hence we can continue
        } else {
            $this->redirect(array('site/logout'));
        }
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'update', 'AddContact', 'AddDocument', 'Get', 'del',
                    'Tools', 'ChangeStatus', 'ResetPassword', 'Permission', 'UpdateInfo'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['User'])) {
            $userData = $_POST['User'];
            $userData['UserGroupID'] = 3; // Hard corded for by default ordinary user
            $model->setScenario('insert');
            $model->attributes = $userData;
            if ($model->save()) {
                //generate the hashed password
                $model->Password = User::generatePassoword($userData['Password']);
                $model->save(false); //save without validating
                $this->redirect(array('view', 'id' => $model->UserID));
            }
        }


        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdateInfo() {
        try {
            if (isset($_POST['User'])) {
                $model = new User('update');
                $model = User::model()->findByPk($_POST['User']['UserID']);
                $model->setScenario('update');
                $model->attributes = $_POST['User'];
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', '<strong>Details changed</strong>.');
                    $this->redirect(array('view', 'id' => $_POST['User']['UserID']));
                } else {
                    Yii::app()->user->setFlash('error', '<strong>' . CHtml::errorSummary($model) . '</strong>.');
                    $this->redirect(Yii::app()->request->urlReferrer);
                }
            } else {
                Yii::app()->user->setFlash('error', '<strong>Invalid access...</strong>.');
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        } catch (Exception $ex) {
            Yii::app()->user->setFlash('error', '<strong>' . $ex->getMessage() . '</strong>.');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionChangeStatus() {

        try {
            $model = $this->loadModel($_POST['UserID']);
            if ($model->Status == 1) {
                $model->Status = 0;
            } else {
                $model->Status = 1;
            }
            $model->save(false);
            $this->redirect(array('view', 'id' => $model->UserID));
        } catch (Exception $ex) {
            
        }
    }

    public function actionView($id) {
        //user groups
        $userGroups = UserGroup::model()->findAll(array('order' => '	GroupID'));

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'userGroups' => $userGroups,
            'active_tab' => 'none',
        ));
    }


    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->UserID));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    public function actionResetPassword() {
        if (isset($_POST['Password']) && strlen($_POST['PasswordConfirm']) > 4 && $_POST['Password'] == $_POST['PasswordConfirm']) {
            try {
                $user = User::model()->findByPk($_POST['UserID']);
                $user->Password = User::generatePassoword($_POST['Password']);
                $user->save(false); //no other validations required
                Yii::app()->user->setFlash('success', '<strong>Password Changed</strong>.');
                $this->redirect(Yii::app()->request->urlReferrer);
            } catch (Exception $exc) {
                Yii::app()->user->setFlash('error', '<strong>' . $exc->getMessage() . '</strong>.');
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        } else {
            Yii::app()->user->setFlash('error', '<strong>Invalid Password, Please try again(min characters 5)</strong>.');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionPermission() {
        try {
            $user = User::model()->findByPk($_POST['UserID']);
            $user->UserGroupID = $_POST['UserGroupID'];
            $user->save(false); //no other validations required
            Yii::app()->user->setFlash('success', '<strong>User Permission Changed</strong>.');
            $this->redirect(Yii::app()->request->urlReferrer);
        } catch (Exception $exc) {
            Yii::app()->user->setFlash('error', '<strong>An error occured while changing permission</strong>.');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionTools() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Individual('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Individual']))
            $model->attributes = $_GET['Individual'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'individual-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
