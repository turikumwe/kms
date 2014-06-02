<?php

/**
 * This is the model class for table "tb00_province".
 *
 * The followings are the available columns in table 'tb00_province':
 * @property integer $ProvinceID
 * @property string $Name
 * @property integer $CountryID
 *
 * The followings are the available model relations:
 * @property Tb00District[] $tb00Districts
 * @property Tb00Country $country
 * @property Tb01Individual[] $tb01Individuals
 */
class Province extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Province the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb00_province';
    }

    var $primaryKey = 'ProvinceID';

    public function setPrimaryKey() {
        return $primaryKey;
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('CountryID', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'max' => 45),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ProvinceID, Name, CountryID', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb00Districts' => array(self::HAS_MANY, 'Tb00District', 'ProvinceID'),
            'country' => array(self::BELONGS_TO, 'Tb00Country', 'CountryID'),
            'tb01Individuals' => array(self::HAS_MANY, 'Tb01Individual', 'ProvinceID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ProvinceID' => 'Province',
            'Name' => 'Name',
            'CountryID' => 'Country',
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

        $criteria->compare('ProvinceID', $this->ProvinceID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('CountryID', $this->CountryID);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'Name asc')
        ));
    }

    public function getNameByID($ID) {
        if (isset($ID)) {
            return Province::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
