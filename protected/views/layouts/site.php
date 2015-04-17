<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <?php include('_head.php'); ?>
</head>
<body>

<!-- <div class="row-fluid" style="background-color: #181818; padding:10px; color: #f1f1f1;">
    <div class="container ">
      <div class="col-sm-12">
        <div class="col-sm-8">Bản Quyền Nhà Đất Bình Dương</div>
        <div class="col-sm-4"></div>
      </div>
    </div>
</div> -->

<div class="row-fluid" style="color: #fff; background-color: #ccc;">
<div class="container">
    <?php 
    if(!Yii::app()->user->id )
    { ?>
        <div class="pull-right"><button onclick="redirect_login(this);" type="button" class="btn btn-primary"><a style="color:#fff;" href="<?php echo Yii::app()->createAbsoluteUrl('site/login'); ?>">Đăng Nhập</a></button></div>
        <script type="text/javascript">
        function redirect_login(object)
        {
            var url = $(object).children( "a" ).attr('href');
            window.location.href = url;
        }
        </script>
    <?php }else if(Yii::app()->user->id && !empty(Yii::app()->user->id) )
    {
        $user = Users::model()->findByPk(Yii::app()->user->id);
        if(!empty($user))
        {
            ?>
                <!-- Single button -->
                <div class="btn-group pull-right">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php echo 'Chào '.$user->full_name .' '; ?><span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('thanhvien/index'); ?>">Tin Của Bạn</a></li>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/dangTin'); ?>">Đăng Tin</a></li>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/myProfile'); ?>">Tài Khoản Của Bạn</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>">Đăng Xuất</a></li>
                  </ul>
                </div>
            <?php
        }
    }
    ?>
</div>
</div>


<div class="container">
    <div class="row">
        <?php include('inc/logo_menu_ngang.php'); ?>
    </div>
</div>

<!-- search form -->
<div class="container" >
        <?php include('inc/form_search.php'); ?>
</div>

<!-- Main content -->
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <?php echo $content; ?>
        </div>


        <!-- colum 2 -->
        <div class="col-sm-3">
            <?php $this->widget('CotPhaiWidget') ?>
        </div>
    </div>
</div>



<!-- Footer -->
<div class="row-fluid" id="footer">
        <?php include('_footer.php'); ?>
</div>


<div class="row-fluid" id="footer_ban_quyen" >
        <?php include('inc/footer_ban_quyen.php'); ?>
</div>

</body>
</html>
