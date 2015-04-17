<?php

class BannersController extends AdminController
{

	public $pluralTitle = 'Home Banner Management';
    public $singleTitle = 'Home Banner';
	public $cannotDelete = array();

	public function actionBannerVeMayBay()
	{
		$this->pluralTitle = 'Banner Vé Máy Bay';
		$this->singleTitle = 'Banner Vé Máy Bay';
		
	    $model = QuangCaoBanner::model()->findByPk( 1 ); //id = 1 là banner quang cáo máy bay
	    $model->scenario = 'veMayBay';
	    if(!empty($model))
	    {
	        if(isset($_POST['QuangCaoBanner']))
	        {
	            $old_image = $model->image;
                $imageField='image';

                $uploadImage = CUploadedFile::getInstance($model, $imageField);
                $model->attributes=$_POST['QuangCaoBanner'];
                $model->link = $_POST['QuangCaoBanner']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array($imageField) );
                    }else{
                        $model->saveImage($imageField);
                        $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('banner_detail',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}

	public function actionBannerTop()
	{
		$this->pluralTitle = 'Banner Trên Top';
		$this->singleTitle = 'Banner Trên Top';
		
	    $model = QuangCaoBanner::model()->findByPk( 2 ); //id = 1 là banner top
	    $model->scenario = 'veMayBay';
	    if(!empty($model))
	    {
	        if(isset($_POST['QuangCaoBanner']))
	        {
	            $old_image = $model->image;
                $imageField='image';

                $uploadImage = CUploadedFile::getInstance($model, $imageField);
                $model->attributes=$_POST['QuangCaoBanner'];
                $model->link = $_POST['QuangCaoBanner']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array($imageField) );
                    }else{
                        $model->saveImage($imageField);
                        $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('banner_detail',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}



		/*public function actionBannerDetail($id)
		{
			$this->pluralTitle = 'Quảng Cáo Banner';
			$this->singleTitle = 'Quảng Cáo Banner';
			
		    $model = QuangCaoBanner::model()->findByPk($id);
		    if(!empty($model))
		    {
		        if(isset($_POST['QuangCaoBanner']))
		        {
		            $old_image = $model->image;
	                foreach ($model->defineImageSize as $key => $value) {
	                    $imageField=$key;
	                }
	                $uploadImage = CUploadedFile::getInstance($model, $imageField);
	                $model->attributes=$_POST['QuangCaoBanner'];
	                $model->link = $_POST['QuangCaoBanner']['link'];
	                if ($model->save())
	                {
	                    if( empty($uploadImage) || $uploadImage==NULL )
	                    {
	                        $model->image = $old_image;
	                        $model->update( array($imageField) );
	                    }else{
	                        $model->saveImage($imageField);
	                        // $model->deleteImages($imageField, $old_image);
	                    }
		                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
		                // $this->redirect(array('view', 'id' => $model->id));
		            }
		            else
		                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
		        }
		        $this->render('banner_detail',array('model'=>$model));
		    }else
		    {
		        throw new CHttpException(404, 'Không tìm thấy.');
		    }
		}

	public function actionQuangCaoBanner($id)
	{
		$this->pluralTitle = 'Quảng Cáo Banner';
		$this->singleTitle = 'Quảng Cáo Banner';
		
	    $model = QuangCaoBanner::model()->findByPk($id);
	    if(!empty($model))
	    {
	        if(isset($_POST['QuangCaoBanner']))
	        {
	            $old_image = $model->image;
                foreach ($model->defineImageSize as $key => $value) {
                    $imageField=$key;
                }
                $uploadImage = CUploadedFile::getInstance($model, $imageField);
                $model->attributes=$_POST['QuangCaoBanner'];
                $model->link = $_POST['QuangCaoBanner']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array($imageField) );
                    }else{
                        $model->saveImage($imageField);
                        // $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('quang_cao_banner',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}

	//admin/banners/updateLeftScrollBanner
	public function actionUpdateLeftScrollBanner()
	{
	    $model = ScrollBanner::model()->findByPk(3);
	    if(!empty($model))
	    {
	        if(isset($_POST['ScrollBanner']))
	        {
	            $old_image = $model->image;
                foreach ($model->defineImageSize as $key => $value) {
                    $imageField=$key;
                }
                $uploadImage = CUploadedFile::getInstance($model, $imageField);
                $model->attributes=$_POST['ScrollBanner'];
                $model->link = $_POST['ScrollBanner']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array($imageField) );
                    }else{
                        $model->saveImage($imageField);
                        // $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('update_scroll_banner',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}


	public function actionUpdateRightScrollBanner()
	{
	    $model = ScrollBanner::model()->findByPk(4);
	    if(!empty($model))
	    {
	        if(isset($_POST['ScrollBanner']))
	        {
	            $old_image = $model->image;
                foreach ($model->defineImageSize as $key => $value) {
                    $imageField=$key;
                }
                $uploadImage = CUploadedFile::getInstance($model, $imageField);
                $model->attributes=$_POST['ScrollBanner'];
                $model->link = $_POST['ScrollBanner']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array($imageField) );
                    }else{
                        $model->saveImage($imageField);
                        // $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('update_scroll_banner',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}



	public function actionUpdateTopBannerLeft()
	{
	    $model = TopBannerLeft::model()->findByPk(1);
	    if(!empty($model))
	    {
	        if(isset($_POST['TopBannerLeft']))
	        {
	            $old_image = $model->image;
                
                $uploadImage = CUploadedFile::getInstance($model, "image");
                $model->attributes=$_POST['TopBannerLeft'];
                $model->link = $_POST['TopBannerLeft']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array("image") );
                    }else{
                        $model->saveImage("image");
                        // $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('update_top_banner_left',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}

	public function actionUpdateTopBannerRight()
	{
	    $model = TopBannerRight::model()->findByPk(2);
	    if(!empty($model))
	    {
	        if(isset($_POST['TopBannerRight']))
	        {
	            $old_image = $model->image;
                foreach ($model->defineImageSize as $key => $value) {
                    $imageField=$key;
                }
                $uploadImage = CUploadedFile::getInstance($model, "image");
                $model->attributes=$_POST['TopBannerRight'];
                $model->link = $_POST['TopBannerRight']['link'];
                if ($model->save())
                {
                    if( empty($uploadImage) || $uploadImage==NULL )
                    {
                        $model->image = $old_image;
                        $model->update( array("image") );
                    }else{
                        $model->saveImage("image");
                        // $model->deleteImages($imageField, $old_image);
                    }
	                $this->setNotifyMessage(NotificationType::Success, 'Update thành công.' );
	                // $this->redirect(array('view', 'id' => $model->id));
	            }
	            else
	                $this->setNotifyMessage(NotificationType::Error, 'Update lỗi.' );
	        }
	        $this->render('update_top_banner_right',array('model'=>$model));
	    }else
	    {
	        throw new CHttpException(404, 'Không tìm thấy.');
	    }
	}*/


	public function actionCreate()
	{
			$model = new Banner('create');
			if (isset($_POST['Banner']))
			{
				$model->attributes = $_POST['Banner'];
				$model->content = $_POST['Banner']['content'];
				$model->created_date = date('Y-m-d H:i:s');
				if ($model->save())
				{
					$model->saveImage('image');
					$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . Yii::t('systemmsg', 'systemmg.createdsuccessed'));
					$this->redirect(array('view', 'id' => $model->id));
				}
				else
					$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . Yii::t('systemmsg', 'systemmg.createerror'));
			}
			$this->render('create', array(
				'model' => $model,
				'actions' => $this->listActionsCanAccess,
			));
	}

	public function actionDelete($id)
	{
		try
		{
			if (Yii::app()->request->isPostRequest)
			{
				// we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if ($model = $this->loadModel($id))
					{
						if ($model->delete())
							Yii::log("Delete record " . print_r($model->attributes, true), 'info');
					}

					// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
					if (!isset($_GET['ajax']))
						$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
				}
			} else
			{
				Yii::log("Invalid request. Please do not repeat this request again.");
				throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
			}
		}
		catch (Exception $e)
		{
			Yii::log("Exception " . print_r($e, true), 'error');
			throw new CHttpException($e);
		}
	}

	public function actionIndex()
	{
		try
		{
			$model = new Banner;
			$model->unsetAttributes();  // clear any default values
			if (isset($_GET['Banner']))
				$model->attributes = $_GET['Banner'];

			$this->render('index', array(
				'model' => $model, 'actions' => $this->listActionsCanAccess,
			));
		}
		catch (Exception $e)
		{
			Yii::log("Exception " . print_r($e, true), 'error');
			throw new CHttpException($e);
		}
	}
	
	public function actionSaveBannerItems()
	{
		
	}

	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		if (isset($_POST['Banner']))
		{
			$model->attributes = $_POST['Banner'];
			$model->content = $_POST['Banner']['content'];
			// $model->text2 = $_POST['Banner']['text2'];
			// $model->text3 = $_POST['Banner']['text3'];
			if ($model->save())
			{
				$model->saveImage('image');
				$this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
				$this->redirect(array('view', 'id' => $model->id));
			}
			else
				$this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
		}
		//$model->beforeRender();
		$this->render('update', array(
			'model' => $model,
			'actions' => $this->listActionsCanAccess,
			'title_name' => $model->name));
	}

	public function actionView($id)
	{
		try
		{
			$model = $this->loadModel($id);
			$this->render('view', array(
				'model' => $model,
				'actions' => $this->listActionsCanAccess,
				'title_name' => $model->name));
		}
		catch (Exception $exc)
		{
			throw new CHttpException(404, 'The requested page does not exist.');
		}
	}

	/*
	 * Bulk delete
	 * If you don't want to delete some specified record please configure it in global $cannotDelete variable
	 */

	public function actionDeleteAll()
	{
		$deleteItems = $_POST['banner-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
			Banner::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	public function loadModel($id)
	{
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new Banner();
		$model = $initMode->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

}
