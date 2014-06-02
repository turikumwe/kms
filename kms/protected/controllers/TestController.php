<?php

class TestController extends Controller {

    var $option;

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array('class' => 'CViewAction',),
            'yiifilemanagerfilepicker' => array(
                'class' =>
                'ext.yiifilemanagerfilepicker.YiiFileManagerFilePickerAction'),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        Menu::getMenuByUser(1);
    }
    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->user->logout();
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            if (isset($_POST['disconnect'])) {
                Yii::app()->db->createCommand('update tb02_user set IsLoggedIn = 0 where UserName = "' . $_POST['LoginForm']['username'] . '"')->execute();
            }
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {

                //save the login for this user
                try {
                    Yii::app()->db->createCommand('insert into tb02_UserLog(userID, activity, comment, EventDate) values(' . Yii::app()->user->id . ', "Login", "Login", now())')->execute();
                    Yii::app()->db->createCommand('update tb02_user set LastLoginOn = now(),  isLoggedIn = 1 where UserID = ' . Yii::app()->user->id . '')->execute();
                } catch (Exception $e) {
                    //Just continue
                }
                if (User::isOfGroup('Administrator')) {
                    $this->redirect('index');
                } else {
                    $this->redirect('login');
                }
            }
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        //save the login for this user
        try {
            Yii::app()->db->createCommand('insert into tb02_UserLog(UserID, Activity, Comment) values(' . Yii::app()->user->id . ', "Logout", "Logout")')->execute();
            Yii::app()->db->createCommand('update tb02_user set isLoggedIn = 0 where UserID = ' . Yii::app()->user->id . '')->execute();

            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        } catch (Exception $e) {
            //Just continue
        }
    }

    public function actionFile() {
        //save the login for this user
        try {
            Yii::app()->db->createCommand('insert into tb02_UserLog(UserID, Activity, Comment) values(' . Yii::app()->user->id . ', "Logout", "Logout")')->execute();
            Yii::app()->db->createCommand('update tb02_user set isLoggedIn = 0 where UserID = ' . Yii::app()->user->id . '')->execute();

            Yii::app()->user->logout();
            $this->redirect(Yii::app()->homeUrl);
        } catch (Exception $e) {
            //Just continue
        }
    }

}
