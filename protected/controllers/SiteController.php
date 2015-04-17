<?php
class SiteController extends FrontController
{

    public $attempts = MAX_TIME_TO_SHOW_CAPTCHA;
    public $counter;


        // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
        // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
       public function actionUploadingEAjax() 
       {
               Yii::import("ext.EAjaxUpload.qqFileUploader");
               // $key = Yii::app()->session['key'];
               $folder = 'upload/temp/'; // folder for uploaded files
               $allowedExtensions = array("jpg", "png", "gif"); //array("jpg","jpeg","gif","exe","mov" and etc...
               $sizeLimit = 2 * 1024 * 1024; // maximum file size in bytes
               $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
               //note: function $uploader->handleUpload is customed add more param name for function by MIKE
               $result = $uploader->handleUpload($folder, true, 'more-image-detail-'.md5(time()) );
               $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
               echo $return; // it's array


               // Yii::import("ext.EAjaxUpload.qqFileUploader");
                
               // $folder='upload/';// folder for uploaded files
               // $allowedExtensions = array("jpg");//array("jpg","jpeg","gif","exe","mov" and etc...
               // $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
               // $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
               // $result = $uploader->handleUpload($folder);
               // $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        
               // $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
               // $fileName=$result['filename'];//GETTING FILE NAME
        
               // echo $return;// it's array
       }


       public function actionAjaxRenderImageView() 
       {
               if (isset($_POST['filename'])) 
               {
                   $filename = $_POST['filename'];
                   $image = new TinNhaDatImage();
                   $image->status = STATUS_ACTIVE;
                   $image->tin_nha_dat_id = '0';
                   $image->name = $filename;
                   $image->is_default = TYPE_NO;
                   $image->created_date = date('Y-m-d H:i:s');
                   $image->save(false);

                   $idfile = $image->id;
                   $namefile = $image->name;
                   $linkfile = Yii::app()->baseUrl . '/upload/temp/' . $namefile;
                   echo $this->renderPartial('__image_view', array(
                       'idfile' => $idfile,
                       'namefile' => $namefile,
                       'linkfile' => $linkfile,
                       'image' => $image
                   ));
                   die;
               }
       }


       


       public function actionDeleteImageEajax() 
       {
           if (isset($_POST['id'])) 
           {
               $model = TinNhaDatImage::model()->findByPk($_POST['id']);
               if (!empty($model)) 
               {
                   if ($model->tin_nha_dat_id != 0) 
                   {
                       // $source = YII_UPLOAD_DIR . '/tin_nha_dat_image/' . $model->tin_nha_dat_id . '/' . $model->name;
                       // $source = 'upload/tin_nha_dat_image/' . $model->tin_nha_dat_id . '/' . $model->name;
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
                       echo 'delete_success';
                   }
               }
           }
       }



       // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
    // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 
       // 

















       public function actionGetHtmlMenuCon()
       {
           if(isset($_POST['parent_id']) && !empty($_POST['parent_id']) )
           {
               $criteria = new CDbCriteria();
               $criteria->compare('status', STATUS_ACTIVE);
               $criteria->addCondition('t.parent_id='.$_POST['parent_id']);

               $criteria->order ="order_display ASC";
               $models = CategoryTin::model()->findAll($criteria);
               $html ='';
               if(!empty($models))
               {
                   foreach ($models as $one) 
                   {
                       if(!empty($one)) $html.='<option value="'.$one->id.'">'.$one->name.'</option>';
                   }
               }
               echo $html;
               die;
           }
       }

