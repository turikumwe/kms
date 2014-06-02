<?php

/**
 * This is the model class for table "tb01_documenttype".
 *
 * The followings are the available columns in table 'tb01_documenttype':
 * @property integer $DocumentTypeID
 * @property string $Name
 *
 * The followings are the available model relations:
 * @property Tb01Document[] $tb01Documents
 */
class DocumentCategory extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return DocumentCategory the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb01_documenttype';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('Name', 'unique', 'className' => 'DocumentCategory'),
            array('Name', 'length', 'max' => 100),
            array('Status', 'length', 'max' => 1),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('DocumentTypeID, Name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tb01Documents' => array(self::HAS_MANY, 'Tb01Document', 'DocumentTypeID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'DocumentTypeID' => 'Document Type',
            'Name' => 'Name',
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

        $criteria->compare('DocumentTypeID', $this->DocumentTypeID);
        $criteria->compare('Name', $this->Name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function canBeDeleted($CategoryID) {
        $documents = Document::model()->findAll('DocumentTypeID = ' . $CategoryID);
        if (count($documents) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getNameByID($ID) {

        if (isset($ID)) {
            return DocumentCategory::model()->findByPk($ID)->Name;
        } else {
            return 'None';
        }
    }

}
