<?php

/**
 * This is the model class for table "{{_loai_tin}}".
 *
 * The followings are the available columns in table '{{_loai_tin}}':
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $created_date
 * @property string $slug
 * @property integer $order_display
 */
class DichVu extends _BaseModel {
		
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_loai_tin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, status, created_date, order_display', 'required'),
			array('status, order_display', 'numerical', 'integerOnly'=>true),
			array('name, slug', 'length', 'max'=>255),
		 array('name,status,created_date,order_display', 'required', 'on' => 'create, update'), 
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, status, created_date, slug, order_display', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('translation','ID'),
			'name' => Yii::t('translation','Tên Dịch Vụ'),
			'status' => Yii::t('translation','Status'),
			'created_date' => Yii::t('translation','Created Date'),
			'slug' => Yii::t('translation','Slug'),
			'order_display' => Yii::t('translation','Sắp Xếp'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('order_display',$this->order_display);
				$sort = new CSort();

        $sort->attributes = array(
            'name' => array(
                'asc' => 't.name',
                'desc' => 't.name desc',
                'default' => 'asc',
            ),
        );
		$sort->defaultOrder = 't.name asc';
					
		 
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
        return self::model()->find($criteria);
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DichVu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}

	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Chọn---') + CHtml::listData($models,'id','name');
	}
}