    public function actionDangTin()
    {
        $this->pageTitle = 'Đăng Tin'.' - '.Yii::app()->setting->getItem('defaultPageTitle');
        if(Yii::app()->user->id)
        {
            $user = Users::model()->findByPk(Yii::app()->user->id);
            $model = new TinNhaDat('createFE');
            if (isset($_POST['TinNhaDat'])) 
            {
                $model->attributes = $_POST['TinNhaDat'];
                $model->view = 1;
                $model->is_duyet_tin = CHUA_DUYET;
                $model->order_display = 1;
                $model->status = STATUS_ACTIVE;
                $model->is_home = TYPE_NO;
                $model->is_hot = TYPE_NO;
                $model->user_id = Yii::app()->user->id;
                // order_display, status, is_home, is_hot,

                if($model->save())
                {   
                    if (isset($_POST['array_image'])) 
                    {
                        $array_image = $_POST['array_image'];
                        if (!empty($array_image)) 
                        {
                            $is_default_check = 0;
                            foreach ($array_image as $key => $value) 
                            {
                                $One_image_nha_dat = TinNhaDatImage::model()->findByPk($value);
                                if (!empty($One_image_nha_dat)) 
                                {
                                    if ($One_image_nha_dat->tin_nha_dat_id == 0) 
                                    {
                                        $ImageHelper = new ImageHelper();
                                        $ImageHelper->createDirectoryByPath( $One_image_nha_dat->uploadImageFolder.'/'. $One_image_nha_dat->id);
                                        $source = Yii::getPathOfAlias("webroot") . '/upload/temp/' . $One_image_nha_dat->name;
                                        $destination = Yii::getPathOfAlias("webroot") . '/'.$One_image_nha_dat->uploadImageFolder.'/'. $One_image_nha_dat->id . '/' . $One_image_nha_dat->name;
                                        if (file_exists($source)) 
                                        {
                                            copy($source, $destination);
                                                $One_image_nha_dat->resizeImage('name');
                                            unlink($source);
                                        }

                                        if (file_exists($destination)) //xoa hinh trong thu mục copy qua
                                        {
                                            unlink($destination);
                                        }

                                    }
                                    $One_image_nha_dat->tin_nha_dat_id = $model->id;
                                    if(!isset($_POST['is_default']) && $is_default_check == 0 )
                                    {
                                        $One_image_nha_dat->is_default = TYPE_YES;
                                        $is_default_check = 1;
                                    }
                                    else
                                    if(isset($_POST['is_default']) && $_POST['is_default']==$One_image_nha_dat->id && $is_default_check == 0 )
                                    {
                                        $One_image_nha_dat->is_default = TYPE_YES;
                                        $is_default_check = 1;
                                    }   
                                    else {
                                        $One_image_nha_dat->is_default = TYPE_NO;
                                    }
                                    $One_image_nha_dat->save();
                                }
                            }

                        }
                    }
                    $criteria = new CDbCriteria;
                    $criteria->addCondition('tin_nha_dat_id=0');
                    TinNhaDatImage::model()->deleteAll($criteria);

                    $this->setNotifyMessage(NotificationType::Success, 'Đăng tin thành công, đợi admin duyệt.' );
                    $this->redirect(array('dangTin'));
                }
                else
                    $this->setNotifyMessage(NotificationType::Error, 'Đăng tin thất bại, có lỗi xảy ra.');
            }
                    // $this->render('create', array(
                    //     'model' => $model,
                    //     'actions' => $this->listActionsCanAccess,
                    // ));
            $this->render('dangTin', array(
                'user' => $user ,
                'model' => $model,
                // 'list_tin_moi' => $list_tin_moi ,
                // 'list_xem_nhieu' => $list_xem_nhieu ,
            ));
        }else
            throw new CHttpException(404, 'Yêu cầu của bạn không hợp lệ. Đăng Tin Error');
    }


    public function actionEditTinDetail($slug) 
    {
        if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )// đã logged
        {
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
            // throw new CHttpException(404, 'Invalid request.');
        }

        $criteria = new CDbCriteria();
        $criteria->compare('t.status',STATUS_ACTIVE);
        $criteria->compare('t.slug',$slug);
        $model = TinNhaDat::model()->find($criteria);
        $model->scenario ='createFE';
        // $model->scenario ='updateFE';

        $user = Users::model()->findByPk(Yii::app()->user->id);
        
