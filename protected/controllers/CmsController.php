<?php

class CmsController extends FrontController {

    /**
     * Declares class-based actions.
     */
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

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        var_dump(Yii::app()->errorHandler->error);
        $error = Yii::app()->errorHandler->error;

        if (Yii::app()->request->isAjaxRequest)
            echo $error['message'];
        else
            $this->render('error', $error);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex($slug) 
    {
            $criteria = new CDbCriteria();
            $criteria->compare('t.status',STATUS_ACTIVE);
            $criteria->compare('t.slug',$slug);
            // $criteria->limit = 1;
            // $criteria->order ="id DESC";
            $model = Page::model()->find($criteria);

            if (empty($model))
                $this->redirect(array('error'));
            
            if ($model->title_tag != "") {
                $this->pageTitle = $model->title_tag . ' - ' . Yii::app()->setting->getItem('defaultPageTitle');
            } else {
                $this->pageTitle = $model->title . ' - ' . Yii::app()->setting->getItem('defaultPageTitle');
            }
            $keyword = $model->meta_keywords;
            if ($keyword != "") {
                $this->setMetaKeywords($keyword);
            }
            $desc = $model->meta_desc;
            if ($desc != "") {
                $this->setMetaDescription($desc);
            }
            
            $this->render('page', array(
                'model' => $model,
            ));
    }

}
