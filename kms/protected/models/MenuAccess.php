<?php

/**
 * This is the model class for table "tb02_menuaccess".
 *
 * The followings are the available columns in table 'tb02_menuaccess':
 * @property integer $MenuID
 * @property integer $UserGroupID
 *
 * The followings are the available model relations:
 * @property Tb04Menu $menu
 * @property Tb02Usergroup $userGroup
 */
class MenuAccess extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MenuAccess the static model class
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
		return 'tb02_menuaccess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MenuID, UserGroupID', 'required'),
			array('MenuID, UserGroupID', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('MenuID, UserGroupID', 'safe', 'on'=>'search'),
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
			'menu' => array(self::BELONGS_TO, 'Tb04Menu', 'MenuID'),
			'userGroup' => array(self::BELONGS_TO, 'Tb02Usergroup', 'UserGroupID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'MenuID' => 'Menu',
			'UserGroupID' => 'User Group',
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

		$criteria->compare('MenuID',$this->MenuID);
		$criteria->compare('UserGroupID',$this->UserGroupID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}