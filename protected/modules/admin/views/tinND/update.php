<?php
$this->breadcrumbs = array(
	$this->pluralTitle => array('index'),
	'Update ' . $this->singleTitle,
);

if( Yii::app()->controller->action->id == 'indexChuaDuyet' )
				$menuindex = array('label' => $this->pluralTitle, 'url' => array('indexChuaDuyet'), 'icon' => $this->iconList);
			else if( Yii::app()->controller->action->id == 'indexKhongDuyet' )
				$menuindex = array('label' => $this->pluralTitle, 'url' => array('indexKhongDuyet'), 'icon' => $this->iconList);
			else if( Yii::app()->controller->action->id == 'index' )
				$menuindex = array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList);


$this->menu = array(	
	// $menuindex,
	array('label' => 'View ' . $this->singleTitle, 'url' => array('view', 'id' => $model->id)),	
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create')),
);
?>

<h1>Update <?php echo $this->singleTitle . ': ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
