<?php

/**
 * This is the model class for table "tb01_document".
 *
 * The followings are the available columns in table 'tb01_document':
 * @property integer $DocumentID
 * @property integer $IndividualID
 * @property integer $DocumentTypeID
 * @property string $DocumentName
 * @property string $SubmitDate
 * @property string $Path
 * @property string $Extension
 * @property string $DocFile
 * @property string $DocSize
 *
 * The followings are the available model relations:
 * @property Tb01Documenttype $documentType
 * @property Tb01Individual $individual
 */
class Document extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Document the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb01_document';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('IndividualID, DocumentTypeID', 'required'),
            array('IndividualID, DocumentTypeID', 'numerical', 'integerOnly' => true),
            array('DocumentName', 'length', 'max' => 100),
            array('DocFile', 'file', 'types' => 'jpg, gif, png, pdf, jpeg, PDF', 'allowEmpty' => false, 'maxSize' => 1024 * 1024 * 50, 'tooLarge' => 'The file was larger than 50MB. Please upload a smaller file.'),
            array('Summary', 'length', 'max' => 200),
            array('Path', 'length', 'max' => 200),
            array('Extension', 'length', 'max' => 50),
            array('DocSize', 'length', 'max' => 255),
            array('DocFile', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('DocumentID, IndividualID, DocumentTypeID, DocumentName, SubmitDate, Path, Extension, DocFile, DocSize', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'documentType' => array(self::BELONGS_TO, 'Tb01Documenttype', 'DocumentTypeID'),
            'individual' => array(self::BELONGS_TO, 'Tb01Individual', 'IndividualID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'DocumentID' => 'Document',
            'IndividualID' => 'Individual',
            'DocumentTypeID' => 'Document Type',
            'DocumentName' => 'Document Name',
            'SubmitDate' => 'Submit Date',
            'Path' => 'Path',
            'Extension' => 'Extension',
            'DocFile' => 'Doc File',
            'DocSize' => 'Doc Size',
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

        $criteria->compare('DocumentID', $this->DocumentID);
        $criteria->compare('IndividualID', $this->IndividualID);
        $criteria->compare('DocumentTypeID', $this->DocumentTypeID);
        $criteria->compare('DocumentName', $this->DocumentName, true);
        $criteria->compare('SubmitDate', $this->SubmitDate, true);
        $criteria->compare('Path', $this->Path, true);
        $criteria->compare('Extension', $this->Extension, true);
        $criteria->compare('DocFile', $this->DocFile, true);
        $criteria->compare('DocSize', $this->DocSize, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchByIndividual($IndividualID) {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('DocumentID', $this->DocumentID);
        $criteria->compare('IndividualID', $IndividualID);
        $criteria->compare('DocumentTypeID', $this->DocumentTypeID);
        $criteria->compare('DocumentName', $this->DocumentName, true);
        $criteria->compare('SubmitDate', $this->SubmitDate, true);
        $criteria->compare('Path', $this->Path, true);
        $criteria->compare('Extension', $this->Extension, true);
        $criteria->compare('DocFile', $this->DocFile, true);
        $criteria->compare('DocSize', $this->DocSize, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getPathSeparator() {
        if (PHP_OS == 'Linux') {
            return '/';
        } else {
            return '\\';
        }
    }

}
