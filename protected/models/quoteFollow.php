<?php

/**
 * This is the model class for table "sky1_quoteFollow".
 *
 * The followings are the available columns in table 'sky1_quoteFollow':
 * @property string $id
 * @property string $quoteNo
 * @property string $quoH_id
 * @property string $followedDate
 * @property string $followedBy
 * @property string $contact
 * @property string $detail
 */
class quoteFollow extends beforeSaveActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return quoteFollow the static model class
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
		return 'sky1_quoteFollow';
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
			array('quoH_id, followedBy', 'length', 'max'=>10),
			array('contact', 'length', 'max'=>256),
			array('followedDate, detail', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, quoteNo, quoH_id, followedDate, followedBy, contact, detail', 'safe', 'on'=>'search'),
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
			'quoteNo' => 'Quote No',
			'quoH_id' => 'Quo H',
			'followedDate' => 'Followed Date',
			'followedBy' => 'Followed By',
			'contact' => 'Contact',
			'detail' => 'Detail',
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
		$criteria->compare('quoH_id',$this->quoH_id,true);
		$criteria->compare('followedDate',$this->followedDate,true);
		$criteria->compare('followedBy',$this->followedBy,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('detail',$this->detail,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}