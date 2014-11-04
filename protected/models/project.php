<?php

/**
 * This is the model class for table "sky1_project".
 *
 * The followings are the available columns in table 'sky1_project':
 * @property string $id
 * @property string $projectNo
 * @property string $name
 * @property string $customer_id
 * @property string $vendor_id
 * @property string $status
 * @property string $mcstatus
 * @property string $machineType
 * @property string $goodsFinishedDate
 * @property string $deliveryDate
 * @property string $vendorQuoDate
 * @property string $existInStock
 * @property string $create_on
 * @property string $create_by
 * @property string $update_on
 * @property string $update_by
 */
class project extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return project the static model class
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
		return 'sky1_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('projectNo', 'length', 'max'=>64),
			array('name, mcstatus', 'length', 'max'=>128),
			array('customer_id, vendor_id, status, machineType, existInStock, create_by, update_by', 'length', 'max'=>10),
			array('goodsFinishedDate, deliveryDate, vendorQuoDate, create_on, update_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, projectNo, name, customer_id, vendor_id, status, mcstatus, machineType, goodsFinishedDate, deliveryDate, vendorQuoDate, existInStock, create_on, create_by, update_on, update_by', 'safe', 'on'=>'search'),
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
			'projectNo' => 'Project No',
			'name' => 'Name',
			'customer_id' => 'Customer',
			'vendor_id' => 'Vendor',
			'status' => 'Status',
			'mcstatus' => 'Mcstatus',
			'machineType' => 'Machine Type',
			'goodsFinishedDate' => 'Goods Finished Date',
			'deliveryDate' => 'Delivery Date',
			'vendorQuoDate' => 'Vendor Quo Date',
			'existInStock' => 'Exist In Stock',
			'create_on' => 'Create On',
			'create_by' => 'Create By',
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
		$criteria->compare('projectNo',$this->projectNo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('vendor_id',$this->vendor_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('mcstatus',$this->mcstatus,true);
		$criteria->compare('machineType',$this->machineType,true);
		$criteria->compare('goodsFinishedDate',$this->goodsFinishedDate,true);
		$criteria->compare('deliveryDate',$this->deliveryDate,true);
		$criteria->compare('vendorQuoDate',$this->vendorQuoDate,true);
		$criteria->compare('existInStock',$this->existInStock,true);
		$criteria->compare('create_on',$this->create_on,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('update_on',$this->update_on,true);
		$criteria->compare('update_by',$this->update_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}