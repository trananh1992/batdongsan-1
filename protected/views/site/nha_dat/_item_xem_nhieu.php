<?php
if(!empty($data))
{
	?>
	<div class="col-sm-12 index_nha_dang_ban">
	    <div class="col-sm-6"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$data->slug)); ?>"><?php echo $data->title; ?></a></div>
	    <div class="col-sm-2"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> <span class="item_khu_vuc"><?php echo Yii::app()->format->categoryName($data->category_parent_id).' <span class="glyphicon glyphicon-arrow-right"></span> '.Yii::app()->format->categoryName($data->category_sub_id);  ?></span></div>
	    <div class="col-sm-2"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <span class="item_gia"><?php echo Yii::app()->format->gia($data->gia);  ?></span></div>
	    <div class="col-sm-2">
	    						<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> 
    							<span class="item_ngay_dang"><?php echo Yii::app()->format->date($data->updated_date);  ?></span>
    							<br/>
    							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> 
    							<span class=""><?php echo $data->view;  ?> lần</span>
	    </div>
	</div>
	<?php
}
?>