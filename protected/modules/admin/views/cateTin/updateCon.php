<?php
$this->breadcrumbs = array(
	$this->pluralTitle => array('index'),
	'Update ' . $this->singleTitle,
);

$this->menu = array(	
	array('label' => 'Danh mục Con', 'url' => array('indexCon', 'parent_id'=>$parent_id), 'icon' => $this->iconList),
	array('label' => 'View ', 'url' => array('viewCon', 'id' => $model->id, 'parent_id'=>$parent_id)),	
	array('label' => 'Create Menu Con', 'url' => array('createCon', 'parent_id'=>$parent_id)),
);
?>

<h1>Update <?php echo $this->singleTitle . ': ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model, 'parent_id'=>$parent_id )); ?>