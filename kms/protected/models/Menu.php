<?php

/**
 * This is the model class for table "tb04_menu".
 *
 * The followings are the available columns in table 'tb04_menu':
 * @property integer $MenuID
 * @property string $Label
 * @property string $URL
 * @property integer $ParentID
 * @property integer $Status
 *
 * The followings are the available model relations:
 * @property Tb02Menuaccess[] $tb02Menuaccesses
 */
class Menu extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Menu the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb04_menu';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Label, URL, Status', 'required'),
            array('ParentID, Status', 'numerical', 'integerOnly' => true),
            array('Label, URL', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('MenuID, Label, URL, ParentID, Status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb02Menuaccesses' => array(self::HAS_MANY, 'Tb02Menuaccess', 'MenuID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'MenuID' => 'Menu',
            'Label' => 'Label',
            'URL' => 'Url',
            'ParentID' => 'Parent',
            'Status' => 'Status',
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

        $criteria->compare('MenuID', $this->MenuID);
        $criteria->compare('Label', $this->Label, true);
        $criteria->compare('URL', $this->URL, true);
        $criteria->compare('ParentID', $this->ParentID);
        $criteria->compare('Status', $this->Status);
        $criteria->compare('Sort', $this->Sort);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getMenuByUser($userID) {

        //get the group of the user
        $userGroupID = User::model()->findByPk($userID)->UserGroupID;

        //Menu accessed by that group
        $menuAccess = MenuAccess::model()->findAll('UserGroupID = ' . $userGroupID . '');
        if (count($menuAccess) > 0) {
            $access_ids = array();
            foreach ($menuAccess as $access) {
                array_push($access_ids, $access['MenuID']);
            }
            //load menues
            $menuToAccess = Menu::model()->findAll('MenuID in (' . implode(',', $access_ids) . ') order by Sort ASC, Label ASC');
            if (count($menuToAccess) > 0) {
                return $menuToAccess;
            } else {
                //empty array
                return array();
            }
        } else {
            //empty array
            return array();
        }
    }

    public function getMenuByParent($parentID) {
        $childMenues = Menu::model()->findAll('ParentID = ' . $parentID . ' order by Sort ASC');
        if (count($childMenues) > 0) {
            return $childMenues;
        } else {
            //empty array
            return array();
        }
    }

}
