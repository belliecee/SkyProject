<?php

/**
 * This is the model class for table "sky1_deposit".
 *
 * The followings are the available columns in table 'sky1_deposit':
 * @property string $id
 * @property string $isdeposit
 * @property string $depositDate
 * @property double $depositAmount
 * @property string $customerDeliveryWithin
 * @property string $customerDeliveryDate
 * @property string $remark
 * @property string $project_id
 */
class deposit extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return deposit the static model class
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
		return 'sky1_deposit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('depositAmount', 'numerical'),
			array('isdeposit, customerDeliveryWithin, project_id', 'length', 'max'=>10),
			array('depositDate, customerDeliveryDate, remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, isdeposit, depositDate, depositAmount, customerDeliveryWithin, customerDeliveryDate, remark, project_id', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'isdeposit' => 'Isdeposit',
			'depositDate' => 'Deposit Date',
			'depositAmount' => 'Deposit Amount',
			'customerDeliveryWithin' => 'Customer Delivery Within',
			'customerDeliveryDate' => 'Customer Delivery Date',
			'remark' => 'Remark',
			'project_id' => 'Project',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('isdeposit',$this->isdeposit,true);
		$criteria->compare('depositDate',$this->depositDate,true);
		$criteria->compare('depositAmount',$this->depositAmount);
		$criteria->compare('customerDeliveryWithin',$this->customerDeliveryWithin,true);
		$criteria->compare('customerDeliveryDate',$this->customerDeliveryDate,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('project_id',$this->project_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}