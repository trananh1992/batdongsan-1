<?php

class ThanhvienController extends FrontController 
{

   
    public function actions() {
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
        );
    }

    public function actionError() {
        var_dump(Yii::app()->errorHandler->error);
        $error = Yii::app()->errorHandler->error;

        if (Yii::app()->request->isAjaxRequest)
            echo $error['message'];
        else
            $this->render('error', $error);
    }

    public function actionIndex() //show tin da duyet
    {
        if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )
        {
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
            // throw new CHttpException(404, 'Invalid request.');
        }
        $user = Users::model()->findByPk(Yii::app()->user->id);

        $this->pageTitle = 'Màn Hình Quản Lý - '.Yii::app()->setting->getItem('defaultPageTitle');

        $model = new TinNhaDat;

        $this->render('index', array(
            'user' => $user,
            'model' => $model,
        ));
    }

    public function actionIndexChuaDuyet() //show tin da duyet
    {
        if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )
        {
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
            // throw new CHttpException(404, 'Invalid request.');
        }
        $user = Users::model()->findByPk(Yii::app()->user->id);

        $this->pageTitle = 'Màn Hình Quản Lý - '.Yii::app()->setting->getItem('defaultPageTitle');
        $model = new TinNhaDat;
        $this->render('indexChuaDuyet', array(
            'user' => $user,
            'model' => $model,
        ));
    }

    public function actionIndexKhongDuyet() //show tin da duyet
    {
        if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )
        {
            $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
            // throw new CHttpException(404, 'Invalid request.');
        }
        $user = Users::model()->findByPk(Yii::app()->user->id);

        $this->pageTitle = 'Màn Hình Quản Lý - '.Yii::app()->setting->getItem('defaultPageTitle');
        $model = new TinNhaDat;
        $this->render('indexKhongDuyet', array(
            'user' => $user,
            'model' => $model,
        ));
    }


    // public function actionDangTin() 
    // {
    //     if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )// đã logged
    //     {
    //         $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
    //         // throw new CHttpException(404, 'Invalid request.');
    //     }
    //     $user = Users::model()->findByPk(Yii::app()->user->id);
        
    //     $this->pageTitle = 'Đăng Tin - '.Yii::app()->setting->getItem('defaultPageTitle');

    //     $this->render('index', array(
    //         'user' => $user,
    //     ));
    // }

    
    public function actionTinDetail($slug)
    {
        $criteria = new CDbCriteria();
        $criteria->compare('t.status',STATUS_ACTIVE);
        $criteria->compare('t.slug',$slug);
        $model = TinNhaDat::model()->find($criteria);
        if(!empty($model))
        {
            // $model->view = $model->view +1;
            // $model->update( array('view') );
            $this->pageTitle = $model->title. ' - ' . Yii::app()->params['defaultPageTitle'];

            $a = new TinNhaDat;
            $list_nha_dat = $a->searchTinLienQuan($model->category_parent_id);

            $this->render('tin_detail', array(
                'model' => $model,
                'list_nha_dat'=>$list_nha_dat,
                // 'dataProvider'=>$dataProvider,
            ));
        }else
            throw new CHttpException(404, 'Sorry! The request page does not exist.');

    }

    


    public function actionXoaTinDetail() 
    {
        if(isset($_POST['tin_id']) && !empty($_POST['tin_id']) )
        {
            $model = TinNhaDat::model()->findByPk($_POST['tin_id']);
            if(!empty($model))
            {
                $tin_nha_dat_id = $model->id;
                if($model->delete())
                {
                    TinNhaDatImage::deleteAllImage($tin_nha_dat_id);
                    echo 'delete_success';
                    die;
                }
            }
            
        }
    }

    // public function actionXemTin($id) 
    // {
    //     if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )// đã logged
    //     {
    //         $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
    //         // throw new CHttpException(404, 'Invalid request.');
    //     }
    //     $user = Users::model()->findByPk(Yii::app()->user->id);
        
    //     $this->pageTitle = 'Đăng Tin - '.Yii::app()->setting->getItem('defaultPageTitle');

    //     $this->render('index', array(
    //         'user' => $user,
    //     ));
    // }

    // public function actionListTin() 
    // {
    //     if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )// đã logged
    //     {
    //         $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
    //         // throw new CHttpException(404, 'Invalid request.');
    //     }
    //     $user = Users::model()->findByPk(Yii::app()->user->id);
        
    //     $this->pageTitle = 'Đăng Tin - '.Yii::app()->setting->getItem('defaultPageTitle');

    //     $this->render('index', array(
    //         'user' => $user,
    //     ));
    // }

    // public function actionXoaTin($id) 
    // {
    //     if ( !isset(Yii::app()->user->id) || !Yii::app()->user->id )// đã logged
    //     {
    //         $this->redirect( Yii::app()->createAbsoluteUrl('site/index') );
    //         // throw new CHttpException(404, 'Invalid request.');
    //     }
    //     $user = Users::model()->findByPk(Yii::app()->user->id);
        
    //     $this->pageTitle = 'Đăng Tin - '.Yii::app()->setting->getItem('defaultPageTitle');

    //     $this->render('index', array(
    //         'user' => $user,
    //     ));
    // }

}
