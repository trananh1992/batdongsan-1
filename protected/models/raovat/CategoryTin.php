<?php

/**
 * This is the model class for table "{{_category_tin}}".
 *
 * The followings are the available columns in table '{{_category_tin}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $slug
 * @property string $created_date
 * @property string $updated_date
 * @property integer $order_display
 * @property integer $parent_id
 */
class CategoryTin extends _BaseModel 
{
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_category_tin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, order_display', 'required','on'=>'taoBE'),
			array('status, order_display, parent_id', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>100),
			array('id, name, status, slug, created_date, updated_date, order_display, parent_id', 'safe'),
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
			'slug' => Yii::t('translation','Slug'),
			'created_date' => Yii::t('translation','Created Date'),
			'updated_date' => Yii::t('translation','Updated Date'),
			'order_display' => Yii::t('translation','Order Display'),
			'parent_id' => Yii::t('translation','Parent'),
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('parent_id',$this->parent_id);
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}


	public function searchParent()
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		// $criteria->compare('slug',$this->slug,true);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		// $criteria->compare('order_display',$this->order_display);
		$criteria->addCondition('t.parent_id=0');
		// $criteria->compare('parent_id',$this->parent_id, true);
		$criteria->order = ' updated_date DESC, id DESC';			
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 30,
            ),
		));
	}

	public function searchCon($parent_id)
	{

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		// $criteria->compare('slug',$this->slug,true);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		// $criteria->compare('order_display',$this->order_display);
		$criteria->addCondition('t.parent_id='.$parent_id);
		// $criteria->compare('parent_id',$this->parent_id, true);
		$criteria->order = 'updated_date DESC, id DESC';			
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 30,
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

	public static function getListWidget()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->addCondition('t.parent_id=0');
		$criteria->order ="order_display ASC";
		return self::model()->findAll($criteria);

	}

	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		// $criteria->addCondition('t.parent_id=0');
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Chọn---') + CHtml::listData($models,'id','name');
	}
	public static function getListDichVu()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->addCondition('t.parent_id=0');
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Loại Tin---') + CHtml::listData($models,'id','name');
	}


	public static function getListDichVu_Con($parent_id='')
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		if(!empty($parent_id))
			$criteria->addCondition('t.parent_id='.$parent_id);

		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  CHtml::listData($models,'id','name');
	}

	public static function getListKhuVuc()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->addCondition('t.parent_id <> 0');
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Khu Vực---') + CHtml::listData($models,'id','name');
	}

	protected function beforeSave() 
	{
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
	    return parent::beforeSave();
	}

	protected function beforeDelete()
    {
        // Comments::model()->deleteAll('ObjectsID = '.$this->ObjectsID);
        // Resources::model()->deleteAll('ObjectsID = '.$this->ObjectsID);

        return parent::beforeDelete();
    }
}
