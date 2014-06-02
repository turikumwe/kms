<?php

/**
 * This is the model class for table "tb01_socialnetworktype".
 *
 * The followings are the available columns in table 'tb01_socialnetworktype':
 * @property integer $SocialNetworkID
 * @property string $Name
 * @property integer $isSocialNetwork
 *
 * The followings are the available model relations:
 * @property Tb01Socialnetwork[] $tb01Socialnetworks
 */
class ContactCategory extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Socialnetworktype the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb01_socialnetworktype';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('Name', 'unique', 'className' => 'ContactCategory'),
            array('isSocialNetwork', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('SocialNetworkID, Name, isSocialNetwork', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb01Socialnetworks' => array(self::HAS_MANY, 'Tb01Socialnetwork', 'SocialNetworkTypeID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SocialNetworkID' => 'Social Network',
            'Name' => 'Name',
            'isSocialNetwork' => 'Is Social Network',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('SocialNetworkID', $this->SocialNetworkID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('isSocialNetwork', $this->isSocialNetwork);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getContactType($CategoryID) {
        $contact = ContactCategory::model()->findByPk($CategoryID);
        if ($contact) {
            if ($contact->isSocialNetwork == 1) {
                return "Yes";
            } else {
                return "No";
            }
        } else {
            return "No";
        }
    }

    public function canBeDeleted($CategoryID) {
        $contacts = ContactAddress::model()->findAll('SocialNetworkTypeID = ' . $CategoryID);
        if (count($contacts) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return ContactCategory::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
