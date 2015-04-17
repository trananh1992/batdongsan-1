<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);
$this->menu=array(
	array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tin-nha-dat-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});

$('#clearsearch').click(function(){
	var id='search-form';
	var inputSelector='#'+id+' input, '+'#'+id+' select';
	$(inputSelector).each( function(i,o) {
		 $(o).val('');
	});
	var data=$.param($(inputSelector));
	$.fn.yiiGridView.update('tin-nha-dat-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"tin-nha-dat-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('tin-nha-dat-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('tin-nha-dat-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#tin-nha-dat-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('tin-nha-dat-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('tin-nha-dat-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form'>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?></div>

<?php echo $this->renderControlNav();?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $this->iconList; ?>"></span> Listing</h3>
	</div>
	<div class="panel-body">
		<?php 
			$allowAction = in_array("delete", $this->listActionsCanAccess)?'CCheckBoxColumn':'';
			$columnArray = array();
			if (in_array("Delete", $this->listActionsCanAccess))
			{
				$columnArray[] = array(
									'value'=>'$data->id',
									'class'=> "CCheckBoxColumn",
								);
			}
			$columnArray = array_merge($columnArray, array(
				array(
					'header' => 'S/N',
					'type' => 'raw',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				),
								'title',
				array(
					'header' => 'Image',
					'type'=>'raw',
					// 'name' => 'category_parent_id',
					'htmlOptions' => array('style' => 'text-align:right;'),
					'value'=>'TinNhaDatImage::showDefaultImage($data->id, "image")'
				),
				array(
					'header' => 'Thành Viên Đăng',
					// 'name' => 'category_parent_id',
					'type'=>'raw',
					'htmlOptions' => array('style' => 'text-align:center;'),
					'value' => 'Users::getUsernameById($data->user_id)',
				),

				array(
					//'header' => 'customHeader',
					'name'=>'status',
					'type'=>'status',
					'value'=>'array("id"=>$data->id,"status"=>$data->status)',
					'htmlOptions' => array('style' => 'text-align:center;')
			   ),

				array(
					'header' => 'Duyệt Tin',
					// 'name' => 'category_parent_id',
					'type'=>'raw',
					'htmlOptions' => array('style' => 'text-align:center;'),
					'value'=>'Users::duyetTin($data->is_duyet_tin)',
				),
				array(
					'header' => 'Cần Bán',
					// 'name' => 'category_parent_id',
					'type'=>'raw',
					'htmlOptions' => array('style' => 'text-align:center;'),
					'value'=> 'Yii::app()->format->CanBanGap($data->can_ban_gap)',
				),

				// 'get_from',
				array(
					//'header' => 'customHeader',
					'name' => 'category_parent_id',
					'type'=>'categoryName',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'category_sub_id',
					'type'=>'categoryName',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				
				// array(
				// 	//'header' => 'customHeader',
				// 	'name' => 'order_display',
				// 	'htmlOptions' => array('style' => 'text-align:right;'),
				// ),
				
				// array(
				// 	//'header' => 'customHeader',
				// 	'name' => 'view',
				// 	'htmlOptions' => array('style' => 'text-align:right;'),
				// ),
				// array(
				// 	//'header' => 'customHeader',
				// 	'type'=>'gia',
				// 	'name' => 'gia',
				// 	'htmlOptions' => array('style' => 'text-align:right;'),
				// ),
				array(
					//'header' => 'customHeader',
					'name' => 'sdt_lien_he',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				// array(
				// 	//'header' => 'customHeader',
				// 	'name' => 'dia_chi',
				// 	'htmlOptions' => array('style' => 'text-align:right;'),
				// ),
				array(
					//'header' => 'customHeader',
					'name' => 'ten_nguoi_dang',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				// array(
				// 	//'header' => 'customHeader',
				// 	'name' => 'dien_tich',
				// 	'htmlOptions' => array('style' => 'text-align:right;'),
				// ),
				array(
					//'header' => 'customHeader',
					'name' => 'is_home',
					'type'=>'yesNo',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'is_hot',
					'type'=>'yesNo',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),
				// array(
				// 	//'header' => 'customHeader',
				// 	'name' => 'is_default',
				// 	'htmlOptions' => array('style' => 'text-align:right;'),
				// ),
				array(
					//'header' => 'customHeader',
					'name' => 'created_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),
				// array(
				// 	//'header' => 'customHeader',
				// 	'name' => 'updated_date',
				// 	'type' => 'date',
				// 	'htmlOptions' => array('style' => 'text-align:center;'),
				// ),
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> '{view}{update}{delete}',
					/*'buttons' => array(
							'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
							'view' => array('visible' => 'strpos("' . $actions . '", "view") !== false')
							), */
				),
			));
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'tin-nha-dat-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			if( Yii::app()->controller->action->id == 'indexChuaDuyet' )
				$dataProvider = $model->searchChuaDuyet();
			else if( Yii::app()->controller->action->id == 'indexKhongDuyet' )
				$dataProvider = $model->searchKhongDuyet();
			else if( Yii::app()->controller->action->id == 'index' )
				$dataProvider = $model->search();

			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'tin-nha-dat-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				//'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$dataProvider,
				'pager'=>array(
							'header'         => '',
							'prevPageLabel'  => 'Prev',
							'firstPageLabel' => 'First',
							'lastPageLabel'  => 'Last',
							'nextPageLabel'  => 'Next',
						),
				'selectableRows'=>2,
				'columns'=>$columnArray,
		)); 
		$this->endWidget();
		?>
