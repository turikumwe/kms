<?php

/**
 * This is the model class for table "tb01_individual".
 *
 * The followings are the available columns in table 'tb01_individual':
 * @property integer $IndividualID
 * @property string $FirstName
 * @property string $LastName
 * @property string $OtherName
 * @property string $DOB
 * @property string $PassportNumber
 * @property string $Phone
 * @property string $Email
 * @property integer $CivilStatusID
 * @property integer $GenderID
 * @property integer $CountryID
 * @property integer $ProvinceID
 * @property integer $DistrictID
 * @property integer $SectorID
 * @property integer $CellID
 * @property integer $VillageID
 * @property string $CreatedOn
 * @property string $UserName
 * @property string $Password
 * @property string $Comment
 * @property string $NationalID
 *
 * The followings are the available model relations:
 * @property Tb01Document[] $tb01Documents
 * @property Tb00Cell $cell
 * @property Tb00Civilstatus $civilStatus
 * @property Tb00District $district
 * @property Tb00Gender $gender
 * @property Tb00Province $province
 * @property Tb00Sector $sector
 * @property Tb00Village $village
 * @property Tb01Socialnetwork[] $tb01Socialnetworks
 */
class Individual extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Individual the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb01_individual';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('CivilStatusID, GenderID, FirstName, LastName, Email,Phone,DOB', 'required'),
            array('Email, Phone', 'unique', 'className' => 'Individual'),
            array('CivilStatusID, GenderID, CountryID, ProvinceID, DistrictID, SectorID, CellID, VillageID', 'numerical', 'integerOnly' => true),
            array('FirstName, LastName, OtherName, UserName', 'length', 'max' => 45),
            array('CountryID, ProvinceID, DistrictID, SectorID, CellID, VillageID', 'rwandaSelected'),
            array('Comment', 'length', 'max' => 200),
            array('PassportNumber, Phone', 'length', 'max' => 15),
            array('Email', 'length', 'max' => 50),
            array('Password', 'length', 'max' => 100),
            array('NationalID', 'length', 'max' => 20),
            array('DOB, CreatedOn', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('IndividualID, FirstName, LastName, OtherName, DOB, PassportNumber, Phone, Email, CivilStatusID, GenderID, CountryID, ProvinceID, DistrictID, SectorID, CellID, VillageID, CreatedOn, UserName, Password, Comment, NationalID', 'safe', 'on' => 'search'),
        );
    }

    public function rwandaSelected($attribute, $params) {
        if ($this->CountryID != 184) {//hardcoded for Rwanda
            if ($this->DistrictID != '' || $this->SectorID != '' || $this->CellID != '' || $this->VillageID != '') {
                // adding error for attribute "phone1" ONLY
                $this->addError($attribute, 'Invalid location.');
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb01Documents' => array(self::HAS_MANY, 'Document', 'IndividualID'),
            'cell' => array(self::BELONGS_TO, 'Cell', 'CellID'),
            'civilStatus' => array(self::BELONGS_TO, 'Civilstatus', 'CivilStatusID'),
            'district' => array(self::BELONGS_TO, 'District', 'DistrictID'),
            'gender' => array(self::BELONGS_TO, 'Gender', 'GenderID'),
            'province' => array(self::BELONGS_TO, 'Province', 'ProvinceID'),
            'sector' => array(self::BELONGS_TO, 'Sector', 'SectorID'),
            'village' => array(self::BELONGS_TO, 'Village', 'VillageID'),
            'tb01Socialnetworks' => array(self::HAS_MANY, 'Socialnetwork', 'IndividualID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'IndividualID' => 'Individual',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'OtherName' => 'Other Name',
            'DOB' => 'Dob',
            'PassportNumber' => 'Passport Number',
            'Phone' => 'Phone',
            'Email' => 'Email',
            'CivilStatusID' => 'Civil Status',
            'GenderID' => 'Gender',
            'CountryID' => 'Country',
            'ProvinceID' => 'Province',
            'DistrictID' => 'District',
            'SectorID' => 'Sector',
            'CellID' => 'Cell',
            'VillageID' => 'Village',
            'CreatedOn' => 'Created On',
            'UserName' => 'User Name',
            'Password' => 'Password',
            'Comment' => 'Short Bio',
            'NationalID' => 'National ID',
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

        $criteria->compare('IndividualID', $this->IndividualID);
        $criteria->compare('FirstName', $this->FirstName, true);
        $criteria->compare('LastName', $this->LastName, true);
        $criteria->compare('OtherName', $this->OtherName, true);
        $criteria->compare('DOB', $this->DOB, true);
        $criteria->compare('PassportNumber', $this->PassportNumber, true);
        $criteria->compare('Phone', $this->Phone, true);
        $criteria->compare('Email', $this->Email, true);
        $criteria->compare('CivilStatusID', $this->CivilStatusID);
        $criteria->compare('GenderID', $this->GenderID);
        $criteria->compare('CountryID', $this->CountryID);
        $criteria->compare('ProvinceID', $this->ProvinceID);
        $criteria->compare('DistrictID', $this->DistrictID);
        $criteria->compare('SectorID', $this->SectorID);
        $criteria->compare('CellID', $this->CellID);
        $criteria->compare('VillageID', $this->VillageID);
        $criteria->compare('CreatedOn', $this->CreatedOn, true);
        $criteria->compare('UserName', $this->UserName, true);
        $criteria->compare('Password', $this->Password, true);
        $criteria->compare('Comment', $this->Comment, true);
        $criteria->compare('NationalID', $this->NationalID, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria, 'pagination' => array('pagesize' => Constant::getDisplayItems()),
            'sort' => array('defaultOrder' => 'LastName asc')
        ));
    }

}
