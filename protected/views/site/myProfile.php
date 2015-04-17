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
    <h3 class="panel-title" id="panel-title">Chào <?php echo $model->full_name; ?><a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a></h3>
  </div>
  <div class="panel-body">
			<div class="col-sm-12">
				<div class="col-sm-2">
					<?php 
					$Tcontroller = Yii::app()->controller->id;
					$Taction = Yii::app()->controller->action->id;
					// $user = Users::model()->findByPk(Yii::app()->user->id);
					echo StringHelper::getMenuThanhVien($Tcontroller, $Taction,$model ); 
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
												<?php echo $form->labelEx($model,'username', array('class' => 'col-sm-2 control-label')); ?>
												<div class="col-sm-10">
													<?php echo $form->textField($model,'username', array('class' => 'form-control', 'maxlength' => 255, 'readonly'=>'readonly')); ?>
													<?php echo $form->error($model,'username'); ?>
												</div>
										</div>
										<div class='form-group form-group-sm'>
												<?php echo $form->labelEx($model,'email', array('class' => 'col-sm-2 control-label')); ?>
												<div class="col-sm-10">
													<?php echo $form->textField($model,'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
													<?php echo $form->error($model,'email'); ?>
												</div>
										</div>

										<div class='form-group form-group-sm'>
												<?php echo $form->labelEx($model,'full_name', array('class' => 'col-sm-2 control-label')); ?>
												<div class="col-sm-10">
													<?php echo $form->textField($model,'full_name', array('class' => 'form-control', 'maxlength' => 255)); ?>
													<?php echo $form->error($model,'full_name'); ?>
												</div>
										</div>

										<h2>Thay Đổi Password</h2>
										Bỏ trống nếu không muốn đổi.<br/>

										<div class='form-group form-group-sm'>
												<?php echo $form->labelEx($model,'currentPassword', array('class' => 'col-sm-2 control-label')); ?>
												<div class="col-sm-10">
													<?php echo $form->passwordField($model,'currentPassword', array('class' => 'form-control', 'maxlength' => 255)); ?>
													<?php echo $form->error($model,'currentPassword'); ?>
												</div>
										</div>
										<div class='form-group form-group-sm'>
												<?php echo $form->labelEx($model,'newPassword', array('class' => 'col-sm-2 control-label')); ?>
												<div class="col-sm-10">
													<?php echo $form->passwordField($model,'newPassword', array('class' => 'form-control', 'maxlength' => 255)); ?>
													<?php echo $form->error($model,'newPassword'); ?>
												</div>
										</div>
										<div class='form-group form-group-sm'>
												<?php echo $form->labelEx($model,'password_confirm', array('class' => 'col-sm-2 control-label')); ?>
												<div class="col-sm-10">
													<?php echo $form->passwordField($model,'password_confirm', array('class' => 'form-control', 'maxlength' => 255)); ?>
													<?php echo $form->error($model,'password_confirm'); ?>
												</div>
										</div>


										<div class="clr"></div>
										<div >
											<?php echo CHtml::htmlButton('<span class="glyphicon glyphicon-plus"></span> SAVE' , array('class' => 'btn btn-primary', 'type' => 'submit')); ?> &nbsp;  
											<?php //echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Cancel', array('class' => 'btn btn-default', 'onclick' => 'javascript: location.href=\'' . $this->baseControllerIndexUrl() . '\'')); ?>
										</div>
									<?php $this->endWidget(); ?>
									</div>
				</div>
			</div>
	</div>
</div>
