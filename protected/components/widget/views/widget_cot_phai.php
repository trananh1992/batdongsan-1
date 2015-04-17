


<div id="fb-root"></div>
              <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));</script>

              <div class="fb-like-box" 
               data-width="260px" data-href="<?php echo Yii::app()->setting->getItem('facebook'); ?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
              <!-- <div class="fb-like-box" 
               data-href="https://www.facebook.com/nha.dat.binh.duong.di.an"
              data-colorscheme="light" 
              data-show-faces="true" 
              data-header="true" 
              data-stream="false" 
              data-show-border="true"
              data-height="350px"
               data-width="190px">
              </div> -->
<div style="height:20px;">&nbsp;</div>

<div class="panel panel-primary hidden-xs hidden-sm">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tìm theo chuyên mục<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">
        <ul>
        <?php
        $list = CategoryTin::getListWidget();
        if(!empty($list))
        {
          foreach ($list as $one) 
          {
            if(!empty($one)) echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('parent_slug'=>$one->slug, 'children_slug'=>'all')).'">'.$one->name.'</a></li>';
          }
          echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin').'">Tất Cả</a></li>';
        }
        ?>
        </ul>
        <!-- <ul>
            <li>Nhà bán</li>
            <li>Đất bán</li>
            <li>Cho thuê</li>
        </ul> -->
    </div>
</div>


<div class="panel panel-primary hidden-xs hidden-sm">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tìm theo giá<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">
        <ul>
        <?php
        $list = Gia::getListGiaWidget();
        if(!empty($list))
        {
          foreach ($list as $one) 
          {
            if(!empty($one)) echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('TinNhaDat[s_gia]'=>$one->id )).'">'.$one->name.'</a></li>';
          }

        }
        ?>
        </ul>

        <!-- <ul>
            <li>0->100</li>
            <li>100->200</li>
            <li>200->500</li>
            <li>200->500</li>
            <li>200->500</li>
        </ul> -->
    </div>
</div>

<div class="panel panel-primary hidden-xs hidden-sm">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tìm theo diện tích<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">
        <ul>
        <?php
        $list = DienTich::getListWidget();
        if(!empty($list))
        {
          foreach ($list as $one) 
          {
            if(!empty($one)) echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('TinNhaDat[s_dien_tich]'=>$one->id )).'">'.$one->name.'</a></li>';
          }
        }
        ?>
        </ul>
        <!-- <ul>
            <li><a href="">Dĩ an</a></li>
            <li><a href="">Dĩ an</a></li>
            <li><a href="">Dĩ an</a></li>
            <li>Bình dương</li>
            <li>Thủ đức</li>
            <li>quận 9</li>
        </ul> -->
    </div>
</div>

<div class="row-fluid">
  <?php $m_vemaybay = QuangCaoBanner::model()->findByPk(1);
  if(!empty($m_vemaybay))
    echo '<a target="_blank" href="'.$m_vemaybay->link.'">
            <img class="img-responsive" src="'.$m_vemaybay->getImageUrl('image', QuangCaoBanner::SIZE1).'" />
        </a>';

   ?>
</div>

<div class="row-fluid" style="height: 20px;">&nbsp;</div>


<div class="panel panel-primary hidden-xs hidden-sm">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Kênh Youtube<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">
          <?php 
          $arr_link1 = explode('?', Yii::app()->params['link_see_us_youtube']);
          if(is_array($arr_link1) && !empty($arr_link1[1]) )
          {
             $arr_link11 = explode('=', $arr_link1[1] );
             if( is_array($arr_link11) && !empty($arr_link11[1]) )
             { ?>

                          <div>
                             <a class="fancyboxIframe various fancybox.iframe" href="https://www.youtube.com/embed/<?php echo $arr_link11[1]; ?>" style="position: relative; float:left; margin-right: 0px;">
                                    <iframe width="260" height="300" src="https://www.youtube.com/embed/<?php echo $arr_link11[1]; ?>" frameborder="0" allowfullscreen></iframe>
                                    <div style="marign: 0 auto; text-align: center;"><?php echo Yii::app()->params['title_linkyoutube1']; ?></div>
                                    <div style="position: absolute;
                                        width: 260px;
                                        height: 300px;
                                        top: 0;
                                        z-index: 100;
                                        cursor: pointer;" onclick="jQuery(this).parent('a').click(); return false;" >
                                    </div>
                            </a>
                          </div>

              <?php
             }
          }
          ?>
    </div>
