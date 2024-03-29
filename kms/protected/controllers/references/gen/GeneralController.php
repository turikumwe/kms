<?php

class GeneralController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/empty';
    public $pageTitle = 'General';

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
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'gender', 'civil', 'Updatec'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
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

        if (isset($_POST['Gender'])) {
            $model->attributes = $_POST['Gender'];
            if ($model->save())
                $this->redirect(array('gender'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionUpdatec($id) {
        $this->pageTitle = 'Civil status';
        $model = $this->loadCivilModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Civilstatus'])) {
            $model->attributes = $_POST['Civilstatus'];
            if ($model->save())
                $this->redirect(array('civil'));
        }

        $this->render('updatec', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionGender() {
        $model = new Gender('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Gender']))
            $model->attributes = $_GET['Gender'];

        $this->render('gender', array(
            'model' => $model,
        ));
    }

    public function actionCivil() {
        $this->pageTitle = 'Civil status';
        $model = new Civilstatus('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Civilstatus']))
            $model->attributes = $_GET['Civilstatus'];

        $this->render('civil', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Gender::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadCivilModel($id) {
        $model = Civilstatus::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gender-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
