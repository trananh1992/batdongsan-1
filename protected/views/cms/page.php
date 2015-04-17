<!-- <div class="main clearfix">
    <div class="breadcrumb"><a href="<?php echo yii::app()->createAbsoluteUrl('')?>">Home</a> <strong><?php echo $model->title; ?></strong></div>
    <h1 class="title-2"><?php echo $model->title; ?></h1>
    <div class="document">
        <?php echo $model->content; ?>
    </div>
</div> -->

<div class="panel panel-primary  main-panel-primary">
  	<div class="panel-heading">
    	<h3 class="panel-title" id="panel-title">
    				<strong style="padding-left:20px;"><?php echo $model->title; ?></strong>
    				<a class="anchorjs-link" href="#panel-title"><span class="anchorjs-icon"></span></a>
    	</h3>
    		
  	</div>
  	<div class="panel-body">
        <div class="row-fluid" style="margin-top: 20px;">
            <div class="col-sm-12">
            	<div class="col-sm-1"></div>
            	<div class="col-sm-10"><?php echo $model->content; ?></div>
            	<div class="col-sm-1"></div>
            </div>
        </div>
    </div>
</div>