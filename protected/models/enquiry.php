<?php

/**
 * This is the model class for table "sky1_enquiry".
 *
 * The followings are the available columns in table 'sky1_enquiry':
 * @property string $id
 * @property string $customer
 * @property string $date
 * @property string $contact
 * @property string $remark
 * @property string $mobile
 * @property string $product
 * @property string $isstock
 * @property string $project_id
 * @property string $create_on
 * @property string $create_by
 * @property string $update_on
 * @property string $update_by
 */
class enquiry extends beforeSaveActiveRecord
{
        public $customerstr;
        public $vendorstr;
        public $qty;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return enquiry the static model class
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
		return 'sky1_enquiry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('customer, isstock, project_id, create_by, update_by', 'length', 'max'=>10),
			array('contact, product', 'length', 'max'=>256),
			array('mobile', 'length', 'max'=>64),
			array('date, remark, create_on, update_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,customer,customerstr, date, contact, remark, mobile, product, isstock, project_id, create_on, create_by, update_on, update_by', 'safe', 'on'=>'search'),
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
			'customer' => 'Customer',
			'date' => 'Date',
			'contact' => 'Contact',
			'remark' => 'Remark',
			'mobile' => 'Mobile',
			'product' => 'Product',
			'isstock' => 'Isstock',
			'project_id' => 'Project',
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
		$criteria->compare('customer',$this->customer,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('remark',$this->remark,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('product',$this->product,true);
		$criteria->compare('isstock',$this->isstock,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('create_on',$this->create_on,true);
		$criteria->compare('create_by',$this->create_by,true);
		$criteria->compare('update_on',$this->update_on,true);
		$criteria->compare('update_by',$this->update_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}