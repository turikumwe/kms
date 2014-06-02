<?php

/**
 * This is the model class for table "tb02_group".
 *
 * The followings are the available columns in table 'tb02_group':
 * @property integer $GroupID
 * @property string $Name
 * @property string $Description
 *
 * The followings are the available model relations:
 * @property Tb02User[] $tb02Users
 */
class UserGroup extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb02_usergroup';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'length', 'max' => 45),
            array('Description', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('GroupID, Name, Description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb02Users' => array(self::HAS_MANY, 'User', 'GroupID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'GroupID' => 'Group',
            'Name' => 'Name',
            'Description' => 'Description',
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

        $criteria->compare('GroupID', $this->GroupID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('Description', $this->Description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Tb02Group the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getNameById($userGroupID) {
        $userGroup = UserGroup::model()->findByPk($userGroupID);
        if ($userGroup) {
            return $userGroup->Name;
        } else {
            return 'None';
        }
    }

}
