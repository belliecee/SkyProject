<?php

/**
 * This is the model class for table "sky1_potovendor".
 *
 * The followings are the available columns in table 'sky1_potovendor':
 * @property string $potovendor_id
 * @property string $POtoVendotNo
 * @property string $project_id
 * @property string $orderDate
 * @property string $vendorPOdate
 * @property integer $vendorDeliveryWithin
 * @property string $vendorDeliveryDate
 * @property string $remark
 */
class potovendor extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return potovendor the static model class
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
		return 'sky1_potovendor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('vendorDeliveryWithin', 'numerical', 'integerOnly'=>true),
			array('POtoVendotNo', 'length', 'max'=>64),
			array('project_id', 'length', 'max'=>10),
			array('orderDate, vendorPOdate, vendorDeliveryDate, remark', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('potovendor_id, POtoVendotNo, project_id, orderDate, vendorPOdate, vendorDeliveryWithin, vendorDeliveryDate, remark', 'safe', 'on'=>'search'),
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
			'potovendor_id' => 'Potovendor',
			'POtoVendotNo' => 'Poto Vendot No',
			'project_id' => 'Project',
			'orderDate' => 'Order Date',
			'vendorPOdate' => 'Vendor Podate',
			'vendorDeliveryWithin' => 'Vendor Delivery Within',
			'vendorDeliveryDate' => 'Vendor Delivery Date',
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

		$criteria->compare('potovendor_id',$this->potovendor_id,true);
		$criteria->compare('POtoVendotNo',$this->POtoVendotNo,true);
		$criteria->compare('project_id',$this->project_id,true);
		$criteria->compare('orderDate',$this->orderDate,true);
		$criteria->compare('vendorPOdate',$this->vendorPOdate,true);
		$criteria->compare('vendorDeliveryWithin',$this->vendorDeliveryWithin);
		$criteria->compare('vendorDeliveryDate',$this->vendorDeliveryDate,true);
		$criteria->compare('remark',$this->remark,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}