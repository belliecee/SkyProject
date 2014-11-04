<?php

/**
 * This is the model class for table "sky1_poh".
 *
 * The followings are the available columns in table 'sky1_poh':
 * @property string $id
 * @property string $PONo
 * @property string $customerPOdate
 * @property string $vendorPOdate
 * @property string $status
 * @property string $customerDeliveryWithin
 * @property string $customerDeliveryDate
 * @property string $remark
 * @property string $customer_id
 * @property string $vendor_id
 * @property string $quoh_id
 * @property string $project_id
 */
class poh extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return poh the static model class
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
		return 'sky1_poh';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PONo', 'length', 'max'=>64),
			array('status, customerDeliveryWithin, customer_id, vendor_id, quoh_id, project_id', 'length', 'max'=>10),
			array('customerPOdate, vendorPOdate, customerDeliveryDate, remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, PONo, customerPOdate, vendorPOdate, status, customerDeliveryWithin, customerDeliveryDate, remark, customer_id, vendor_id, quoh_id, project_id', 'safe', 'on'=>'search'),
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
			'PONo' => 'Pono',
			'customerPOdate' => 'Customer Podate',
			'vendorPOdate' => 'Vendor Podate',
			'status' => 'Status',
			'customerDeliveryWithin' => 'Customer Delivery Within',
			'customerDeliveryDate' => 'Customer Delivery Date',
			'remark' => 'Remark',
			'customer_id' => 'Customer',
			'vendor_id' => 'Vendor',
			'quoh_id' => 'Quoh',
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
		$criteria->compare('PONo',$this->PONo,true);
		$criteria->compare('customerPOdate',$this->customerPOdate,true);
		$criteria->compare('vendorPOdate',$this->vendorPOdate,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('customerDeliveryWithin',$this->customerDeliveryWithin,true);
		$criteria->compare('customerDeliveryDate',$this->customerDeliveryDate,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('vendor_id',$this->vendor_id,true);
		$criteria->compare('quoh_id',$this->quoh_id,true);
		$criteria->compare('project_id',$this->project_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}