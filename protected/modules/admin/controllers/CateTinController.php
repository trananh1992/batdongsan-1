<?php

class CateTinController extends AdminController
{
    public $pluralTitle = 'Danh Mục Tin Nhà Đất';
    public $singleTitle = 'Danh Mục Tin Nhà Đất';
    public $cannotDelete = array();
    public function actionCreateParent(){
            $model = new CategoryTin('taoBE');
            if (isset($_POST['CategoryTin'])) {
                $model->attributes = $_POST['CategoryTin'];
                $model->parent_id = 0;
                if($model->save())
                {   
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('index'));
                }
                else
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
            ));
        
    }



    public function actionCreate(){
        try {
            $model = new CategoryTin('create');
            if (isset($_POST['CategoryTin'])) {
                $model->attributes = $_POST['CategoryTin'];
                if($model->save())
				{ 	
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
        }catch (exception $e) {
            //Yii::log("Exception " . print_r($e, true), 'error');
            //throw new CHttpException($e);
        }
    }

    public function actionDelete($id) {
            if(Yii::app()->request->isPostRequest) {
                // we only allow deletion via POST request
				if (!in_array($id, $this->cannotDelete))
				{
					if($model = $this->loadModel($id))
					{
						if($model->delete())
						{
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
        
    }      
    
    public function actionIndex() {
            $model=new CategoryTin('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['CategoryTin']))
                $model->attributes=$_GET['CategoryTin'];

            $this->render('index',array(
                'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
    }
    public function actionUpdate($id) {
        $model=$this->loadModel($id);
        if(isset($_POST['CategoryTin']))
        {
            $model->attributes=$_POST['CategoryTin'];
            if ($model->save())
            {               
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                // $this->redirect(array('view', 'id'=> $model->id));
                $this->redirect(array('index'));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('update',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'title_name' => $model->name        ));
    }

    
    
    public function actionView($id) {
        try {
            $model = $this->loadModel($id);
            $this->render('view', array(
                'model'=> $model,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
        } catch (Exception $exc) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
    }


    public function actionCreateCon($parent_id)
    {
            $model = new CategoryTin('taoBE');
            if (isset($_POST['CategoryTin'])) {
                $model->attributes = $_POST['CategoryTin'];
                $model->parent_id = $parent_id;
                if($model->save())
                {   
                    $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been created');
                    $this->redirect(array('indexCon', 'parent_id'=>$parent_id));
                }
                else
                    $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be created for some reasons');
            }
            $this->render('create', array(
                'model' => $model,
                'actions' => $this->listActionsCanAccess,
                'parent_id'=>$parent_id,
            ));
        
    }
    public function actionIndexCon($parent_id) 
    {
        $model=new CategoryTin();
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['CategoryTin']))
            $model->attributes=$_GET['CategoryTin'];

        $this->render('indexCon',array(
            'model'=>$model, 'actions' => $this->listActionsCanAccess,
            'parent_id'=>$parent_id,
        ));
    }

    public function actionUpdateCon($id, $parent_id) {
        $model=$this->loadModel($id);
        if(isset($_POST['CategoryTin']))
        {
            $model->attributes=$_POST['CategoryTin'];
            if ($model->save())
            {               
                $this->setNotifyMessage(NotificationType::Success, $this->singleTitle . ' has been updated');
                // $this->redirect(array('view', 'id'=> $model->id));
                $this->redirect(array('indexCon', 'parent_id'=>$parent_id));
            }
            else
                $this->setNotifyMessage(NotificationType::Error, $this->singleTitle . ' cannot be updated for some reasons');
        }
        //$model->beforeRender();
        $this->render('updateCon',array(
            'model' => $model,
            'actions' => $this->listActionsCanAccess,
            'parent_id'=>$parent_id,
            'title_name' => $model->name        ));
    }
    public function actionViewCon($id,$parent_id) 
    {
            $model = $this->loadModel($id);
            $this->render('viewCon', array(
                'model'=> $model,
                'parent_id'=>$parent_id,
                'actions' => $this->listActionsCanAccess,
                'title_name' => $model->name            ));
    }

	/*
	* Bulk delete
	* If you don't want to delete some specified record please configure it in global $cannotDelete variable
	*/
	public function actionDeleteAll()
	{
		$deleteItems = $_POST['category-tin-grid_c0'];
		$shouldDelete = array_diff($deleteItems, $this->cannotDelete);

		if (!empty($shouldDelete))
		{
						CategoryTin::model()->deleteAll('id in (' . implode(',', $shouldDelete) . ')');
			$this->setNotifyMessage(NotificationType::Success, 'Your selected records have been deleted');
		}
		else
			$this->setNotifyMessage(NotificationType::Error, 'No records was deleted');

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	
		
    public function loadModel($id){
		//need this define for inherit model case. Form will render parent model name in control if we don't have this line
		$initMode = new CategoryTin();
        $model=$initMode->findByPk($id);
        if($model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }
}