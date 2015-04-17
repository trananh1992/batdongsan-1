<?php

class Gia extends _BaseModel {

	public function tableName()
	{
		return '{{_tim_kiem_theo_gia}}';
	}
	public function rules()
	{
		return array(
			array('name, status, order_display, min_price, max_price, created_date, slug', 'required'),
			array('status, order_display', 'numerical', 'integerOnly'=>true),
			array('min_price, max_price', 'numerical'),
			array('name', 'length', 'max'=>200),
			array('slug', 'length', 'max'=>255),
		 	array('name,status,order_display,min_price,max_price,created_date', 'required', 'on' => 'create, update'), 
			array('id, name, status, order_display, min_price, max_price, created_date, slug', 'safe', 'on'=>'search'),
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
			'min_price' => Yii::t('translation','Min Price'),
			'max_price' => Yii::t('translation','Max Price'),
			'created_date' => Yii::t('translation','Created Date'),
			'slug' => Yii::t('translation','Slug'),
		);
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('min_price',$this->min_price);
		$criteria->compare('max_price',$this->max_price);
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
	
	public function getDetailBySlug($slug)
	{
		$criteria = new CDbCriteria;
        $criteria->compare('t.slug', $slug);
        return Gia::model()->find($criteria);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return Gia::model()->count() + 1;
	}
	public static function getListGia()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Giá---') + CHtml::listData($models,'id','name');
	}

	public static function getListGiaWidget()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		return self::model()->findAll($criteria);
	}
}
