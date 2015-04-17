<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);
$this->menu=array(
	array('label'=>'List Danh Mục Cha', 'url'=>array('index')),
	array('label'=>'List Danh Mục Con', 'url'=>array('indexCon', 'parent_id'=>$parent_id)),
	array('label'=>'Tạo Menu Con', 'url'=>array('createCon', 'parent_id'=>$parent_id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-tin-grid', {
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
	$.fn.yiiGridView.update('category-tin-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"category-tin-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('category-tin-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('category-tin-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#category-tin-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('category-tin-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('category-tin-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style='display:none'>
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
				'name',
				array(
					//'header' => 'customHeader',
					'name'=>'status',
					'type'=>'status',
					'value'=>'array("id"=>$data->id,"status"=>$data->status)',
					'htmlOptions' => array('style' => 'text-align:center;')
			   ),
				

				// array(
				// 	'header' => 'Danh mục con',
				// 	'type'=>'CategoryNameCon',
				// 	'value'=>'$data->id',
				// 	// 'name' => 'parent_id',
				// 	'htmlOptions' => array('style' => 'text-align:left;'),
				// ),
				array(
					//'header' => 'customHeader',
					'name' => 'created_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'updated_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
				),
				array(
					//'header' => 'customHeader',
					'name' => 'order_display',
					'htmlOptions' => array('style' => 'text-align:right;'),
				),

				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> '{view}{update}{delete}',
					'buttons' => array(
							// 'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							'update' => array(
								'url' => 'Yii::app()->createAbsoluteUrl("admin/cateTin/updateCon", array("id"=>$data->id,"parent_id"=>$data->parent_id)) '
								),
							'view' => array(
								'url' =>' Yii::app()->createAbsoluteUrl("admin/cateTin/viewCon", array("id"=>$data->id, "parent_id"=>$data->parent_id )) '
								)
					), 
					/*'buttons' => array(
							'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
							'view' => array('visible' => 'strpos("' . $actions . '", "view") !== false')
							), */
				),
			));
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'category-tin-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'category-tin-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				//'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->searchCon($parent_id),
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
