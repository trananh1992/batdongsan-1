<?php
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    'View ' . $this->singleTitle . ' : ' . $title_name,
);

$this->menu = array(
    array('label' => 'Danh mục Con', 'url' => array('indexCon', 'parent_id'=>$parent_id), 'icon' => $this->iconList),  
    array('label'=> 'Update Menu Con', 'url'=>array('updateCon', 'id'=>$model->id, 'parent_id'=>$parent_id)),
    array('label' => 'Create Menu Con', 'url' => array('createCon', 'parent_id'=>$parent_id)),
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
                        'name' => 'name',
                        'type' => 'html',
                    ),

				// array(
    //                     //'label'=> 'customLabel',
    //                     'name' => 'slug',
    //                     'type' => 'html',
    //                 ),
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

				array(
                        //'label'=> 'customLabel',
                        'name' => 'order_display',
                        'type' => 'html',
                    ),

				// array(
    //                     'label'=> 'Danh Mục Con',
    //                     'name' => 'parent_id',
    //                     'value'=> $model->id,
    //                     'type' => 'CategoryNameCon',
    //                 ),
        ),
    )); ?>
    
</div>
