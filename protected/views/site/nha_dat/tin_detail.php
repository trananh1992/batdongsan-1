<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script> -->
<style type="text/css">
.item-image{
    /*background: #333;    */
    text-align: center;
    /*height: 300px !important;*/
}
.carousel{
    /*margin-top: 20px;*/
    /*margin: 0 auto !important;*/
    /*height: 450px !important;*/
}
.carousel-inner .item{
    margin: 0 auto !important;
    height: 400px !important;
}
.carousel-inner img{
    margin: 0 auto !important;
    /*height: 450px !important;*/
}
</style>
<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title"><?php echo $model->title; ?><a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
        <div class="row-fluid" style="margin-top: 10px;">
            <div class="col-sm-12">
                <div class="col-sm-8">

                        <?php 
                        $list_image = TinNhaDatImage::showAllImage($model->id, 'model');
                        $count_list_image = count($list_image);
                        if($count_list_image==0)
                        {
                            echo '<img class="img-responsive" alt="Responsive image" src="'.Yii::app()->createAbsoluteUrl('/').'/upload/logonha.jpg" />';
                        }else{
                        ?>
                                <div id="myCarousel" class="carousel slide" data-interval="3000" data-ride="carousel">
                                    <!-- Carousel indicators -->
                                    <ol class="carousel-indicators">
                                        <?php 
                                        $check = 0;
                                        for($i=0; $i<$count_list_image; $i++)
                                        {
                                            if($check==0){
                                                $check=1;
                                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
                                            }else{
                                                echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';   
                                            }
                                        }
                                        ?>
                                    </ol>   
                                   <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <?php
                                        $active_check = 0;
                                        foreach ($list_image as $one) 
                                        {
                                            if(empty($one)) continue;
                                            if($active_check==0)
                                            {
                                                $active_check=1;
                                                // if(!empty($one->name))
                                                // {
                                                    echo '<div class="active item">
                                                            <img class="img-responsive" alt="Responsive image" src="'.$one->getImageUrl('name', 'thumb2').'" />        
                                                        </div>';
                                                // }
                                                
                                            }else{
                                                echo '<div class="item">
                                                    <img src="'.$one->getImageUrl('name', 'thumb2').'" />        
                                                </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                    <!-- Carousel nav -->
                                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                    </a>
                                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                    </a>
                                </div>
                        <?php } ?>


                </div>
                <div class="col-sm-4">
                    <h4 style="color: #081890;"><?php echo $model->title; ?></h4>

                    <p>Người Đăng: <span style="color: #a04401;"><b><?php echo $model->ten_nguoi_dang; ?></b></span></p>
                    <p>Điện Thoại Liên Hệ: <span style="color: #4209aa;"><b><?php echo $model->sdt_lien_he; ?></b></span></p>
                    <p>Địa Chỉ: <span style="color: #000;"><b><?php echo $model->dia_chi; ?></b></span></p>
                    <p>Diện Tích: <span style="color: #000;"><b><?php echo $model->dien_tich; ?> m<sup>2</sup></b></span></p>
                    <p>Thuộc Mục: <span style="color: #4e4800;"><b><?php echo Yii::app()->format->categoryName($model->category_parent_id).' <span class="glyphicon glyphicon-arrow-right"></span> '.Yii::app()->format->categoryName($model->category_sub_id);  ?></b></span></p>
                    <p>Giá: <span style="color: red;"><b><?php echo Yii::app()->format->gia($model->gia);  ?></b></span></p>
                    <p>Lượt Xem: <span style="color: #5f5e61;"><b><?php echo $model->view; ?> lượt</b></span></p>
                    <p>Ngày Đăng: <span style="color: #0410fd;"><i><?php echo Yii::app()->format->date($model->updated_date);  ?></i></span></p>

                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="row-fluid" style="margin-bottom: 30px;margin-top: 20px;">
              
                <div class="offset1 col-sm-10 " style="margin-top:20px; padding-left:20px;">
                    <h3 style="margin-left: 30px; border-bottom: 1px solid #a30206;">Thông Tin Chi Tiết</h3>
                    <?php 
                    $image_share = TinNhaDatImage::showDefaultImage($model->id, 'model');
                    $url_share = Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug' => $model->slug));
                    if(!empty($image_share->name)){
                      MyFunctionCustom::registerOpenGraph('og:image', $image_share->getImageUrl('name','thumb2') );
                    }else{
                        MyFunctionCustom::registerOpenGraph('og:image', Yii::app()->createAbsoluteUrl('/').'/upload/logonha.jpg' );
                    }
                      MyFunctionCustom::registerOpenGraph('og:url', $url_share);
                      MyFunctionCustom::registerOpenGraph('og:title', $model->title);
                      MyFunctionCustom::registerOpenGraph('og:description', strip_tags($model->short_content));
                      $href_share = "https://www.facebook.com/sharer/sharer.php?u=".$url_share;
                    ?>
                    <br/>
                    <div class="fb-like" data-href="<?php echo $url_share; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                    <div class="" style="padding: 40px;">
                        <?php echo $model->content; ?>
                    </div>
                    <div class="fb-like" data-href="<?php echo $url_share; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                </div>
            </div>
        </div>

        <!-- plugins comment facebook -->
        <!-- <div class="row-fluid">
            <span class="fb-comments-count" data-href="<?php echo $url_share; ?>"> Comments</span>
        </div> -->

        <div class="row-fluid">
                <div class="fb-comments" data-href="<?php echo $url_share; ?>" data-numposts="10" data-colorscheme="light"></div>
        </div>

        
  </div>
</div>



<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title">Tin Liên Quan<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CListView', array(
                'id' => 'list_nha_dat',
                'dataProvider'=>$list_nha_dat,
                'itemView'=>'nha_dat/_item_tin_detail',
                // 'enableHistory'=> true,
                'pagerCssClass' => 'pagination',
                'ajaxUpdate'=>'list_nha_dat',
                // 'ajaxUpdate' => true,
                // 'loadingCssClass' => '', //remove loading icon
                'summaryText' => '',
                'emptyText' => '<div class="alert alert-info">Không tìm thấy tin nào!</div>',
                // 'emptyText' => '',
                'enablePagination' => true,
                
                'pager' => array(
                    'maxButtonCount' => 10,
                    'id'=>'pager_featured',
                    'header' => false,
                    'firstPageLabel' => 'First',
                    'prevPageLabel' => 'Prev',
                    // 'previousPageCssClass' => 'prev',
                    'nextPageLabel' => 'Next',
                    // 'nextPageCssClass' => 'next',
                    'lastPageLabel' => 'Last',
                    'maxButtonCount' => 5,
                    // 'cssFile' => false,
                    'htmlOptions' => array('class' => 'pager'),                            
                    // 'htmlOptions' => array('class' => 'pager','style'=>'display: none;'),                            
                ),
            ));
        ?>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    // Activate carousel
    console.log('slide');
    // $("#myCarousel").carousel();
    $("#myCarousel").carousel({
         // interval : false
         interval : 3000
     });
    
    // Enable carousel control
    $(".left").click(function(){
        $("#myCarousel").carousel('prev');
    });
    $(".right").click(function(){
        $("#myCarousel").carousel('next');
    });
    
    // Enable carousel indicators
    // $(".slide-one").click(function(){
    //     $("#myCarousel").carousel(0);
    // });
    // $(".slide-two").click(function(){
    //     $("#myCarousel").carousel(1);
    // });
    // $(".slide-three").click(function(){
    //     $("#myCarousel").carousel(2);
    // });
});
</script>