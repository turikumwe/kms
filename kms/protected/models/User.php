<?php

/**
 * This is the model class for table "tb02_user".
 *
 * The followings are the available columns in table 'tb02_user':
 * @property integer $UserID
 * @property integer $GroupID
 * @property string $UserName
 * @property string $Password
 * @property string $FirstName
 * @property string $LastName
 * @property string $Token
 * @property string $ResetKey
 * @property string $UpdatedOn
 * @property string $LastLoginOn
 * @property string $PasswordResetOn
 * @property integer $IsLoggedIn
 *
 * The followings are the available model relations:
 * @property Tb02Group $group
 */
class User extends CActiveRecord {

    public $PasswordConfirm;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb02_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('FirstName, LastName,Email, Phone', 'required', 'on' => 'update'),
            array('FirstName, LastName,UserName, Password, Email,Phone,PasswordConfirm', 'required', 'on' => 'insert'),
            array('FirstName, LastName,UserName, Password, Email,Phone', 'required', 'on' => 'autoAdd'),
            array('UserGroupID, IsLoggedIn, Status', 'numerical', 'integerOnly' => true),
            array('UserName, Email, Phone', 'unique', 'className' => 'User'),
            array('Email', 'email', 'message' => 'Imvalid email for {attribute} field'),
            array('UserName', 'length', 'max' => 20),
            array('Password', 'length', 'max' => 100),
            array('Password', 'compare', 'compareAttribute' => 'PasswordConfirm', 'message' => 'Password not match for password confirmation.', 'on' => 'insert'),
            array('FirstName, LastName, Email, Phone, Token, ResetKey, IsRegisteredMember, IndividualID', 'length', 'max' => 50),
            array('Phone', 'length', 'max' => 15),
            array('UpdatedOn, LastLoginOn, PasswordResetOn', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('UserID, UserGroupID, UserName, Password, FirstName, LastName, Token, ResetKey, UpdatedOn, LastLoginOn, PasswordResetOn, IsLoggedIn, Status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'UserGroupID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'UserID' => 'User',
            'UserGroupID' => 'Group',
            'UserName' => 'User Name',
            'Password' => 'Password',
            'PasswordConfirm' => 'Password Confirm',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'Phone' => 'Phone',
            'Email' => 'Email',
            'Token' => 'Token',
            'ResetKey' => 'Reset Key',
            'UpdatedOn' => 'Updated On',
            'LastLoginOn' => 'Last Login On',
            'PasswordResetOn' => 'Password Reset On',
            'IsLoggedIn' => 'Is Logged In',
            'IsRegisteredMember' => 'Is registered member',
            'IndividualID' => 'Individual Id',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('UserGroupID', $this->UserGroupID);
        $criteria->compare('UserName', $this->UserName, true);
        $criteria->compare('Password', $this->Password, true);
        $criteria->compare('FirstName', $this->FirstName, true);
        $criteria->compare('LastName', $this->LastName, true);
        $criteria->compare('Token', $this->Token, true);
        $criteria->compare('ResetKey', $this->ResetKey, true);
        $criteria->compare('UpdatedOn', $this->UpdatedOn, true);
        $criteria->compare('LastLoginOn', $this->LastLoginOn, true);
        $criteria->compare('PasswordResetOn', $this->PasswordResetOn, true);
        $criteria->compare('IsLoggedIn', $this->IsLoggedIn);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchActive() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('UserID', $this->UserID);
        $criteria->compare('UserGroupID', $this->UserGroupID);
        $criteria->compare('UserName', $this->UserName, true);
        $criteria->compare('Password', $this->Password, true);
        $criteria->compare('FirstName', $this->FirstName, true);
        $criteria->compare('LastName', $this->LastName, true);
        $criteria->compare('Token', $this->Token, true);
        $criteria->compare('ResetKey', $this->ResetKey, true);
        $criteria->compare('UpdatedOn', $this->UpdatedOn, true);
        $criteria->compare('LastLoginOn', $this->LastLoginOn, true);
        $criteria->compare('PasswordResetOn', $this->PasswordResetOn, true);
        $criteria->compare('IsLoggedIn', $this->IsLoggedIn);
        $criteria->compare('Status', 1);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getActiveUsers() {
        return User::model()->findAll('Status = 1 order by LastName asc');
    }

    public function isOfGroup($groupName) {
        $user_id = Yii::app()->user->id;
        if ($user_id) {
            //load the group for the logged user
            $logged_user = User::model()->findByPk($user_id);

            //now the group name
            $group = UserGroup::model()->findByPk($logged_user->UserGroupID);

            if ($group->Name == $groupName) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function generatePassoword($plainText) {
        return md5('kms-' . strtolower($plainText));
    }

    public function isARegisteredUser($userID) {
        $user = User::model()->findByPk($userID);
        if ($user) {
            if ($user->IsRegisteredMember == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}
