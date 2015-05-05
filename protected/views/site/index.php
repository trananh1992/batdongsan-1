<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tin Nổi Bật<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
        <h1 class="xuanvinh_font_h1">Nha Dat Di An</h1> 
        <h2 class="xuanvinh_font_h2">nhà đất dĩ an, nhà dĩ an giá rẻ</h2>
        <?php
        $this->widget('zii.widgets.CListView', array(
                                'id' => 'list_noi_bat',
                                'dataProvider'=>$list_noi_bat,
                                'itemView'=>'nha_dat/_item_noi_bat',
                                // 'enableHistory'=> true,
                                'pagerCssClass' => 'pagination',
                                'ajaxUpdate'=>'list_noi_bat',
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
        <!-- <div class="item row-fluid">
            <div class="col-sm-12 item_tieu_de">
                <div class="col-sm-9 item_tieu_de_name">Bán nhà 2 mặt tiền đường rộng 6m DT = 78m2 ở dĩ an</div>
                <div class="col-sm-3  item_tieu_de_xem_chi_tiet">
                    <div class="pull-right"><a href="#">xem chi tiết</a></div>
                </div>
            </div>
            <div class="col-sm-12 item_content">
                  <img class="col-sm-2 img-responsive img-thumbnail" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/abc.jpg" alt=""/>
                  <div class="col-sm-7">
                      Tôi cần bán 1 căn nhà lầu ở dĩ an: – Nhà nằm trên 2 mặt tiền đẹp, đường rộng 6m – Nhà nằm trong khu dân cư, đường thông buôn bán được. – Nhà 1 lầu 1 trệt có 3 phòng ngủ, 3 phòng vệ sinh   – Nhà bán
                  </div>
                  <div class="col-sm-3 item-col-3">
                    <b>Mã số:</b><span class="item_gia">Liên hệ</span> <br/>
                    <b>Giá:</b><span class="item_gia">Liên hệ</span> <br/>
                    <b>Khu vực:</b><span class="item_gia">Liên hệ</span> <br/>
                    <b>Lượt xem:</b><span class="item_gia">Liên hệ</span> <br/>
                    <b>Ngày đăng:</b><span class="item_gia">Liên hệ</span> <br/>
                  </div>
            </div>
        </div> -->
  </div>
</div>


<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tin Mới Nhất<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CListView', array(
                                'id' => 'list_moi_nhat',
                                'dataProvider'=>$list_tin_moi,
                                'itemView'=>'nha_dat/_item_noi_bat',
                                // 'enableHistory'=> true,
                                'pagerCssClass' => 'pagination',
                                'ajaxUpdate'=>'list_moi_nhat',
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

<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title"><span class="glyphicon glyphicon-star"></span> Tin Xem Nhiều Nhất <a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CListView', array(
                                'id' => 'list_xem_nhieu',
                                'dataProvider'=>$list_xem_nhieu,
                                'itemView'=>'nha_dat/_item_xem_nhieu',
                                // 'enableHistory'=> true,
                                'pagerCssClass' => 'pagination',
                                'ajaxUpdate'=>'list_xem_nhieu',
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
        <!-- <div class="col-sm-12 index_nha_dang_ban">
            <div class="col-sm-6"><a href="">Nhà dang bán tại di an, 1 tỷ, sổ đỏ, mặt dường</a></div>
            <div class="col-sm-2">Khu vực: abc xvwje</div>
            <div class="col-sm-2">Giá: 100 triệu</div>
            <div class="col-sm-2">Ngày đăng: 10/01/2015</div>
        </div> -->
  </div>
</div>