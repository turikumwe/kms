<?php

/**
 * This is the model class for table "tb01_socialnetwork".
 *
 * The followings are the available columns in table 'tb01_socialnetwork':
 * @property integer $SocialNetworkID
 * @property integer $SocialNetworkTypeID
 * @property integer $IndividualID
 * @property string $Address
 * @property string $CreatedOn
 *
 * The followings are the available model relations:
 * @property Tb01Individual $individual
 * @property Tb01Socialnetworktype $socialNetworkType
 */
class ContactAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContactAddress the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tb01_socialnetwork';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SocialNetworkTypeID', 'required'),
			array('SocialNetworkTypeID, IndividualID', 'numerical', 'integerOnly'=>true),
			array('Address', 'length', 'max'=>100),
			array('CreatedOn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SocialNetworkID, SocialNetworkTypeID, IndividualID, Address, CreatedOn', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'individual' => array(self::BELONGS_TO, 'Tb01Individual', 'IndividualID'),
			'socialNetworkType' => array(self::BELONGS_TO, 'Tb01Socialnetworktype', 'SocialNetworkTypeID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SocialNetworkID' => 'Social Network',
			'SocialNetworkTypeID' => 'Social Network Type',
			'IndividualID' => 'Individual',
			'Address' => 'Address',
			'CreatedOn' => 'Created On',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('SocialNetworkID',$this->SocialNetworkID);
		$criteria->compare('SocialNetworkTypeID',$this->SocialNetworkTypeID);
		$criteria->compare('IndividualID',$this->IndividualID);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('CreatedOn',$this->CreatedOn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}