        $this->pageTitle = 'Sửa Tin - '.Yii::app()->setting->getItem('defaultPageTitle');
        if(isset($_POST['TinNhaDat']))
        {
            $model->attributes=$_POST['TinNhaDat'];
            $model->is_duyet_tin = CHUA_DUYET;
            $model->order_display = 1;
            $model->status = STATUS_ACTIVE;
            $model->is_home = TYPE_NO;
            $model->is_hot = TYPE_NO;
            $model->user_id = Yii::app()->user->id;

            if ($model->save())
            {               
                if (isset($_POST['array_image'])) 
                {
                    $array_image = $_POST['array_image'];
                    if (!empty($array_image)) 
                    {
                        $is_default_check = 0;
                        foreach ($array_image as $key => $value) 
                        {
                            $One_image_nha_dat = TinNhaDatImage::model()->findByPk($value);
                            if (!empty($One_image_nha_dat)) 
                            {
                                if ($One_image_nha_dat->tin_nha_dat_id == 0) 
                                {
                                    $ImageHelper = new ImageHelper();
                                    $ImageHelper->createDirectoryByPath( $One_image_nha_dat->uploadImageFolder.'/'. $One_image_nha_dat->id);
                                    $source = Yii::getPathOfAlias("webroot") . '/upload/temp/' . $One_image_nha_dat->name;
                                    $destination = Yii::getPathOfAlias("webroot") . '/'.$One_image_nha_dat->uploadImageFolder.'/'. $One_image_nha_dat->id . '/' . $One_image_nha_dat->name;
                                    if (file_exists($source)) 
                                    {
                                        copy($source, $destination);
                                            $One_image_nha_dat->resizeImage('name');
                                        unlink($source);
                                    }
                                    if (file_exists($destination)) 
                                    {
                                        unlink($destination);
                                    }
                                }
                                $One_image_nha_dat->tin_nha_dat_id = $model->id;
                                if(!isset($_POST['is_default']) && $is_default_check == 0 )
                                {
                                    $One_image_nha_dat->is_default = TYPE_YES;
                                    $is_default_check = 1;
                                }
                                else
                                if(isset($_POST['is_default']) && $_POST['is_default']==$One_image_nha_dat->id && $is_default_check == 0 )
                                {
                                    $One_image_nha_dat->is_default = TYPE_YES;
                                    $is_default_check = 1;
                                }   
                                else {
                                    $One_image_nha_dat->is_default = TYPE_NO;
                                }
                                $One_image_nha_dat->save();
                            }
                        }
                    }
                }

                $criteria = new CDbCriteria;//xoa het cac record co tin_nha_dat_id=0
                $criteria->addCondition('tin_nha_dat_id=0');
                TinNhaDatImage::model()->deleteAll($criteria);

                $this->setNotifyMessage(NotificationType::Success,'Sửa Tin thành công');
                $this->redirect(array('EditTinDetail', 'slug'=> $model->slug));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, 'Sửa Tin lỗi!');
        }

