<?php

class ProfileController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/empty';
    public $pageTitle = 'User profile';

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
                    'view', 'ChangeStatus', 'ResetPassword', 'Permission', 'UpdateInfo', 'delCont', 'up'),
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

    public function actionIndex() {
        //user groups
        $userGroups = UserGroup::model()->findAll(array('order' => 'GroupID'));

        $this->render('index', array(
            'model' => User::model()->findByPk(Yii::app()->user->id),
            'userGroups' => $userGroups,
            'active_tab' => 'none',
        ));
    }

    public function actionUpdateInfo() {
        try {
            if (isset($_POST['User'])) {
                $model = User::model()->findByPk($_POST['User']['UserID']);
                $model->setScenario('update');
                $model->attributes = $_POST['User'];
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', '<strong>Profile updated</strong>.');
                    $this->redirect(array('index'));
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

    public function actionUpdate() {
        $model = $this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionResetPassword() {
        if (isset($_POST['CurrentPassword']) && (User::generatePassoword($_POST['CurrentPassword']) == $this->loadModel()->Password)) {
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
        } else {
            Yii::app()->user->setFlash('error', '<strong>Current password not valid</strong>.');
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

    public function actionGet($id) {
        $selectedFile = Document::model()->findByPk($id);
        if ($selectedFile) {
            //check that he is the owner
            $loggedUser = User::model()->findByPk(Yii::app()->user->id);
            try {
                if ($selectedFile->IndividualID == $loggedUser->IndividualID) {
                    $file = $selectedFile->Path;
                    return Yii::app()->getRequest()->sendFile(basename($file), @file_get_contents(Yii::app()->getBasePath() . '/..' . $file));
                } else {
                    throw new CHttpException(400, 'Access denied.');
                }
            } catch (Exception $ex) {
                throw new CHttpException(400, 'No access.');
            }
        }
    }

    public function actionDel($id) {
        $selectedFile = Document::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest) {

            //check that he is the owner
            $loggedUser = User::model()->findByPk(Yii::app()->user->id);
            try {
                if ($selectedFile->IndividualID == $loggedUser->IndividualID) {
                    // we only allow deletion via POST request
                    $selectedFile->delete();
                    try {
                        //delete the file in its directory
                        $filePath = Yii::app()->basePath . $selectedFile->Path;
                        unlink($filePath);
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                        Yii::app()->end();
                    }
                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if (!isset($_GET['ajax']))
                        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : $_POST['returnUrl']);
                }else {
                    throw new CHttpException(400, 'Access denied.');
                }
            } catch (Exception $ex) {
                throw new CHttpException(400, 'No access.');
            }
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDelCont($id) {
        $selectedContact = ContactAddress::model()->findByPk($id);

        $loggedUser = User::model()->findByPk(Yii::app()->user->id);
        try {
            if ($selectedContact->IndividualID == $loggedUser->IndividualID) {
                try {
                    //delete contact
                    $selectedContact->delete();
                    $this->redirect(array('view', 'a' => 'con'));
                } catch (Exception $ex) {
                    throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
                }
            } else {
                throw new CHttpException(404, 'Access denied.');
            }
        } catch (Exception $ex) {
            throw new CHttpException(404, 'No access.');
        }
    }

    public function actionAddDocument() {
        $model = new Document;

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);
        $path = Yii::app()->basePath . Yii::app()->params->docs_folder;

        if (!is_dir($path)) {
            mkdir($path);
        }
        if (isset($_POST['Document'])) {
            $submittedData = $_POST['Document'];
            try {

                $model->attributes = $_POST['Document'];
                if ($model->validate()) {

                    if (isset($_POST['Document']['DocFile'])) {
                        $model->DocFile = $_POST['Document']['DocFile'];
                        if ($model->validate(array('DocFile'))) {
                            $model->DocFile = CUploadedFile::getInstance($model, 'DocFile');
                        } else {
                            $model->DocFile = '';
                        }

                        $model->DocSize = $model->DocFile->size;
                        $model->DocumentName = substr_replace($model->DocFile->getName(), '', strrpos($model->DocFile->getName(), '.' . $model->DocFile->extensionName), strlen($model->DocFile->getName()));
                        $model->Extension = $model->DocFile->extensionName;

                        $model->DocFile->saveAs($path . '/' . time() . '_' . str_replace(' ', '_', strtolower($model->DocFile)));
                    }

                    $model->DocFile = time() . '_' . str_replace(' ', '_', strtolower($model->DocFile));
                    $model->Path = Yii::app()->params->docs_folder . Document::getPathSeparator() . $model->DocFile;
                    try {
                        if ($model->save()) {
                            Yii::app()->user->setFlash('success', '<strong>Document uploaded successfully</strong><br />');
                            $this->redirect(array('view', 'a' => 'doc'));
                        } else {
                            Yii::app()->user->setFlash('error', '<strong>Upload error Please contact the support</strong><br />');
                            $this->redirect(array('view', 'a' => 'doc'));
                        }
                    } catch (Exception $ex) {
                        if ($ex->getCode() == 23000) {//Constraint Violation
                            Yii::app()->user->setFlash('error', '<strong>An error Occured</strong><br />You are probably trying to upload an existing document');
                            $this->redirect(array('view', 'a' => 'doc'));
                        } else {
                            Yii::app()->user->setFlash('error', '<strong>An error Occured</strong><br />Please contact the support');
                            $this->redirect(array('view', 'a' => 'doc'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('error', CHtml::errorSummary($model));
                    $this->redirect(array('view', 'a' => 'doc'));
                }
            } catch (Exception $ex) {
                Yii::app()->user->setFlash('error', $ex->getMessage());
                $this->redirect(array('view', 'a' => 'doc'));
            }
        }
    }

    public function actionUp() {
        if (User::isARegisteredUser(Yii::app()->user->id)) {
            //Countries
            $countries = Country::model()->findAll(array('order' => 'Name'));
            $countyList = CHtml::listData($countries, 'CountryID', 'Name');

            //Rwandan provinces
            $Provinces = Province::model()->findAll(array('condition' => 'CountryID = 184')); // Hardcoded for Rwandan country with this id (184)
            $provinceList = CHtml::listData($Provinces, 'ProvinceID', 'Name');

            //gender
            $gender = Gender::model()->findAll();
            $genderList = CHtml::listData($gender, 'GenderID', 'Name');

            //civil statuses
            $statuses = Civilstatus::model()->findAll(array('order' => 'CivilStatusID'));
            $statusList = CHtml::listData($statuses, 'CivilStatusID', 'Name');

            $model = $this->loadModel();
            $model = Individual::model()->findByPk($model->IndividualID);

            //current district
            $district = District::model()->findByPk($model->DistrictID);
            if ($district) {
                $currentDistrict = array($district->DistrictID => '' . $district->Name . '');
            } else {
                $currentDistrict = array();
            }
            //current sector
            $sector = Sector::model()->findByPk($model->SectorID);
            if ($sector) {
                $currentSector = array($sector->SectorID => '' . $sector->Name . '');
            } else {
                $currentSector = array();
            }
            //current cell
            $cell = Cell::model()->findByPk($model->CellID);
            if ($cell) {
                $currentCell = array($cell->CellID => '' . $cell->Name . '');
            } else {
                $currentCell = array();
            }
            //current village
            $village = Village::model()->findByPk($model->VillageID);
            if ($village) {
                $currentVillage = array($village->VillageID => '' . $village->Name . '');
            } else {
                $currentVillage = array();
            }
            if (isset($_POST['Individual'])) {
                $model->attributes = $_POST['Individual'];
                if ($model->save())
                    $this->redirect(array('view'));
            }
            $selectedCountry = $model->CountryID;
            $this->render('up', array(
                'model' => $model,
                'selectedCountry' => $selectedCountry,
                'countryList' => $countyList,
                'provinceList' => $provinceList,
                'currentDistrict' => $currentDistrict,
                'currentSector' => $currentSector,
                'currentCell' => $currentCell,
                'currentVillage' => $currentVillage,
                'genderList' => $genderList,
                'statusList' => $statusList,
            ));
        }else{
            throw new CHttpException(404, 'You are not registered as a member!');
        }
    }

    public function actionAddContact() {
        $model = new ContactAddress;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ContactAddress'])) {
            $model->attributes = $_POST['ContactAddress'];
            if ($model->save())
                $this->redirect(array('view', 'a' => 'con'));
        }else {
            $this->redirect(array('view', 'a' => 'con'));
        }
    }

    public function actionView($a = null) {

        if (User::isARegisteredUser(Yii::app()->user->id)) {
            try {

                $document = new Document();
                //contacts categories
                $contactCategories = ContactCategory::model()->findAll();

                //documents categories
                $documentCategories = DocumentCategory::model()->findAll(array('condition' => 'Status = 1'));

                if (User::isARegisteredUser(Yii::app()->user->id)) {
                    $user = User::model()->findByPk(Yii::app()->user->id);
                    //load user documents
                    $userDocs = Document::model()->findAll(array('condition' => 'IndividualID = ' . $user->IndividualID));

                    //contacts
                    $contacts = ContactAddress::model()->findAll(array('condition' => 'IndividualID =' . $user->IndividualID));
                } else {
                    $userDocs = array();
                    $contacts = array();
                }

                $this->render('view', array(
                    'model' => Individual::model()->findByPk($this->loadModel()->IndividualID),
                    'contactCategories' => $contactCategories,
                    'documentCategories' => $documentCategories,
                    'document' => $document,
                    'contacts' => $contacts,
                    'userDocs' => $userDocs,
                    'active_tab' => $a ? $a : 'ide',
                ));
            } catch (Exception $ex) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
        } else {
            throw new CHttpException(404, 'You are not registered as a member!');
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel() {
        $model = User::model()->findByPk(Yii::app()->user->id);
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
