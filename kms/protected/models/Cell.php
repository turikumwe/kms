<?php

/**
 * This is the model class for table "tb00_cell".
 *
 * The followings are the available columns in table 'tb00_cell':
 * @property integer $CellID
 * @property string $Name
 * @property integer $SectorID
 *
 * The followings are the available model relations:
 * @property Tb00Sector $sector
 * @property Tb00Village[] $tb00Villages
 * @property Tb01Individual[] $tb01Individuals
 */
class Cell extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cell the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb00_cell';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('SectorID', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('CellID, Name, SectorID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sector' => array(self::BELONGS_TO, 'Tb00Sector', 'SectorID'),
            'tb00Villages' => array(self::HAS_MANY, 'Tb00Village', 'CellID'),
            'tb01Individuals' => array(self::HAS_MANY, 'Tb01Individual', 'CellID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'CellID' => 'Cell',
            'Name' => 'Name',
            'SectorID' => 'Sector',
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

        $criteria->compare('CellID', $this->CellID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('SectorID', $this->SectorID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'SectorID asc, Name asc')
        ));
    }

    public function searchBySectorID($sectorID) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('CellID', $this->CellID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('SectorID', $sectorID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'Name asc')
        ));
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return Cell::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
