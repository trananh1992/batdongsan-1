<?php

/**
 * This is the model class for table "{{_tim_kiem_dien_tich}}".
 *
 * The followings are the available columns in table '{{_tim_kiem_dien_tich}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $order_display
 * @property double $min
 * @property double $max
 * @property string $created_date
 * @property string $slug
 */
class DienTich extends _BaseModel 
{
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_tim_kiem_dien_tich}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, order_display, min, max, created_date, slug', 'required'),
			array('status, order_display', 'numerical', 'integerOnly'=>true),
			array('min, max', 'numerical'),
			array('name', 'length', 'max'=>200),
			array('slug', 'length', 'max'=>255),
			array('id, name, status, order_display, min, max, created_date, slug', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
	
																						);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('translation','ID'),
			'name' => Yii::t('translation','Name'),
			'status' => Yii::t('translation','Status'),
			'order_display' => Yii::t('translation','Order Display'),
			'min' => Yii::t('translation','Min'),
			'max' => Yii::t('translation','Max'),
			'created_date' => Yii::t('translation','Created Date'),
			'slug' => Yii::t('translation','Slug'),
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('min',$this->min);
		$criteria->compare('max',$this->max);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('slug',$this->slug,true);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	
	public function activate()
    {
        $this->status = 1;
        $this->update();
    }



    public function deactivate()
    {
        $this->status = 0;
        $this->update();
    }
	public function behaviors() {
        return array('sluggable' => array(
                'class' => 'application.extensions.mintao-yii-behavior-sluggable.SluggableBehavior',
                'columns' => array('name'),
                'unique' => true,
                'update' => true,
            ),);
    }
	
	public static function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
        return self::model()->find($criteria);
	}
	

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
	public static function getListDienTich()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Diện Tích---') + CHtml::listData($models,'id','name');
	}

	public static function getListWidget()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		return self::model()->findAll($criteria);
	}

	protected function beforeSave() 
	{
		/*
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
        */
	    return parent::beforeSave();
	}
}
