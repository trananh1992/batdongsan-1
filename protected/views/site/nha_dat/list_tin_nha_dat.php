<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title"><?php echo $breadcrum; ?><a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
        <?php
        $this->widget('zii.widgets.CListView', array(
                                'id' => 'list_nha_dat',
                                'dataProvider'=>$list_nha_dat,
                                'itemView'=>'nha_dat/_item_noi_bat',
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