<div class="panel panel-default">
  <div class="panel-body">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action'=>Yii::app()->createUrl($this->route),
		'method'=>'get',
		'htmlOptions' => array('class' => 'form-horizontal', 'role' => 'form', 'id' => 'search-form'),
	)); ?>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'title', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->textField($model,'title', array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'category_parent_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php 
						echo $form->dropDownList($model,'category_parent_id', CategoryTin::getListDichVu(), array('class' => 'form-control')); 
						?>
						<?php echo $form->error($model,'category_parent_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'category_sub_id', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php 
						echo $form->dropDownList($model,'category_parent_id', array(''=>'---Chon---')+ CategoryTin::getListDichVu_Con(), array('class' => 'form-control')); 
						?>
						<?php echo $form->error($model,'category_sub_id'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'status', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'status',array(''=>'---Chon---')+ $model->optionActive, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'status'); ?>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'can_ban_gap', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'can_ban_gap',array(''=>'---Chon---')+ TinNhaDat::$arr_can_ban_gap, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'can_ban_gap'); ?>
					</div>
				</div>
			</div>

<?php if(Yii::app()->controller->action->id == 'index' ){ ?>

			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'is_duyet_tin', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'is_duyet_tin',array(''=>'---Chon---')+ TinNhaDat::$arr_duyet_tin, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_duyet_tin'); ?>
					</div>
				</div>
			</div>
<?php } ?>

			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'is_home', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'is_home', array(''=>'---Chon---')+$model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_home'); ?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group form-group-sm">
					<?php echo $form->labelEx($model,'is_hot', array('class' => 'col-sm-3 control-label')); ?>
					<div class="col-sm-7">
						<?php echo $form->dropDownList($model,'is_hot',array(''=>'---Chon---')+ $model->optionYesNo, array('class' => 'form-control')); ?>
						<?php echo $form->error($model,'is_hot'); ?>
					</div>
				</div>
			</div>
			
	<div class="col-sm-12">
		<div class="well">
			<?php echo CHtml::htmlButton('<span class="' . $this->iconSearch .  '"></span> Search', array('class' => 'btn btn-default btn-sm', 'type' => 'submit')); ?>			
			<?php echo CHtml::htmlButton('<span class="' . $this->iconCancel . '"></span> Clear', array('class' => 'btn btn-default btn-sm', 'type' => 'reset', 'id' => 'clearsearch')); ?>
		</div>
	</div> 
	<?php $this->endWidget(); ?>

	</div>
</div>




