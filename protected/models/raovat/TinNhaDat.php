<?php

/**
 * This is the model class for table "{{_tin_nha_dat}}".
 *
 * The followings are the available columns in table '{{_tin_nha_dat}}':
 * @property integer $id
 * @property string $title
 * @property string $short_content
 * @property string $content
 * @property string $image
 * @property string $get_from
 * @property integer $category_parent_id
 * @property integer $category_sub_id
 * @property integer $user_id
 * @property integer $order_display
 * @property integer $status
 * @property integer $view
 * @property string $slug
 * @property integer $is_home
 * @property integer $is_hot
 * @property integer $is_default
 * @property string $created_date
 * @property string $updated_date
 */
class TinNhaDat extends _BaseModel 
{
	public $s_title;
	public $s_khu_vuc;
	public $s_dich_vu;
	public $s_gia;
	public $s_dien_tich;

	public $product_photo;

	public static $arr_duyet_tin = array(
		DA_DUYET =>'Đã Duyệt',
		CHUA_DUYET => 'Chưa Duyệt',
		KHONG_DUYET => 'Không duyệt',
	);

	public static $arr_can_ban_gap = array(
		NHA_BAN_GAP =>'Nhà bán gấp',
		DAT_BAN_GAP => 'Đất bán gấp',
	);

	
	// public $maxImageFileSize = 3145728; //3MB
	// public $allowImageType = 'jpg,gif,png';
	// public $uploadImageFolder = 'upload/tin_nha_dat_image'; //remember remove ending slash
	// public $defineImageSize = array(
	// 		'image' => array(
	// 			array('alias' => '100x100', 'size' => '100x100'),
	// 			//array('alias' => 'SIZE_IN_LOCAL_CONFIG', 'size' => 'SIZE_IN_LOCAL_CONFIG'),
	// 		), 
	// );	
		/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_tin_nha_dat}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('can_ban_gap, sdt_lien_he, dia_chi, ten_nguoi_dang, dien_tich,title, short_content, content, image, get_from, category_parent_id, category_sub_id, user_id, order_display, status, view, slug, is_home, is_hot, is_default, created_date, updated_date', 'safe'),
			array('title, short_content, content, category_parent_id, order_display, status, is_home, is_hot, is_duyet_tin', 'required', 'on'=>'createBE, updateBE'),
			array('title, short_content, content, category_parent_id, order_display, status, is_home, is_hot, is_duyet_tin, sdt_lien_he, dia_chi, ten_nguoi_dang', 'required', 'on'=>'createFE, updateFE'),
			array('category_parent_id, category_sub_id, user_id, order_display, status, view, is_home, is_hot, is_default', 'numerical', 'integerOnly'=>true),
			array('title, image, slug', 'length', 'max'=>200),
			array('get_from', 'length', 'max'=>100),
		 
			// array('image', 'file', 'on' => 'create,update',
			// 	'allowEmpty' => true,
			// 	'types' => $this->allowImageType,
			// 	'wrongType' => 'Only ' . $this->allowImageType . ' are allowed.',
			// 	'maxSize' => $this->maxImageFileSize, // 3MB
			// 	'tooLarge' => 'The file was larger than' . ($this->maxImageFileSize/1024)/1024 . 'MB. Please upload a smaller file.',
			// ), 
			array('is_duyet_tin, id, title, short_content, content, image, get_from, category_parent_id, category_sub_id, user_id, order_display, status, view, slug, is_home, is_hot, is_default, created_date, updated_date', 'safe', 'on'=>'search'),
			array('s_title,s_khu_vuc,s_dich_vu,s_gia,s_dien_tich', 'safe'),

			array('gia', 'numerical'),
			array('sdt_lien_he', 'checkPhone'),
		);
	}

	public function checkPhone($attribute,$params)
	{
	    if($this->$attribute != ''){
	        $pattern ='/^[\(]?(\+)?(\d{0,3})[\)]?[\s]?[\-]?(\d{0,9})[\s]?[\-]?(\d{0,9})[\s]?[x]?(\d*)$/';
	        $containsDigit = preg_match($pattern,$this->$attribute);
	        $lb = $this->getAttributeLabel($attribute);
	        if(!$containsDigit)
	            $this->addError($attribute,"$lb bao gồm số và các kí tự (),+,-");
	    }
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
			'title' => Yii::t('translation','Tiêu Đề'),
			'short_content' => Yii::t('translation','Miêu Tả Ngắn'),
			'content' => Yii::t('translation','Nội Dung'),
			'image' => Yii::t('translation','Image'),
			'get_from' => Yii::t('translation','Get From'),
			'category_parent_id' => Yii::t('translation','Menu Cha'),
			'category_sub_id' => Yii::t('translation','Menu Con'),
			'user_id' => Yii::t('translation','User'),
			'order_display' => Yii::t('translation','Sắp Xếp'),
			'status' => Yii::t('translation','Status'),
			'view' => Yii::t('translation','View'),
			'slug' => Yii::t('translation','Slug'),
			'is_home' => Yii::t('translation','Is Home'),
			'is_hot' => Yii::t('translation','Is Hot'),
			'is_default' => Yii::t('translation','Is Default'),
			'created_date' => Yii::t('translation','Ngày Tạo'),
			'updated_date' => Yii::t('translation','Ngày Sửa'),
			'product_photo' => Yii::t('translation','Hình Ảnh'),
			'sdt_lien_he' => Yii::t('translation','Số Điện Thoại'),
			'dia_chi' => Yii::t('translation','Địa Chỉ'),
			'ten_nguoi_dang' => Yii::t('translation','Người Đăng'),
			'dien_tich' => Yii::t('translation','Diện Tích'),
			'gia' => Yii::t('translation','Giá'),
			'is_duyet_tin' => Yii::t('translation','Duyệt Tin'),
			'can_ban_gap' => Yii::t('translation','Cần Bán Gấp'),
		);
	}

	public function searchThanhVien_daduyet($user_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('can_ban_gap',$this->can_ban_gap);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_duyet_tin',DA_DUYET);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
			$criteria->order = 'updated_date DESC, id DESC';
		
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchThanhVien_chuaduyet($user_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('can_ban_gap',$this->can_ban_gap);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_duyet_tin',CHUA_DUYET);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
			$criteria->order = 'updated_date DESC, id DESC';
		
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchThanhVien_khongduyet($user_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('can_ban_gap',$this->can_ban_gap);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_duyet_tin',KHONG_DUYET);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
			$criteria->order = 'updated_date DESC, id DESC';
		
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('can_ban_gap',$this->can_ban_gap);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_duyet_tin',$this->is_duyet_tin);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
			$criteria->order = 'updated_date DESC, id DESC';
		// 		$sort = new CSort();

  //       $sort->attributes = array(
  //           'name' => array(
  //               'asc' => 't.title',
  //               'desc' => 't.title desc',
  //               'default' => 'asc',
  //           ),
  //       );
		// $sort->defaultOrder = 't.title asc';
					
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchChuaDuyet()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('can_ban_gap',$this->can_ban_gap);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_duyet_tin', CHUA_DUYET);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
			$criteria->order = 'updated_date DESC, id DESC';
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}

	public function searchKhongDuyet()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('short_content',$this->short_content,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('order_display',$this->order_display);
		$criteria->compare('status',$this->status);
		$criteria->compare('can_ban_gap',$this->can_ban_gap);
		$criteria->compare('view',$this->view);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('is_home',$this->is_home);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_default',$this->is_default);
		$criteria->compare('is_duyet_tin', KHONG_DUYET);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		if(!isset($_GET['ajax']))
			$criteria->order = 'updated_date DESC, id DESC';
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                'pageSize'=> Yii::app()->params['defaultPageSize'],
            ),
		));
	}


	public function searchTinLienQuan($category_parent_id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		// $criteria->compare('id',$this->id);
		// $criteria->compare('title',$this->title,true);
		// $criteria->compare('short_content',$this->short_content,true);
		// $criteria->compare('content',$this->content,true);
		// $criteria->compare('image',$this->image,true);
		// $criteria->compare('get_from',$this->get_from,true);
		$criteria->compare('category_parent_id',$category_parent_id);
		$criteria->compare('is_duyet_tin',DA_DUYET);
		
		// $criteria->compare('category_sub_id',$this->category_sub_id);
		// $criteria->compare('user_id',$this->user_id);
		// $criteria->compare('order_display',$this->order_display);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('view',$this->view);
		// $criteria->compare('slug',$this->slug,true);
		// $criteria->compare('is_home',$this->is_home);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_default',$this->is_default);
		// $criteria->compare('created_date',$this->created_date,true);
		// $criteria->compare('updated_date',$this->updated_date,true);
		 
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 10,
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
                'columns' => array('title'),
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
	public static function getListData()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('status', STATUS_ACTIVE);
		$criteria->order ="order_display ASC";
		$models = self::model()->findAll($criteria);

        return  array(''=>'---Chọn---') + CHtml::listData($models,'id','name');
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



	public function searchNoiBat($search='')
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('is_duyet_tin',DA_DUYET);
		if(isset($search['TinNhaDat']['s_dien_tich']) && !empty($search['TinNhaDat']['s_dien_tich']) )
		{
			$dien_tich = DienTich::model()->findByPk($search['TinNhaDat']['s_dien_tich']);
			if(!empty($dien_tich))
			{
				$criteria->addCondition('t.dien_tich >='.$dien_tich->min.' AND t.dien_tich <='.$dien_tich->max);
			}
		}

		if(isset($search['TinNhaDat']['s_gia']) && !empty($search['TinNhaDat']['s_gia']) )
		{
			$gia = Gia::model()->findByPk($search['TinNhaDat']['s_gia']);
			if(!empty($gia))
			{
				$criteria->addCondition('t.gia >='.$gia->min_price.' AND t.gia <='.$gia->max_price);
			}
		}
		// $criteria->compare('order_display',$this->order_display);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('view',$this->view);
		// $criteria->compare('is_home',$this->is_home);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_default',$this->is_default);
		$criteria->addCondition('t.is_hot='.TYPE_YES.' AND t.status='.STATUS_ACTIVE);
		$criteria->order = 'order_display DESC, updated_date DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 10,
            ),
		));
	}

	public function searchMoiNhat($search='')
	{
		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('is_duyet_tin',DA_DUYET);
		if(isset($search['TinNhaDat']['s_dien_tich']) && !empty($search['TinNhaDat']['s_dien_tich']) )
		{
			$dien_tich = DienTich::model()->findByPk($search['TinNhaDat']['s_dien_tich']);
			if(!empty($dien_tich))
			{
				$criteria->addCondition('t.dien_tich >='.$dien_tich->min.' AND t.dien_tich <='.$dien_tich->max);
			}
		}

		if(isset($search['TinNhaDat']['s_gia']) && !empty($search['TinNhaDat']['s_gia']) )
		{
			$gia = Gia::model()->findByPk($search['TinNhaDat']['s_gia']);
			if(!empty($gia))
			{
				$criteria->addCondition('t.gia >='.$gia->min_price.' AND t.gia <='.$gia->max_price);
			}
		}
		// $criteria->compare('order_display',$this->order_display);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('view',$this->view);
		// $criteria->compare('is_home',$this->is_home);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_default',$this->is_default);
		$criteria->addCondition('t.is_home='.TYPE_YES.' AND t.status='.STATUS_ACTIVE);
		$criteria->order = 'updated_date DESC, order_display DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 10,
            ),
		));
	}

	public function searchXemNhieu($search='')
	{
		$criteria=new CDbCriteria;

		$criteria->compare('title',$this->title,true);
		$criteria->compare('category_parent_id',$this->category_parent_id);
		$criteria->compare('category_sub_id',$this->category_sub_id);
		$criteria->compare('is_duyet_tin',DA_DUYET);
		if(isset($search['TinNhaDat']['s_dien_tich']) && !empty($search['TinNhaDat']['s_dien_tich']) )
		{
			$dien_tich = DienTich::model()->findByPk($search['TinNhaDat']['s_dien_tich']);
			if(!empty($dien_tich))
			{
				$criteria->addCondition('t.dien_tich >='.$dien_tich->min.' AND t.dien_tich <='.$dien_tich->max);
			}
		}

		if(isset($search['TinNhaDat']['s_gia']) && !empty($search['TinNhaDat']['s_gia']) )
		{
			$gia = Gia::model()->findByPk($search['TinNhaDat']['s_gia']);
			if(!empty($gia))
			{
				$criteria->addCondition('t.gia >='.$gia->min_price.' AND t.gia <='.$gia->max_price);
			}
		}
		// $criteria->compare('order_display',$this->order_display);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('view',$this->view);
		// $criteria->compare('is_home',$this->is_home);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_default',$this->is_default);
		// $criteria->addCondition('t.is_home='.TYPE_YES.' AND t.status='.STATUS_ACTIVE);
		$criteria->addCondition('t.status='.STATUS_ACTIVE);
		$criteria->order = 't.view DESC, t.updated_date DESC, t.order_display DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 20,
            ),
		));
	}
	

	public function searchListTin($search='')
	{
		$criteria=new CDbCriteria;
		$criteria->compare('is_duyet_tin',DA_DUYET);
		$criteria->compare('title',$this->title,true);
		if(!empty($search['s_dich_vu']))
		{
			$criteria->addCondition('category_parent_id='.$search['s_dich_vu']);
		}

		if(!empty($search['s_khu_vuc']))
		{
			$criteria->addCondition('category_sub_id='.$search['s_khu_vuc']);
		}

		// $criteria->compare('category_parent_id',$this->category_parent_id);
		// $criteria->compare('category_sub_id',$this->category_sub_id);

		if(isset($search['s_dien_tich']) && !empty($search['s_dien_tich']) )
		{
			$dien_tich = DienTich::model()->findByPk($search['s_dien_tich']);
			if(!empty($dien_tich))
			{
				$criteria->addCondition('t.dien_tich >='.$dien_tich->min.' AND t.dien_tich <='.$dien_tich->max);
			}
		}

		if(isset($search['s_gia']) && !empty($search['s_gia']) )
		{
			$gia = Gia::model()->findByPk($search['s_gia']);
			if(!empty($gia))
			{
				$criteria->addCondition('t.gia >='.$gia->min_price.' AND t.gia <='.$gia->max_price);
			}
		}
		// $criteria->compare('order_display',$this->order_display);
		// $criteria->compare('status',$this->status);
		// $criteria->compare('view',$this->view);
		// $criteria->compare('is_home',$this->is_home);
		// $criteria->compare('is_hot',$this->is_hot);
		// $criteria->compare('is_default',$this->is_default);
		// $criteria->addCondition('t.is_home='.TYPE_YES.' AND t.status='.STATUS_ACTIVE);
		$criteria->addCondition('t.status='.STATUS_ACTIVE);
		$criteria->order = 't.updated_date DESC, t.order_display DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                // 'pageSize'=> Yii::app()->params['defaultPageSize'],
                'pageSize'=> 20,
            ),
		));
	}
}
