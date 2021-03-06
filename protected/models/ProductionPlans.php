<?php

/**
 * This is the model class for table "production_plans".
 *
 * The followings are the available columns in table 'production_plans':
 * @property integer $id
 * @property integer $item_id
 * @property string $value
 * @property integer $status
 */
class ProductionPlans extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	 public $item_code;
	 public $item_name;
	public function tableName()
	{
		return 'production_plans';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_id, value, status', 'required'),
			array('item_id, status', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, item_id, value, status,item_code,item_name', 'safe', 'on'=>'search'),
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
			'Rel_plan_id'=>array(self::HAS_MANY,'PlanItemStockRelations','plan_id'),
			'Rel_plan_item_id'=>array(self::BELONGS_TO,'Items','item_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_id' => 'Item',
			'value' => 'Value',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
			$criteria->with= array('Rel_plan_item_id');

		$criteria->compare('t.id',$this->id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('status',$this->status);
		$criteria->addSearchCondition('Rel_plan_item_id.code',$this->item_code);
		$criteria->addSearchCondition('Rel_plan_item_id.name',$this->item_name);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProductionPlans the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
