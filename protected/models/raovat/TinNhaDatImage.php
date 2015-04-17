<?php

/**
 * This is the model class for table "{{_tin_nha_dat_image}}".
 *
 * The followings are the available columns in table '{{_tin_nha_dat_image}}':
 * @property integer $id
 * @property string $image
 * @property integer $status
 * @property string $created_date
 * @property integer $is_default
 * @property integer $tin_nha_dat_id
 * @property string $updated_date
 */
class TinNhaDatImage extends _BaseModel 
{
	// public $maxImageFileSize = 3145728; //3MB
	public $maxImageFileSize = 5242880; //5MB
	public $allowImageType = 'jpg,gif,png';
	public $uploadImageFolder = 'upload/tin_nha_dat'; //remember remove ending slash
	public $defineImageSize = array(
			'name' => array(
				array('alias' => '100x100', 'size' => '100x100'),
				array('alias' => 'thumb1', 'size' => '200x200'),
				array('alias' => 'thumb2', 'size' => '400x400'),
				//array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
			), 
	);	

	public function getAllImage($tin_nha_dat_id)
	{
		if(empty($tin_nha_dat_id)) return;
		$criteria = new CDbCriteria();
		// $criteria->compare('t.tin_nha_dat_id',$tin_nha_dat_id);
		$criteria->addCondition('t.tin_nha_dat_id='.$tin_nha_dat_id);
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->limit = ;
		$criteria->order ="id ASC";
		return TinNhaDatImage::model()->findAll($criteria);
	}	

	public static function showDefaultImage($tin_nha_dat_id, $type='')
	{
		if(empty($tin_nha_dat_id)) return;
		$criteria = new CDbCriteria();
		// $criteria->compare('t.tin_nha_dat_id',$tin_nha_dat_id);
		$criteria->addCondition('t.tin_nha_dat_id='.$tin_nha_dat_id);
		$criteria->compare('t.status',STATUS_ACTIVE);
		$criteria->compare('t.is_default',STATUS_ACTIVE);
		$criteria->limit = 1;
		$criteria->order ="id ASC";
		if($type=='image'){

			$one = TinNhaDatImage::model()->find($criteria);
			if(!empty($one))
			{
				$html ='';
				$html.='<img class="thumbnail" src="'.$one->getImageUrl('name', '100x100').'" style="width: 150px; height: 150px; margin-left:10px; float: left;" />';
				return $html;
			}
		}
		else if($type=="model")
			return TinNhaDatImage::model()->find($criteria);
	}


	public static function showAllImage($tin_nha_dat_id, $type='')
	{
		if(empty($tin_nha_dat_id)) return;
		$criteria = new CDbCriteria();
		// $criteria->compare('t.tin_nha_dat_id',$tin_nha_dat_id);
		$criteria->addCondition('t.tin_nha_dat_id='.$tin_nha_dat_id);
		$criteria->compare('t.status',STATUS_ACTIVE);
		// $criteria->limit = ;
		$criteria->order ="id ASC";
		if($type=='image'){

			$list = TinNhaDatImage::model()->findAll($criteria);
			if(!empty($list))
			{
				$html ='';
				foreach ($list as $one) 
				{
					$html.='<img class="thumbnail" src="'.$one->getImageUrl('name', '100x100').'" style="width: 100px; height: 100px; margin-left:10px; float: left;" />';
				}
				return $html;
			}
		}
		else if($type=="model")
			return TinNhaDatImage::model()->findAll($criteria);
	}


		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_tin_nha_dat_image}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('name, status, created_date, is_default, updated_date', 'required'),
			array('name, status, created_date, is_default, updated_date', 'safe'),
			array('status, is_default, tin_nha_dat_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('id, name, status, created_date, is_default, tin_nha_dat_id, updated_date', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('translation','Image'),
			'status' => Yii::t('translation','Status'),
			'created_date' => Yii::t('translation','Created Date'),
			'is_default' => Yii::t('translation','Is Default'),
			'tin_nha_dat_id' => Yii::t('translation','Tin Nha Dat'),
			'updated_date' => Yii::t('translation','Updated Date'),
		);
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('tin_nha_dat_id',$this->tin_nha_dat_id);
		$criteria->compare('updated_date',$this->updated_date,true);
					
		 
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

	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function nextOrderNumber()
	{
		return self::model()->count() + 1;
	}
	// public static function getListData()
	// {
	// 	$criteria = new CDbCriteria();
	// 	$criteria->compare('status', STATUS_ACTIVE);
	// 	$criteria->order ="order_display ASC";
	// 	$models = self::model()->findAll($criteria);

 //        return  array(''=>'---Chọn---') + CHtml::listData($models,'id','name');
	// }
	protected function beforeSave() 
	{
		if(empty($this->created_date))
		{
			$this->created_date = date('Y-m-d H:i:s');
		}
        $this->updated_date = date('Y-m-d H:i:s');
	    return parent::beforeSave();
	}


	public function deleteOne_ImageAndRecord()
	{	
		$model = TinNhaDatImage::model()->findByPk($this->id);
		if (!empty($model)) 
		{
		    if ($model->tin_nha_dat_id != 0) 
		    {
		        $source = $model->uploadImageFolder.'/' . $model->tin_nha_dat_id . '/' . $model->name;
		        if (file_exists($source))
		            unlink($source);
		        $model->deleteImages('name', $model->name);
		    }

		    if ($model->tin_nha_dat_id == 0) 
		    {
		        // $source = YII_UPLOAD_DIR . '/temp/'.$model->name;
		        $source = 'upload/temp/'.$model->name;
		        if (file_exists($source))
		            unlink($source);
		    }

		    if ($model->delete()) 
            {
                // echo 'delete_success';
            }
		}
	}


	public static function deleteAllImage($tin_nha_dat_id)
	{
		$a = new TinNhaDatImage();
		$list_image = $a->getAllImage($tin_nha_dat_id);
		foreach ($list_image as $one) 
		{
			if(!empty($one)) $one->deleteOne_ImageAndRecord();
		}
	}
}
