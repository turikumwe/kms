<?php

class PeopleController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/empty';
    public $pageTitle = 'People';

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        if (User::isOfGroup('Administrator') || User::isOfGroup('Analyst')) {
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
                'actions' => array('create', 'update', 'update', 'AddContact', 'AddDocument', 'Get', 'del', 'DelCont'),
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $a = null) {
        try {

            $document = new Document();
            //contacts categories
            $contactCategories = ContactCategory::model()->findAll();

            //documents categories
            $documentCategories = DocumentCategory::model()->findAll(array('condition' => 'Status = 1'));

            //load user documents
            $userDocs = Document::model()->findAll(array('condition' => 'IndividualID = ' . $id));

            //contacts
            $contacts = ContactAddress::model()->findAll(array('condition' => 'IndividualID =' . $id));
            $this->render('view', array(
                'model' => $this->loadModel($id),
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
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
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

        $model = new Individual;

        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Individual'])) {
            $individualData = $_POST['Individual'];
            $individualData['UserName'] = strtolower($individualData['LastName']);
            $individualData['Password'] = User::generatePassoword($individualData['LastName']);
            $model->attributes = $individualData;
            if ($model->save()) {
                //automatically add the user
                $user = new User();
                $user->setScenario('autoAdd');
                $userData = array('UserGroupID'=>3, 'FirstName' => $model->FirstName, 'LastName' => $model->LastName, 'UserName' => $model->Email,
                    'Password' => User::generatePassoword('123456'), 'Email' => $model->Email, 'Phone' => $model->Phone, 'IsRegisteredMember' => 1,
                    'IndividualID' => $model->IndividualID);
                $user->attributes = $userData;
                $user->save();
                $this->redirect(array('view', 'id' => $model->IndividualID));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'countryList' => $countyList,
            'provinceList' => $provinceList,
            'selectedCountry' => 184, //Hardcoded to autoselect Rwanda
            'currentDistrict' => array(),
            'currentSector' => array(),
            'currentCell' => array(),
            'currentVillage' => array(),
            'genderList' => $genderList,
            'statusList' => $statusList,
        ));
    }

    public function actionGet($id) {
        $selectedFile = Document::model()->findByPk($id);
        if ($selectedFile) {
            $file = $selectedFile->Path;
            return Yii::app()->getRequest()->sendFile(basename($file), @file_get_contents(Yii::app()->getBasePath() . '/..' . $file));
        }
    }

    public function actionDel($id) {
        $selectedFile = Document::model()->findByPk($id);

        if (Yii::app()->request->isPostRequest) {
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionDelCont($id) {
        $selectedContact = ContactAddress::model()->findByPk($id);
        try {
            //delete contact
            $selectedContact->delete();
            $this->redirect(array('view', 'id' => $selectedContact->IndividualID, 'a' => 'con'));
        } catch (Exception $ex) {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
    }

    public function actionAddContact() {
        $model = new ContactAddress;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ContactAddress'])) {
            $model->attributes = $_POST['ContactAddress'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $_POST['ContactAddress']['IndividualID'], 'a' => 'con'));
        }else{
            $this->redirect($_SERVER['HTTP_REFERER']);
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
                            $this->redirect(array('view', 'id' => $submittedData['IndividualID'], 'a' => 'doc'));
                        } else {
                            Yii::app()->user->setFlash('error', '<strong>Upload error Please contact the support</strong><br />');
                            $this->redirect(array('view', 'id' => $submittedData['IndividualID'], 'a' => 'doc'));
                        }
                    } catch (Exception $ex) {
                        if ($ex->getCode() == 23000) {//Constraint Violation
                            Yii::app()->user->setFlash('error', '<strong>An error Occured</strong><br />You are probably trying to upload an existing document');
                            $this->redirect(array('view', 'id' => $submittedData['IndividualID'], 'a' => 'doc'));
                        } else {
                            Yii::app()->user->setFlash('error', '<strong>An error Occured</strong><br />Please contact the support');
                            $this->redirect(array('view', 'id' => $submittedData['IndividualID'], 'a' => 'doc'));
                        }
                    }
                } else {
                    Yii::app()->user->setFlash('error', CHtml::errorSummary($model));
                    $this->redirect(array('view', 'id' => $submittedData['IndividualID'], 'a' => 'doc'));
                }
            } catch (Exception $ex) {
                Yii::app()->user->setFlash('error', $ex->getMessage());
                $this->redirect(array('view', 'id' => $submittedData['IndividualID'], 'a' => 'doc'));
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
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

        $model = $this->loadModel($id);

        //current district
        $district = District::model()->findByPk($model->DistrictID);
        if ($district) {
            $currentDistrict = array($district->DistrictID => '' . $district->Name . '');
            //$currentDistrict = array(5=> 'Gisagara');
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
                $this->redirect(array('view', 'id' => $model->IndividualID));
        }
        $selectedCountry = $model->CountryID;
        $this->render('update', array(
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

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Individual('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Individual']))
            $model->attributes = $_GET['Individual'];

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
        $model = Individual::model()->findByPk($id);
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
