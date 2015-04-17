<?php
if(!empty($data))
{
	$image_default = TinNhaDatImage::showDefaultImage($data->id,'model');

	?>
	<div class="item row-fluid">
	    <div class="col-sm-12 item_tieu_de">
	        <div class="col-sm-9 item_tieu_de_name"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>"><?php echo $data->title; ?></a></div>
	        <!-- <div class="col-sm-3  item_tieu_de_xem_chi_tiet">
	            <div class="pull-right"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>">xem chi tiết</a></div>
	        </div> -->
	    </div>
	    <div class="col-sm-12 item_content">
	    	<a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>">
	          	<?php 
	          	if(!empty($image_default->name)){ ?>
	          		<img class="col-sm-2 img-responsive img-thumbnail" src="<?php echo $image_default->getImageUrl('name','thumb1'); ?>" alt=""/>
	          	<?php }else{
	          		echo '<img class="col-sm-2 img-responsive img-thumbnail" src="'.Yii::app()->createAbsoluteUrl('/').'/upload/logonha.jpg" alt=""/>';
	          		} ?>
          	</a>
	          	<div class="col-sm-6">
	              	<?php echo nl2br($data->short_content); ?>
	          	</div>
	          <div class="col-sm-4 item-col-3">
	            <!-- Mã số: <span class="item_ma_so"><?php echo 'MS_'.$data->id; ?></span> <br/> -->
	            Giá: <span class="item_gia"><?php echo Yii::app()->format->gia($data->gia);  ?></span> <br/>
	            Diện tích: <span class="item_dien_tich"><?php echo $data->dien_tich.' m<sup>2</sup>';  ?></span> <br/>
	            Khu Vực: <span class="item_khu_vuc"><?php echo Yii::app()->format->categoryName($data->category_parent_id).' <span class="glyphicon glyphicon-arrow-right"></span> '.Yii::app()->format->categoryName($data->category_sub_id);  ?></span> <br/>
	            Lượt xem: <span class="item_luot_xem"><?php echo $data->view; ?></span> <br/>
	            Ngày đăng: <span class="item_ngay_dang"><?php echo Yii::app()->format->date($data->updated_date);  ?></span> <br/>
	          </div>
	    </div>
	</div>
	<?php
}

?>