</div>


<script type="text/javascript">
  jQuery(document).ready(function(){

        jQuery(".fancyboxIframe").fancybox({
            maxWidth  : 900,
            maxHeight : 600,
            fitToView : true,
            width   : '90%',
            height    : '90%',
            autoSize  : true,
            closeClick  : true,
            openEffect  : 'none',
            closeEffect : 'none',
            iframe: {
              scrolling : 'auto',
              preload   : true
            }
        });
  
});
</script>


<div class="row-fluid" style="height: 20px;">&nbsp;</div>
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Nhà Cần Bán Gấp<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">
              <?php 
              $criteria = new CDbCriteria();
              $criteria->compare('t.status',STATUS_ACTIVE);
              $criteria->compare('t.can_ban_gap',NHA_BAN_GAP);
              $criteria->compare('is_duyet_tin',DA_DUYET);
              $criteria->limit = 10;
              $criteria->order ="order_display DESC, updated_date DESC";
              $models = TinNhaDat::model()->findAll($criteria);
              foreach ($models as $one) 
              {
                if(!empty($one))
                {
                    echo '<div class="col-sm-12"> 
                                <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.Yii::app()->theme->baseUrl.'/img/sale_off.gif" />'.$one->title.'</a>
                          </div>
                          <div class="col-sm-12" style="height: 10px;"> 
                                &nbsp;
                          </div>';
                }
              }
              ?>
    </div>
</div>

<div class="row-fluid" style="height: 20px;">&nbsp;</div>
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Đất Cần Bán Gấp<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">
              <?php 
              $criteria = new CDbCriteria();
              $criteria->compare('t.status',STATUS_ACTIVE);
              $criteria->compare('t.can_ban_gap',DAT_BAN_GAP);
              $criteria->compare('is_duyet_tin',DA_DUYET);
              $criteria->limit = 10;
              $criteria->order ="order_display DESC, updated_date DESC";
              $models = TinNhaDat::model()->findAll($criteria);
              foreach ($models as $one) 
              {
                if(!empty($one))
                {
                    echo '<div class="col-sm-12"> 
                                <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.Yii::app()->theme->baseUrl.'/img/km1.gif" />'.$one->title.'</a>
                          </div>
                          <div class="col-sm-12" style="height: 10px;"> 
                                &nbsp;
                          </div>';
                }
              }
              ?>
    </div>
</div>




<div class="row-fluid" style="height: 20px;">&nbsp;</div>
<div class="panel panel-primary hidden-xs hidden-sm">
    <div class="panel-heading">
      <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tin Tức Từ VnExpress<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
    </div>
    <div class="panel-body">

                <?php
                    
                    $file='http://vnexpress.net/rss/tin-moi-nhat.rss';

                    $dom=new DOMDocument('1.0','utf-8');//tao doi tuong dom
                    $dom->load($file);//muon lay rss tu trang nao thi ban khai bao day
                    $items = $dom->getElementsByTagName("item");//lay cac element co tag name la item va gan vao bien $items
                    foreach($items as $item)
                    {
                                $titles=$item->getElementsByTagName('title');//lay cac element co tag name la title va gan vao bien $titles
                                $title=$titles->item(0);//lay ra gia tri dau tuien trong array $titles

                                $links=$item->getElementsByTagName('link');
                                $link=$links->item(0);

                                $pubDates=$item->getElementsByTagName('pubDate');
                                $pubDate=$pubDates->item(0);

                                $descriptions=$item->getElementsByTagName('description');
                                // $descriptions=$descriptions->getElementsByTagName('a');
                                $des=$descriptions->item(0);

                                $img = explode('</br>', $des->nodeValue);
                            ?>
                            <div class="col-sm-12"> 
                                <a target="_blank" href="<?php  echo $link->nodeValue; ?>" ><?php echo $title->nodeValue; ?></a>
                            </div>
                            <!-- <div class="col-sm-12"> 
                                Ngày đăng: <?php echo $pubDate->nodeValue; ?>
                            </div> -->
                            <div class="col-sm-12" style="height: 10px;"> 
                                &nbsp;
                            </div>
                            <?php 
                            // echo $link->nodeValue; //link
                            // echo $title->nodeValue; //title
                            // $img = explode('</br>', $des->nodeValue); //img và description
                            // echo $img[0];  //img
                            // echo $img[1]; //description
                            // echo $pubDate->nodeValue; //ngày đăng
                    }
                    ?>
    </div>
</div>









              