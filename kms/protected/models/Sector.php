<?php

/**
 * This is the model class for table "tb00_sector".
 *
 * The followings are the available columns in table 'tb00_sector':
 * @property integer $SectorID
 * @property string $Name
 * @property integer $DistrictID
 *
 * The followings are the available model relations:
 * @property Tb00Cell[] $tb00Cells
 * @property Tb00District $district
 * @property Tb01Individual[] $tb01Individuals
 */
class Sector extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sector the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb00_sector';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('DistrictID', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('SectorID, Name, DistrictID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb00Cells' => array(self::HAS_MANY, 'Tb00Cell', 'SectorID'),
            'district' => array(self::BELONGS_TO, 'Tb00District', 'DistrictID'),
            'tb01Individuals' => array(self::HAS_MANY, 'Tb01Individual', 'SectorID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'SectorID' => 'Sector',
            'Name' => 'Name',
            'DistrictID' => 'District',
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

        $criteria->compare('SectorID', $this->SectorID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('DistrictID', $this->DistrictID);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'DistrictID asc, Name asc')
        ));
    }

    public function searchByDistrictID($districtID) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('SectorID', $this->SectorID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('DistrictID', $districtID);
        $criteria->order = 'Name asc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'Name asc')
        ));
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return Sector::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
