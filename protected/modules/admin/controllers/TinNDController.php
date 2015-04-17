<?php

class TinNDController extends AdminController
{
    public $pluralTitle = 'Tin Nhà Đất';
    public $singleTitle = 'Tin Nhà Đất';
    public $cannotDelete = array();


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


    public function actionCreate()
    {
        $model = new TinNhaDat('createBE');
        if (isset($_POST['TinNhaDat'])) {
            $model->attributes = $_POST['TinNhaDat'];
            $model->view = 1;
            // $model->is_duyet_tin = DA_DUYET;
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

				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                $this->redirect(array('view', 'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
        }
        $this->render('create', array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
        ));
    }

    public function actionDelete($id) {
        try {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if($model = $this->loadModel($id))
					{
                        $tin_nha_dat_id = $model->id;
						if($model->delete())
						{
                            TinNhaDatImage::deleteAllImage($tin_nha_dat_id);
							//Yii::log("Delete record ".  print_r($model->attributes, true), 'info');
						}
					}

					// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
					if(!isset($_GET['ajax']))
						$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
            } else {
                //Yii::log("Invalid request. Please do not repeat this request again.");
                //throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
            }
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }      
    
    public function actionIndex() {
        try {
            $model=new TinNhaDat('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['TinNhaDat']))
                $model->attributes=$_GET['TinNhaDat'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }

    public function actionIndexChuaDuyet() {
        try {
            $model=new TinNhaDat('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['TinNhaDat']))
                $model->attributes=$_GET['TinNhaDat'];
            $model->is_duyet_tin = CHUA_DUYET;
            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }

    public function actionIndexKhongDuyet() {
        try {
            $model=new TinNhaDat('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['TinNhaDat']))
                $model->attributes=$_GET['TinNhaDat'];
            $model->is_duyet_tin = KHONG_DUYET;
            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
        } catch (Exception $e) {
            //Yii::log("Exception ".  print_r($e, true), 'error');
            //throw  new CHttpException($e);
        }
    }

    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        $model->scenario ='updateBE';
        if(isset($_POST['TinNhaDat']))
        {
            $model->attributes=$_POST['TinNhaDat'];
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

				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view', 'id'=> $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->title        ));
    }

    
    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->title            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDelete variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['tin-nha-dat-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
			TinNhaDat::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
            foreach ($shouldDelete as $key => $value) 
            {
                TinNhaDatImage::deleteAllImage($value);
            }
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
		
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new TinNhaDat();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}