        $this->render('dangTinEdit', array(
            'user' => $user,
            'model' => $model,
        ));
    }


    public function actionMyProfile()
    {
        $this->pageTitle = 'My Profile'.' - '.Yii::app()->setting->getItem('defaultPageTitle');
        if(Yii::app()->user->id)
        {
            $model = Users::model()->findByPk(Yii::app()->user->id);
            $oldpass = $model->temp_password;
            if(isset($_POST['Users']) )
            {
                $model->attributes=$_POST['Users'];
                if(!empty($_POST['Users']['currentPassword']) || !empty($_POST['Users']['newPassword']) || !empty($_POST['Users']['password_confirm']) )
                {
                    $model->scenario = 'changeMyPassword';
                    $model->password_confirm = $_POST['Users']['password_confirm'];
                }
                else
                {
                    $model->scenario = 'changeMyProfile';
                    $model->password_hash = md5($oldpass);
                    $model->temp_password = $oldpass;
                }
                
                if($model->validate())
                {
                    if($model->save()) 
                    {
                        if($model->scenario == 'changeMyPassword')
                        {
                            $model->password_hash = md5($model->newPassword);
                            $model->temp_password = $model->newPassword;
                            $model->update(array('password_hash', 'temp_password'));
                        }
                        // SendEmail::changePassMailToUser($model);
                        // Yii::app()->user->setFlash('successChangeMyPassword', "Your profile and password has been successfully changed.");
                        $this->setNotifyMessage(NotificationType::Success, 'Your profile and password has been successfully changed.' );
                        $this->redirect( array('myProfile') );
                    }
                }
            }
            $this->render('myProfile', array(
                // 'user' => $user ,
                'model' => $model ,
                // 'list_tin_moi' => $list_tin_moi ,
                // 'list_xem_nhieu' => $list_xem_nhieu ,
            ));
        }else
            throw new CHttpException(404, 'Yêu cầu của bạn không hợp lệ. My Profile Error');
    }


    public function actionLogout() 
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->createAbsoluteUrl('site/login'));
    }

    public function actionIndex()
    {
        $this->pageTitle = Yii::app()->setting->getItem('defaultPageTitle');
        
        $a = new TinNhaDat;
        $b = new TinNhaDat; 
        $c = new TinNhaDat; 

        if(isset($_GET) && !empty($_GET) )
        {
            $a->attributes = $_GET['TinNhaDat'];
            $b->attributes = $_GET['TinNhaDat'];
            $c->attributes = $_GET['TinNhaDat'];

            $list_noi_bat = $a->searchNoiBat($_GET);

            $list_tin_moi = $b->searchMoiNhat($_GET);

            $list_xem_nhieu = $c->searchXemNhieu($_GET);

        }else{
            $list_noi_bat = $a->searchNoiBat();

            $list_tin_moi = $b->searchMoiNhat();

            $list_xem_nhieu = $c->searchXemNhieu();

        }


        $this->render('index', array(
            'list_noi_bat' => $list_noi_bat ,
            'list_tin_moi' => $list_tin_moi ,
            'list_xem_nhieu' => $list_xem_nhieu ,
        ));
    }

    public function actionListTin($parent_slug='', $children_slug='') //list tin nha dat
    {
        $this->pageTitle = 'Tin Nhà Đất - '. Yii::app()->setting->getItem('defaultPageTitle');
        $aa = new TinNhaDat();
        $cate_cha = NULL;
        $cate_con = NULL;
        $breadcrum ='';
// parent_slug=ban-dat&children_slug=all
        if($parent_slug!='' && !empty($parent_slug)  )
        {
            $cate_cha = CategoryTin::getDetailBySlug($parent_slug);
            if(!empty($cate_cha))
            {
                $search['s_dich_vu']=$cate_cha->id;
                $breadcrum = $cate_cha->name;
                $this->pageTitle = $cate_cha->name.' - '. Yii::app()->setting->getItem('defaultPageTitle');
                if($children_slug!='' && !empty($children_slug) && $children_slug!='all' )
                {
                    $cate_con = CategoryTin::getDetailBySlug($children_slug);
                    if(!empty($cate_con))
                    {
                       $search['s_khu_vuc']=$cate_con->id; 
                       $breadcrum .=' <span class="glyphicon glyphicon-arrow-right"></span> '. $cate_con->name;
                    } 
                }
                $list_nha_dat = $aa->searchListTin($search);
            }

            
        }
        
        if(isset($_GET['TinNhaDat']))
        {
            $aa->attributes = $_GET['TinNhaDat'];

            $list_nha_dat = $aa->searchListTin($_GET['TinNhaDat']);

            if(!empty($aa->s_dich_vu))
                $cate_cha = CategoryTin::model()->findByPk($aa->s_dich_vu);
            if(!empty($aa->s_khu_vuc))
                $cate_con = CategoryTin::model()->findByPk($aa->s_khu_vuc);

            if(!empty($cate_cha))
            {
                $breadcrum = $cate_cha->name;
                $this->pageTitle = $cate_cha->name.' - '. Yii::app()->setting->getItem('defaultPageTitle');
                if(!empty($cate_con)) $breadcrum .=' <span class="glyphicon glyphicon-arrow-right"></span> '. $cate_con->name;
            } 
        }

        if( empty($parent_slug) && !isset($_GET['TinNhaDat']) )
            $list_nha_dat = $aa->searchListTin();

        $this->render('nha_dat/list_tin_nha_dat', array(
            'list_nha_dat' => $list_nha_dat,
            'cate_cha'=>$cate_cha,
            'cate_con'=>$cate_con,
            'breadcrum'=>$breadcrum,

        ));
    }
    public function actionTinDetail($slug)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status',STATUS_ACTIVE);
        $criteria->compare('t.slug',$slug);
        $model = TinNhaDat::model()->find($criteria);
        if(!empty($model))
        {
            $model->view = $model->view +1;
            $model->update( array('view') );
            $this->pageTitle = $model->title. ' - ' . Yii::app()->params['defaultPageTitle'];

            $a = new TinNhaDat;
            $list_nha_dat = $a->searchTinLienQuan($model->category_parent_id);

            $this->render('nha_dat/tin_detail', array(
                'model' => $model,
                'list_nha_dat'=>$list_nha_dat,
                // 'dataProvider'=>$dataProvider,
            ));
        }else
            throw new CHttpException(404, 'Sorry! The request page does not exist.');

    }


    public function actionLogin() {
        if (Yii::app()->user->id && Yii::app()->user->id != '')// đã logged
        {
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
            // throw new CHttpException(404, 'Invalid request.');
        }

        $this->pageTitle = 'Đăng Nhập - '.Yii::app()->setting->getItem('defaultPageTitle');

        $model = new LoginForm();
        $model->login_by = 'username'; //login by username or email.
        // $returnUrl = '';
        // if (isset($_GET['returnUrl'])) {
        //     $returnUrl = urldecode($_GET['returnUrl']);
        // }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate()) 
            {
                
                // if (!empty($returnUrl)) {
                //  $this->redirect(Yii::app()->createAbsoluteUrl($returnUrl));
                // }
                // if (strpos(Yii::app()->user->returnUrl, '/index.php') === false)
                //  $this->redirect(Yii::app()->user->returnUrl);

                switch (Yii::app()->user->role_id) {
                    case ROLE_ADMIN:
                        Yii::app()->user->logout();
                        $this->redirect(Yii::app()->createAbsoluteUrl('admin/site/login'));
                        break;
                    case ROLE_MEMBER:
                        // $this->redirect(Yii::app()->createAbsoluteUrl('member/site/userDashboard'));
                        $this->redirect(Yii::app()->createAbsoluteUrl('thanhvien/index'));
                        break;

                    //Store User Owner
                    // case ROLE_OWNER:
                    //     $this->redirect(Yii::app()->createAbsoluteUrl('member/owner/dashboard'));
                    //     break;

                    // default :
                    // $this->redirect(Yii::app()->createAbsoluteUrl('member/site/updateProfile'));
                    // $this->redirect(Yii::app()->createAbsoluteUrl('site/index'));
                }
            } else {
                
            }
        }

        $this->render('login', array(
            'model' => $model,
        ));
    }






















    

    
    /*public function actionVideo()
    {
        $this->pageTitle = 'Video ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $this->render('video_home', array(
            // 'model' => $model,
        ));
    }
    public function actionListVideo($slug)
    {
        $this->pageTitle = 'Video ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $criteria = new CDbCriteria();
        $criteria->compare('t.slug',$slug);
        $c_video = CategoryVideo::model()->find($criteria);
        if(empty($c_video))
        {
            throw new CHttpException(404, 'The request page does not exist.');
        }
        $this->pageTitle = $c_video->name. ' - ' . Yii::app()->params['defaultPageTitle'];
        
        // $model=new Video('search');
        // $model->category_video_id = $c_video->id;
        // $model->status = 1;
        // // $model->unsetAttributes();
        // if(isset($_GET['Video']))
        //     $model->attributes=$_GET['Video'];

        $criteria = new CDbCriteria;
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->compare('t.category_video_id', $c_video->id);
        $dataProvider =  new CActiveDataProvider('Video', array(
            'criteria' => $criteria,
            'pagination' => array(
                    'pageSize' => 10,
                    // 'pageSize' => Yii::app()->params['defaultPageSize'],
            ),
            'sort' => array(
                'defaultOrder' => 't.id DESC'
            )
        ));

        $this->render('video_list', array(
            // 'model' => $model,
            'title'=>$c_video->name,
            'dataProvider'=>$dataProvider,
        ));
    }*/


   /*public function actionListTin()
    {
        $p_slug = $_GET['p_slug'];
        $c_slug = $_GET['c_slug'];
        $breadcrum = '';
        if($c_slug!='' && !empty($c_slug))
        {
            $c_cate_tin = CategoryTin::getDetailBySlug($c_slug);
            if(!empty($c_cate_tin))
            {
                $criteria = new CDbCriteria;
                $criteria->compare('t.status', STATUS_ACTIVE);
                $criteria->compare('t.category_sub_id', $c_cate_tin->id);
                $dataProvider =  new CActiveDataProvider('ThoiSu', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                            // 'pageSize' => 10,
                            'pageSize'=>Yii::app()->setting->getItem('pageSizeListTin'),
                            // 'pageSize' => Yii::app()->params['defaultPageSize'],
                    ),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC'
                    )
                ));
                $title = $c_cate_tin->name;
                $this->pageTitle = $c_cate_tin->name. ' - ' . Yii::app()->params['defaultPageTitle'];
                //breadcrum
                $sub = $c_cate_tin;
                $parent = CategoryTin::getDetailBySlug($p_slug);
                if(!empty($sub) && !empty($parent))
                {
                    $breadcrum.='<span class="main-cat-title">';
                    $breadcrum.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
                    $breadcrum.='<span class="glyphicon glyphicon-fast-forward"> > </span>';
                    $breadcrum.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>$sub->slug )).'">'.$sub->name.'</a>';
                    $breadcrum.='</span>';
                }

            }else 
                throw new CHttpException(404, 'Sorry! The request page does not exist.');
        }else if( empty($c_slug) && !empty($p_slug) )
        {
            $p_cate_tin = CategoryTin::getDetailBySlug($p_slug);
            if(!empty($p_cate_tin))
            {
                $criteria = new CDbCriteria;
                $criteria->compare('t.status', STATUS_ACTIVE);
                $criteria->compare('t.category_parent_id', $p_cate_tin->id);
                $dataProvider =  new CActiveDataProvider('ThoiSu', array(
                    'criteria' => $criteria,
                    'pagination' => array(
                            // 'pageSize' => 10,
                        'pageSize'=>Yii::app()->setting->getItem('pageSizeListTin'),
                            // 'pageSize' => Yii::app()->params['defaultPageSize'],
                    ),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC'
                    )
                ));
                $title = $p_cate_tin->name;
                $this->pageTitle = $p_cate_tin->name. ' - ' . Yii::app()->params['defaultPageTitle'];
                //breadcrum
                $parent = $p_cate_tin;
                if( !empty($parent))
                {
                    $breadcrum.='<span class="main-cat-title">';
                    $breadcrum.='<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$parent->slug, 'c_slug'=>'' )).'">'.$parent->name.'</a>';
                    $breadcrum.='</span>';
                }
            }
        }

        $this->render('list_tin', array(
            // 'model' => $model,
            'title'=>$title,
            'dataProvider'=>$dataProvider,
            'breadcrum'=>$breadcrum,
        ));
    }*/

    

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('actions'),
                'users' => array('*'),
            ),
        );
    }
    
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
            'ajax.'=>'application.components.widget.RegistorWidget',
            'ajaxlogin.'=>'application.components.widget.LoginWidget',
            'ajaxjoin.'=>'application.components.widget.JoinWidget',
        );
    }
    
    private function captchaRequired() {
        return Yii::app()->session->itemAt('captchaRequired') >= $this->attempts;
    }
    
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    protected function performAjaxValidation($model)
    {
        try {
            if (isset($_POST['ajax'])) {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw  new CHttpException("Exception " . print_r($e, true));
        }
    }


    

    /*public function actionContactUs()
    {
        $this->pageTitle = 'Contact Us ' . ' - ' . Yii::app()->params['defaultPageTitle'];
        $this->showFullScreen =true;
        $this->showBanner     = false;
        $model = new ContactForm('create');
        //auto fill
        // if (isset(Yii::app()->user->id)) {
        //     $mUser = Users::model()->findByPk(Yii::app()->user->id);
        //     if ($mUser) {
        //         $model->name = $mUser->full_name;
        //         $model->email = $mUser->email;
        //         $model->phone = $mUser->phone;
        //         $model->company = $mUser->company;
        //     }

        // }
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) 
            {
                $model->message = '<br>' . nl2br($model->message);
                
                if (!empty($model->email)) 
                {
                    SendEmail::confirmContactMailToUser($model);
                }
                SendEmail::sendContactMailToAdmin($model);

                Yii::app()->user->setFlash('msg', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            } else {
                Yii::log(print_r($model->getErrors(), true), 'error', 'SiteController.actionContact');
            }
        }

        $this->render('contact_us', array(
            'model' => $model,
        ));
    }*/

    public function actionAboutUs()
    {
        $page = Page::model()->findByPk(8);
        $this->redirect( Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>$page->slug)) );
    }

    public function actionContactUs()
    {
        $page = Page::model()->findByPk(29);
        $this->redirect( Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>$page->slug)) );
    }



    public function actionQuyDinhSuDung()
    {
        $page = Page::model()->findByPk(57);
        $this->redirect( Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>$page->slug)) );
    }

    public function actionHuongDanDangTin()
    {
        $page = Page::model()->findByPk(58);
        $this->redirect( Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>$page->slug)) );
    }

    public function actionDieuKhoanChinhSach()
    {
        $page = Page::model()->findByPk(59);
        $this->redirect( Yii::app()->createAbsoluteUrl('cms/index', array('slug'=>$page->slug)) );
    }



}