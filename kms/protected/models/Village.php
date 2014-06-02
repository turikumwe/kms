<?php

/**
 * This is the model class for table "tb00_village".
 *
 * The followings are the available columns in table 'tb00_village':
 * @property integer $VillageID
 * @property string $Name
 * @property integer $CellID
 *
 * The followings are the available model relations:
 * @property Tb00Cell $cell
 * @property Tb01Individual[] $tb01Individuals
 */
class Village extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Village the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb00_village';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CellID', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('VillageID, Name, CellID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'cell' => array(self::BELONGS_TO, 'Tb00Cell', 'CellID'),
            'tb01Individuals' => array(self::HAS_MANY, 'Tb01Individual', 'VillageID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'VillageID' => 'Village',
            'Name' => 'Name',
            'CellID' => 'Cell',
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

        $criteria->compare('VillageID', $this->VillageID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('CellID', $this->CellID);
        $criteria->order = 'CellID asc, Name asc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByCellID($CellID) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('VillageID', $this->VillageID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('CellID', $CellID);
        $criteria->order = 'Name asc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems())
        ));
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return Village::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
