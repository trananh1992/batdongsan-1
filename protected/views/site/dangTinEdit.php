<style type="text/css">
	span.required{
		color:red;
	}
	.errorMessage{
		color:red;
	}
</style>
<div class="panel panel-primary  main-panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title" id="panel-title">Chào <?php echo $user->full_name; ?><a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
			<div class="col-sm-12">
				<div class="col-sm-2">
					<?php 
					$Tcontroller = Yii::app()->controller->id;
					$Taction = Yii::app()->controller->action->id;
					// $user = Users::model()->findByPk(Yii::app()->user->id);
					echo StringHelper::getMenuThanhVien($Tcontroller, $Taction,$user ); 
					?>

				</div>



				<div class="col-sm-10">
					<?php
						$this->renderNotifyMessage(); 
					?>
							<div class="form well">
							<?php $form=$this->beginWidget('CActiveForm', array(
								'id' => 'tin-nha-dat-form',
								'enableAjaxValidation'=>false,
								'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data'),
							)); ?>

								<div class='form-group form-group-sm'>
									<div class="col-sm-12">
										<?php 
										$smartBlock = SmartBlock::model()->findByPk(60);
										if(!empty($smartBlock)) echo $smartBlock->content;
										?>
									</div>
								</div>
								<div class='form-group form-group-sm'>
										<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-2 control-label')); ?>
										<div class="col-sm-10">
											<?php echo $form->textField($model,'title', array('class' => 'form-control', 'maxlength' => 255)); ?>
											<?php echo $form->error($model,'title'); ?>
										</div>
								</div>
					    
								<div class='form-group form-group-sm'>
										<?php echo $form->labelEx($model,'short_content', array('class' => 'col-sm-2 control-label')); ?>
										<div class="col-sm-10">
											<?php echo $form->textArea($model,'short_content', array('class' => 'col-sm-12', 'cols' => 63, 'rows' => 5)); ?>
											<br/><?php echo $form->error($model,'short_content'); ?>
										</div>
								</div>
					    
								<div class='form-group form-group-sm'>
										<?php echo $form->labelEx($model,'content', array('class' => 'col-sm-2 control-label')); ?>
										<div class="col-sm-10">
											<?php echo $form->textArea($model,'content', array('class' => 'ver_editor_full_fe', 'cols' => 63, 'rows' => 5)); ?>
											<?php echo $form->error($model,'content'); ?>
										</div>
								</div>
					    		

					    		<!--Product Photo  -->
					    		<div class='form-group form-group-sm'>
					    		    <?php echo $form->labelEx($model, 'product_photo', array('class' => 'col-sm-2 control-label')); ?>
					    		    <div class="col-sm-10">
					    		        <div>
					    		            <?php
					    		            $this->widget('ext.EAjaxUpload.EAjaxUpload', array(
					    		                'id' => 'fileUploader_product_photo',
					    		                // 'addmore' => false,
					    		                'config' => array(
					    		                    'action' => Yii::app()->createAbsoluteUrl('site/uploadingEAjax'),
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
					    		            Ảnh định dạng  <?php echo '*.' . str_replace(',', ', *.', $model->allowImageType); ?> - Kích thước tối đa : 2 Mb
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

					    		/*
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
								*/
								?>
								
								<div class="clr"></div>
								<div >
									<?php echo CHtml::htmlButton('<span class="glyphicon glyphicon-plus"></span> Sửa Tin' , array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
									<?php echo '<button class="btn btn-primary"><a style="color:#fff;" target="_blank" href="'.Yii::app()->createAbsoluteUrl('thanhvien/tinDetail', array('slug'=>$model->slug)).'">Xem trước</a></button>'; ?>
									<?php //echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
								</div>
							<?php $this->endWidget(); ?>
							</div>
				</div>
			</div>
	</div>
</div>

<script type="text/javascript">
	function getHtmlMenuCon(object)
	{
		var parent_id = $('#TinNhaDat_category_parent_id option:selected').val();
		$.ajax({
            url: '<?php echo Yii::app()->createAbsoluteUrl("site/getHtmlMenuCon"); ?>',
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
           url: "<?php echo Yii::app()->createAbsoluteUrl('site/ajaxRenderImageView'); ?>",
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