<style type="text/css">
	.duyettin{
		margin-left: 20px;
	}
</style>
<?php
if(!empty($data))
{
	echo '<div class="panel panel-info" id="div_duyet_tin_'.$data->id.'" >
			  <div class="panel-heading"><h4 style="color: #081890;">Tiêu đề: '.$data->title.'</h4></div>
			  <div class="panel-body duyettin">
			    	Miêu tả ngắn: <p><b>'.$data->short_content.'</b></p><br/>';
			  ?>
			    	<p>Người Đăng: <span style="color: #a04401;"><b><?php echo $data->ten_nguoi_dang; ?></b></span></p>
			    	<p>Điện Thoại Liên Hệ: <span style="color: #4209aa;"><b><?php echo $data->sdt_lien_he; ?></b></span></p>
			    	<p>Địa Chỉ: <span style="color: #000;"><b><?php echo $data->dia_chi; ?></b></span></p>
			    	<p>Diện Tích: <span style="color: #000;"><b><?php echo $data->dien_tich; ?> m<sup>2</sup></b></span></p>
			    	<p>Thuộc Mục: <span style="color: #4e4800;"><b><?php echo Yii::app()->format->categoryName($data->category_parent_id).' <span class="glyphicon glyphicon-arrow-right"></span> '.Yii::app()->format->categoryName($data->category_sub_id);  ?></b></span></p>
			    	<p>Giá: <span style="color: red;"><b><?php echo Yii::app()->format->gia($data->gia);  ?></b></span></p>
			    	<p>Ngày Đăng: <span style="color: #0410fd;"><i><?php echo Yii::app()->format->date($data->updated_date);  ?></i></span></p>


			    <?php
			    	echo '<br/>';
			    	echo '<button class="btn btn-primary"><a style="color:#fff;" target="_blank" href="'.Yii::app()->createAbsoluteUrl('thanhvien/tinDetail', array('slug'=>$data->slug)).'">Xem trước</a></button>';
			    	echo '<button class="btn btn-warning"><a style="color:#fff;" onclick="xoaTinDetail(this, '.$data->id.' , '.Yii::app()->user->id.', \'#div_duyet_tin_'.$data->id.'\' );">Xóa</a></button>';

	echo '
			  </div>
			</div>';
	
}
?>