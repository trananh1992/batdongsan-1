<style type="text/css">
	.active a{
		color: #fff;
		font-size: 16px;
		font-weight: bold;
	}
	.active{
		padding: 5px;
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
					$Tcontroller = Yii::app()->controller->id;
					$Taction = Yii::app()->controller->action->id;
					echo StringHelper::getMenuTin( $Tcontroller, $Taction,$user );
					?>
					<div class="form well">
						<?php
						$this->widget('zii.widgets.CListView', array(
						        'id' => 'list_nha_dat',
						        'dataProvider'=>$model->searchThanhVien_daduyet($user->id),
						        'itemView'=>'_item_tin_da_duyet',
						        // 'enableHistory'=> true,
						        'pagerCssClass' => 'pagination',
						        'ajaxUpdate'=>'list_nha_dat',
						        // 'ajaxUpdate' => true,
						        // 'loadingCssClass' => '', //remove loading icon
						        'summaryText' => '',
						        'emptyText' => '<div class="alert alert-info">Không tìm thấy tin nào!</div>',
						        // 'emptyText' => '',
						        'enablePagination' => true,
						        
						        'pager' => array(
						            'maxButtonCount' => 10,
						            'id'=>'pager_featured',
						            'header' => false,
						            'firstPageLabel' => 'First',
						            'prevPageLabel' => 'Prev',
						            // 'previousPageCssClass' => 'prev',
						            'nextPageLabel' => 'Next',
						            // 'nextPageCssClass' => 'next',
						            'lastPageLabel' => 'Last',
						            'maxButtonCount' => 5,
						            // 'cssFile' => false,
						            'htmlOptions' => array('class' => 'pager'),                            
						            // 'htmlOptions' => array('class' => 'pager','style'=>'display: none;'),                            
						        ),
						    ));
						?>
					</div>
				</div>
			</div>
	</div>
</div>
