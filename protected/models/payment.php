<?php

/**
 * This is the model class for table "sky1_payment".
 *
 * The followings are the available columns in table 'sky1_payment':
 * @property string $id
 * @property string $quotation_id
 * @property string $paymentDate
 * @property double $amount
 * @property string $update_on
 * @property string $update_by
 * @property string $project_id
 */
class payment extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return payment the static model class
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
		return 'sky1_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('amount', 'numerical'),
			array('quotation_id, update_by, project_id', 'length', 'max'=>10),
			array('paymentDate', 'length', 'max'=>64),
			array('update_on', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quotation_id, paymentDate, amount, update_on, update_by, project_id', 'safe', 'on'=>'search'),
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
			'quotation_id' => 'Quotation',
			'paymentDate' => 'Payment Date',
			'amount' => 'Amount',
			'update_on' => 'Update On',
			'update_by' => 'Update By',
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
		$criteria->compare('quotation_id',$this->quotation_id,true);
		$criteria->compare('paymentDate',$this->paymentDate,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('update_on',$this->update_on,true);
		$criteria->compare('update_by',$this->update_by,true);
		$criteria->compare('project_id',$this->project_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}