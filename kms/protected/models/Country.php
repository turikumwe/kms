<?php

/**
 * This is the model class for table "tb00_country".
 *
 * The followings are the available columns in table 'tb00_country':
 * @property integer $CountryID
 * @property string $Name
 * @property string $alpha_2
 * @property string $alpha_3
 *
 * The followings are the available model relations:
 * @property Tb00Province[] $tb00Provinces
 */
class Country extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Country the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb00_country';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name, alpha_2, alpha_3', 'required'),
            array('Name', 'length', 'max' => 45),
            array('alpha_2, alpha_3', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('CountryID, Name, alpha_2, alpha_3', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb00Provinces' => array(self::HAS_MANY, 'Tb00Province', 'CountryID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'CountryID' => 'Country',
            'Name' => 'Name',
            'alpha_2' => 'Alpha 2',
            'alpha_3' => 'Alpha 3',
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

        $criteria->compare('CountryID', $this->CountryID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('alpha_2', $this->alpha_2, true);
        $criteria->compare('alpha_3', $this->alpha_3, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return Country::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
