<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle . ' : ' . $title_name,
);

if( Yii::app()->controller->action->id == 'indexChuaDuyet' )
                $menuindex = array('label' => $this->pluralTitle, 'url' => array('indexChuaDuyet'), 'icon' => $this->iconList);
            else if( Yii::app()->controller->action->id == 'indexKhongDuyet' )
                $menuindex = array('label' => $this->pluralTitle, 'url' => array('indexKhongDuyet'), 'icon' => $this->iconList);
            else if( Yii::app()->controller->action->id == 'index' )
                $menuindex = array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList);


$this->menu = array(
    // $menuindex,  
    array('label'=> 'Update '. $this->singleTitle, 'url'=>array('update', 'id'=>$model->id)),
    array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);   

?>
<h1>View <?php echo $this->singleTitle . ' : ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="glyphicon glyphicon-list-alt"></span> View <?php echo $this->singleTitle?></h3>
    </div>
    <div class="panel-body">
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array( 
        
				array(
                        //'label'=> 'customLabel',
                        'name' => 'title',
                        'type' => 'html',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'short_content',
                        'type' => 'html',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'content',
                        'type' => 'html',
                    ),

                array(
                        'label'=> 'Thành Viên Đăng Tin',
                        // 'name' => 'user_id',
                        'type' => 'html',
                        'value'=> Users::getUsernameById($model->user_id),
                    ),
                array(
                        'label'=> 'Duyệt Tin',
                        // 'name' => 'user_id',
                        'type' => 'html',
                        'value'=> Users::duyetTin($model->is_duyet_tin),
                    ),
                array(
                        'label'=> 'Cần Bán Gấp',
                        // 'name' => 'user_id',
                        'type' => 'html',
                        'value'=> Yii::app()->format->CanBanGap($model->can_ban_gap),
                    ),

                array(
                        'label'=> 'Hinh Mac Dinh',
                        // 'name' => 'image',
                        'type'=>'raw',
                        'value' => TinNhaDatImage::showDefaultImage($model->id, 'image'),
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'image',
                        'type'=>'raw',
                        'value' => TinNhaDatImage::showAllImage($model->id, 'image'),
                    ),

                array(
                        //'label'=> 'customLabel',
                        'name' => 'gia',
                        'type' => 'gia',
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'sdt_lien_he',
                        'type' => 'html',
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'dia_chi',
                        'type' => 'html',
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'ten_nguoi_dang',
                        'type' => 'html',
                    ),
                array(
                        //'label'=> 'customLabel',
                        'name' => 'dien_tich',
                        'type' => 'html',
                    ),
				

				array(
                        //'label'=> 'customLabel',
                        'name' => 'category_parent_id',
                        'type' => 'categoryName',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'category_sub_id',
                        'type' => 'categoryName',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'order_display',
                        'type' => 'html',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'view',
                        'type' => 'html',
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'is_home',
                        'type' => 'html',
                        'value'=> $model->is_home == TYPE_YES ? 'YES':"",
                    ),

				array(
                        //'label'=> 'customLabel',
                        'name' => 'is_hot',
                        'type' => 'html',
                        'value'=> $model->is_hot == TYPE_YES ? 'YES':"",
                    ),

				
				array(
                        //'label'=> 'customLabel',
                        'name' => 'created_date',
                        'type' => 'date',
                    ),
				array(
                        //'label'=> 'customLabel',
                        'name' => 'updated_date',
                        'type' => 'date',
                    ),
        ),
    )); ?>
    <div class="well">
        <?php echo CHtml::htmlButton('<span class="' . $this->iconBack . '"></span> Back', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\''.  $this->baseControllerIndexUrl() . '\'')); ?>    </div>
    </div>
</div>
