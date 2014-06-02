<?php

/**
 * This is the model class for table "tb04_constant".
 *
 * The followings are the available columns in table 'tb04_constant':
 * @property integer $ConstantID
 * @property string $ConstantName
 * @property string $Comment
 */
class Constant extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Constant the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'tb04_constant';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ConstantID, ConstantName, Comment', 'required'),
            array('ConstantID', 'numerical', 'integerOnly' => true),
            array('ConstantName, Comment', 'length', 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ConstantID, ConstantName, Comment', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ConstantID' => 'Constant',
            'ConstantName' => 'Constant Name',
            'Comment' => 'Comment',
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

        $criteria->compare('ConstantID', $this->ConstantID);
        $criteria->compare('ConstantName', $this->ConstantName, true);
        $criteria->compare('Comment', $this->Comment, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    function getDisplayItems() {
        if (isset(Yii::app()->session['item_per_page'])) {
            return Yii::app()->session['item_per_page'];
        } else {
            return 20;
        }
    }

}
