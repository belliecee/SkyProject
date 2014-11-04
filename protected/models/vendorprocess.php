<?php

/**
 * This is the model class for table "sky1_vendorprocess".
 *
 * The followings are the available columns in table 'sky1_vendorprocess':
 * @property string $id
 * @property string $vendor_id
 * @property string $project_id
 * @property string $enquiryToVendorDate
 * @property string $vendorQuotationDate
 * @property string $remark
 * @property string $update_on
 * @property string $update_by
 */
class vendorprocess extends beforeSaveActiveRecord
{
        public $vendorstr;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return vendorprocess the static model class
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
		return 'sky1_vendorprocess';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('vendor_id, project_id, update_by', 'length', 'max'=>10),
                        //array('enquiryToVendorDate,vendorQuotationDate', 'date', 'format'=>'d/m/Y', 'message'=>'{attribute} Date format must be d/m/Y'),

			array('enquiryToVendorDate, vendorQuotationDate, remark, update_on', 'safe'),
                       // array('enquiryToVendorDate, vendorQuotationDate', 'type', 'type' => 'date',),
                       // 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, vendor_id, project_id, enquiryToVendorDate, vendorQuotationDate, remark, update_on, update_by', 'safe', 'on'=>'search'),
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
			'vendor_id' => 'Vendor',
			'project_id' => 'Project',
			'enquiryToVendorDate' => 'Enquiry To Vendor Date',
			'vendorQuotationDate' => 'Vendor Quotation Date',
			'remark' => 'Remark',
			'update_on' => 'Update On',
			'update_by' => 'Update By',
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
		$criteria->compare('vendor_id',$this->vendor_id,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('enquiryToVendorDate',$this->enquiryToVendorDate,true);
		$criteria->compare('vendorQuotationDate',$this->vendorQuotationDate,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('update_on',$this->update_on,true);
		$criteria->compare('update_by',$this->update_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}