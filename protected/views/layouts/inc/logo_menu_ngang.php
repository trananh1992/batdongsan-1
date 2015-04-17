<!-- <style type="text/css">
  .aa{
    font-weight: bold;
  }
</style> -->
<div class="col-sm-12 col-xs-12 hidden-xs hidden-sm">
  <div style="position: relative;">
    <?php
      $top_banner = QuangCaoBanner::model()->findByPk(2);
      if(!empty($top_banner)) 
        echo '<a href="'.Yii::app()->createAbsoluteUrl('/').'">
              <img class="img-responsive" src="'.$top_banner->getImageUrl('image', QuangCaoBanner::SIZE2 ).'"  style="width:auto; height: 200px;" />
              </a>';
    ?>
        <!-- <img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo_head.jpg"  style="width:auto; height: 200px;" /> -->
    <div style="position: absolute; bottom: 30px; right: 10px; left: 10px; height: 30px;">
        <marquee behavior="scroll" direction="left" width="100%" style="width: 100%;">
            <font color="white">
                <h2 style="
                          color:#fff;
                          font-weight: bold;
                          ">
                  <?php echo Yii::app()->setting->getItem('dongchuchay'); ?>
                </h2>
            </font>
        </marquee>
    </div>
  </div>
</div>


        
<div class="col-sm-12">      
      <nav class="navbar navbar-default navbar-inverse">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php echo Yii::app()->createAbsoluteUrl('site/index'); ?>">Trang Chủ</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <?php 
                $yii_controller = Yii::app()->controller->id;
                $yii_action = Yii::app()->controller->action->id;

                $criteria = new CDbCriteria();
                $criteria->compare('t.status',STATUS_ACTIVE);
                $criteria->addCondition('t.parent_id=0');
                // $criteria->limit = ;
                $criteria->order ="order_display DESC";
                $models = CategoryTin::model()->findAll($criteria);
                if(!empty($models))
                {
                  foreach ($models as $one) 
                  {
                    if(empty($one)) continue;
                    $criteria = new CDbCriteria();
                    $criteria->compare('t.status',STATUS_ACTIVE);
                    $criteria->addCondition('t.parent_id='.$one->id);
                    // $criteria->limit = ;
                    $criteria->order ="order_display DESC";
                    $models_menucon = CategoryTin::model()->findAll($criteria);
                    $count_models_menucon = CategoryTin::model()->count($criteria);
                    if($count_models_menucon==0)
                    {
                      if(isset($_GET['parent_slug']) && $_GET['parent_slug']==$one->slug )
                        echo '<li class="active"><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('parent_slug'=>$one->slug, 'children_slug'=>'all')).'">'.$one->name.'</a></li>';
                      else
                        echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('parent_slug'=>$one->slug, 'children_slug'=>'all')).'">'.$one->name.'</a></li>';

                    }else if($count_models_menucon > 0)
                    {
                      if(isset($_GET['parent_slug']) && $_GET['parent_slug']==$one->slug )
                      {
                        echo '<li class="dropdown active">';
                        echo '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('parent_slug'=>$one->slug, 'children_slug'=>'all')).'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$one->name.' <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">';
                      }else{
                        echo '<li class="dropdown">';
                        echo '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('parent_slug'=>$one->slug, 'children_slug'=>'all')).'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$one->name.' <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">';
                      }

                      foreach ($models_menucon as $one_menucon) 
                      {
                        if(empty($one_menucon)) continue;
                        echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('parent_slug'=>$one->slug, 'children_slug'=>$one_menucon->slug)).'">'.$one_menucon->name.'</a></li>';
                      }
                        
                        echo '</ul>
                      </li>';

                    }
                  }  
                }
                
                ?>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/aboutUs'); ?>">Giới Thiệu</a></li>
                <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/contactUs'); ?>">Liên Hệ</a></li>
                <?php 
                if(Yii::app()->user->id) { ?>
                  <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/dangTin'); ?>">Đăng Tin</a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </nav>
</div>