<?php

/**
 * This is the model class for table "sky1_quoh".
 *
 * The followings are the available columns in table 'sky1_quoh':
 * @property string $id
 * @property string $quoteNo
 * @property string $vendorQuoteDate
 * @property string $enquiryDate
 * @property string $vendor_id
 * @property string $status
 * @property string $project_id
 * @property string $deleted
 * @property string $vendorRemark
 * @property string $customerQuoteDate
 * @property string $customer_id
 * @property string $remark
 */
class quoh extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return quoh the static model class
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
		return 'sky1_quoh';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('quoteNo', 'length', 'max'=>64),
			array('vendor_id, status, project_id, deleted, customer_id', 'length', 'max'=>10),
			array('vendorQuoteDate, enquiryDate, vendorRemark, customerQuoteDate, remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quoteNo, vendorQuoteDate, enquiryDate, vendor_id, status, project_id, deleted, vendorRemark, customerQuoteDate, customer_id, remark', 'safe', 'on'=>'search'),
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
                   'project' => array(self::BELONGS_TO, 'project', 'id'),
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'quoteNo' => 'Quote No',
			'vendorQuoteDate' => 'Vendor Quote Date',
			'enquiryDate' => 'Enquiry Date',
			'vendor_id' => 'Vendor',
			'status' => 'Status',
			'project_id' => 'Project',
			'deleted' => 'Deleted',
			'vendorRemark' => 'Vendor Remark',
			'customerQuoteDate' => 'Customer Quote Date',
			'customer_id' => 'Customer',
			'remark' => 'Remark',
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
		$criteria->compare('quoteNo',$this->quoteNo,true);
		$criteria->compare('vendorQuoteDate',$this->vendorQuoteDate,true);
		$criteria->compare('enquiryDate',$this->enquiryDate,true);
		$criteria->compare('vendor_id',$this->vendor_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('deleted',$this->deleted,true);
		$criteria->compare('vendorRemark',$this->vendorRemark,true);
		$criteria->compare('customerQuoteDate',$this->customerQuoteDate,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}