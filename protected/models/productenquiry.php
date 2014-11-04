<?php

/**
 * This is the model class for table "sky1_productenquiry".
 *
 * The followings are the available columns in table 'sky1_productenquiry':
 * @property string $id
 * @property string $modelNo
 * @property string $name
 * @property integer $project_id
 * @property string $type
 * @property double $price
 * @property string $deleted
 */
class productenquiry extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return productenquiry the static model class
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
		return 'sky1_productenquiry';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			array('project_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('modelNo', 'length', 'max'=>64),
			array('name', 'length', 'max'=>128),
			array('type, deleted', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, modelNo, name, project_id, type, price, deleted', 'safe', 'on'=>'search'),
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
			'modelNo' => 'Model No',
			'name' => 'Name',
			'project_id' => 'Project',
			'type' => 'Type',
			'price' => 'Price',
			'deleted' => 'Deleted',
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
		$criteria->compare('modelNo',$this->modelNo,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('deleted',$this->deleted,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}