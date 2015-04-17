
<?php
//MyDebug::output(Yii::app()->user);

?>
<?php 
$count_tat_ca = TinNhaDat::model()->count();

$criteria = new CDbCriteria();
$criteria->compare('t.is_duyet_tin',CHUA_DUYET);
// $criteria->limit = ;
// $criteria->order ="id DESC";
$count_cho_duyet = TinNhaDat::model()->count($criteria);

$criteria = new CDbCriteria();
$criteria->compare('t.is_duyet_tin',KHONG_DUYET);
// $criteria->limit = ;
// $criteria->order ="id DESC";
$count_khong_duyet = TinNhaDat::model()->count($criteria);

?>
<h3>Tất cả tin nhà đất: <a style="color:#000;" href="<?php echo Yii::app()->createAbsoluteUrl('admin/tinND/index'); ?>"><?php echo $count_tat_ca; ?> tin </a></h3>
<h3>Tin chờ duyệt: <a style="color:red;" href="<?php echo Yii::app()->createAbsoluteUrl('admin/tinND/indexChuaDuyet'); ?>"><?php echo $count_cho_duyet; ?> tin </a></h3>
<h3>Tin không duyệt: <a style="color:red;" href="<?php echo Yii::app()->createAbsoluteUrl('admin/tinND/indexKhongDuyet'); ?>"><?php echo $count_khong_duyet; ?> tin </a></h3>



