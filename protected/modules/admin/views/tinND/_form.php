<?php 
// echo '<pre>';
// print_r($model->getErrors());
// echo '</pre>';
?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $model->isNewRecord ? $this->iconCreate : $this->iconEdit; ?>"></span> <?php echo $model->isNewRecord ? 'Create' : 'Update'; ?> <?php echo $this->singleTitle ?></h3>
	</div>
	<div class="panel-body">
		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id' => 'tin-nha-dat-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
		)); ?>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'short_content', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textArea($model,'short_content', array('class' => 'col-sm-10', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'short_content'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'content', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textArea($model,'content', array('class' => 'ver_editor_full', 'cols' => 63, 'rows' => 5)); ?>
						<?php echo $form->error($model,'content'); ?>
					</div>
			</div>
    		

    		<!--Product Photo  -->
    		<div class='form-group form-group-sm'>
    		    <?php echo $form->labelEx($model, 'product_photo', array('class' => 'col-sm-2 control-label')); ?>
    		    <div class="col-sm-6">
    		        <div>
    		            <?php
    		            $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
    		                'id' => 'fileUploader_product_photo',
    		                // 'addmore' => false,
    		                'config' => array(
    		                    'action' => Yii::app()->createAbsoluteUrl('admin/tinND/uploadingEAjax'),
    		                    'allowedExtensions' => array("jpg", "png", "gif"), //array("jpg","jpeg","gif","exe","mov" and etc...
    		                    'sizeLimit' => 2 * 1024 * 1024, // maximum file size in bytes
    		                    'onComplete' => "js:function(id, fileName, responseJSON)
    		                                {
    		                                    $.unblockUI();
    		                                    console.log(responseJSON['filename']);
    		                                    jQuery('.qq-upload-list').show();
    		                                    jQuery('.qq-upload-button input[type=\'file\']').attr('disabled', true);
    		                                    showImage(responseJSON['filename']);
    		                                }",
    		                    'onSubmit' => "js:function(){
    		                    				$.blockUI({ message: null });
									                    //$('#uploadFile .qq-upload-list').html(''); 
									                    // This will empty list
							 				}",
							 	'onProgress' => "js:function(id, fileName, loaded, total){

							 				}",
								'onCancel' => "js:function(){
											$.unblockUI();
								}",
    		                )
    		            ));
    		            ?>

    		        </div>
    		        <div class='notes'>
    		            Ảnh định dạng  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Kích thước tối đa : 2Mb (Do host của anh quy định 2M)
    		        </div>

    		        <ul id="image_data_product_photo" style="list-style-type: none; width: 100%; margin-left: -40px; margin-top: 0px; margin-bottom: 5px;"> 
    		            <?php
    		            $arr_more_image = TinNhaDatImage::getAllImage($model->id);
    		            if (!empty($arr_more_image))
    		                foreach ($arr_more_image as $image) 
    		                {
    		                    if (!empty($image)) 
    		                    {
    		                        $idfile = $image->id;
    		                        $namefile = $image->name;
    		                        $linkfile = ImageHelper::getImageUrl($image, 'name', '100x100');
    		                        $this->renderPartial('__image_view', array(
    		                            'idfile' => $idfile,
    		                            'namefile' => $namefile,
    		                            'linkfile' => $linkfile,
    		                            'image' => $image
    		                                ), false, false);
    		                    }
    		                }
    		            ?>

    		        </ul>
    		        <?php echo $form->error($model, 'product_photo'); ?>
    		    </div>
    		</div>


			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'category_parent_id', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'category_parent_id', CategoryTin::getListDichVu(), array('class' => 'form-control', 'onchange' => 'getHtmlMenuCon(this) ' )); ?>
						<?php echo $form->error($model,'category_parent_id'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm' >
					<?php echo $form->labelEx($model,'category_sub_id', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6" id="category_sub_id" >
						<?php echo $form->dropDownList($model,'category_sub_id', CategoryTin::getListDichVu_Con(), array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'category_sub_id'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'gia', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'gia', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'gia'); ?>
						<div class="note">VD: 100 triệu thì gõ vào 100000000<br/>Nếu để trống là giá liên hệ</div>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'ten_nguoi_dang', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'ten_nguoi_dang', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'ten_nguoi_dang'); ?>
					</div>
			</div>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'dia_chi', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'dia_chi', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'dia_chi'); ?>
					</div>
			</div>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'sdt_lien_he', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'sdt_lien_he', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'sdt_lien_he'); ?>
					</div>
			</div>
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'dien_tich', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->textField($model,'dien_tich', array('class' => 'form-control', 'maxlength' => 255)); ?>
						<?php echo $form->error($model,'dien_tich'); ?>
						<div class="note">VD: 100 mét vuông thì gõ vào 100</div>
					</div>
			</div>
    
    		<?php
    		$_tmp = array(); for($i=1; $i<=100; $i++ ) 	$_tmp[$i] = $i;
    		?>
    		<div class='form-group form-group-sm'>
    				<?php echo $form->labelEx($model, 'order_display', array('class' => 'col-sm-2 control-label')); ?>
    				<div class="col-sm-6">
    					<?php echo $form->dropDownList($model,'order_display',$_tmp , array('class' => 'form-control') ); ?>
    					<?php echo $form->error($model, 'order_display'); ?>
    				</div>
    		</div>
			
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'status', $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
			</div>

			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'can_ban_gap', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'can_ban_gap', array(''=>'---Chọn---')+TinNhaDat::$arr_can_ban_gap , array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'can_ban_gap'); ?>
					</div>
			</div>


			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_duyet_tin', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'is_duyet_tin', array(''=>'---Duyet Tin---')+ TinNhaDat::$arr_duyet_tin , array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_duyet_tin'); ?>
					</div>
			</div>
    
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_home', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'is_home', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_home'); ?>
					</div>
			</div>
    
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_hot', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'is_hot', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_hot'); ?>
					</div>
			</div>
    
    	<?php
    	/*
			<div class='form-group form-group-sm'>
					<?php echo $form->labelEx($model,'is_default', array('class' => 'col-sm-2 control-label')); ?>
					<div class="col-sm-6">
						<?php echo $form->dropDownList($model,'is_default', $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_default'); ?>
					</div>
			</div>
    	*/
			?>
			
			<div class="clr"></div>
			<div class="well">
				<?php echo CHtml::htmlButton($model->isNewRecord ? '<span class="' . $this->iconCreate . '"></span> Create' : '<span class="' . $this->iconSave . '"></span> Save', array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
				<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>
</div>


<script type="text/javascript">
	function getHtmlMenuCon(object)
	{
		var parent_id = $('#TinNhaDat_category_parent_id option:selected').val();
		$.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl("admin/tinND/getHtmlMenuCon"); ?>',
            data:{
                'parent_id':parent_id
            },
            type: 'POST',
            beforeSend: function() {
            	$.blockUI({ message: null });
            },
            success: function(data, textStatus, xhr) 
            {
            	$.unblockUI();
                console.log(data);
                $('#TinNhaDat_category_sub_id').html(data);
            },
            error: function(xhr, textStatus, errorThrown) {
            	$.unblockUI();
                // $('#'+id+' .contentarea').html(textStatus);
                console.log(data);
            }
        });
	}
</script>
<script type="text/javascript">
   function showImage(filename)
   {
       jQuery.ajax({
           url: "<?php echo Yii::app()->createAbsoluteUrl('admin/tinND/ajaxRenderImageView'); ?>",
           type: "post",
           data: {
               'filename': filename
           },
           beforeSend: function() {
            	$.blockUI({ message: null });
            },
           success: function(data) 
           {
           		$.unblockUI();
               jQuery('#image_data_product_photo').append(data);
               jQuery('.qq-upload-button input[type="file"]').attr("disabled", false);
           },
           error: function() {
           		$.unblockUI();
               jQuery('.qq-upload-button input[type="file"]').attr("disabled", false);
           }
       });
   }
</script>