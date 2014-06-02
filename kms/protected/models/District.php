<?php

/**
 * This is the model class for table "tb00_district".
 *
 * The followings are the available columns in table 'tb00_district':
 * @property integer $DistrictID
 * @property string $Name
 * @property integer $ProvinceID
 *
 * The followings are the available model relations:
 * @property Tb00Province $province
 * @property Tb00Sector[] $tb00Sectors
 * @property Tb01Individual[] $tb01Individuals
 */
class District extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return District the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb00_district';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ProvinceID', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('DistrictID, Name, ProvinceID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'province' => array(self::BELONGS_TO, 'Tb00Province', 'ProvinceID'),
            'tb00Sectors' => array(self::HAS_MANY, 'Tb00Sector', 'DistrictID'),
            'tb01Individuals' => array(self::HAS_MANY, 'Tb01Individual', 'DistrictID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'DistrictID' => 'District',
            'Name' => 'Name',
            'ProvinceID' => 'Province',
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

        $criteria->compare('DistrictID', $this->DistrictID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('ProvinceID', $this->ProvinceID);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'ProvinceID asc, Name asc')
        ));
    }

    public function searchByProvinceID($provinceID) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('DistrictID', $this->DistrictID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('ProvinceID', $provinceID);
        $criteria->order = 'Name asc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'Name asc')
        ));
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return District::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
