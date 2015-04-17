<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('index'),
	'Create ' . $this->singleTitle,
);
if( Yii::app()->controller->action->id == 'indexChuaDuyet' )
				$menuindex = array('label' => $this->pluralTitle, 'url' => array('indexChuaDuyet'), 'icon' => $this->iconList);
			else if( Yii::app()->controller->action->id == 'indexKhongDuyet' )
				$menuindex = array('label' => $this->pluralTitle, 'url' => array('indexKhongDuyet'), 'icon' => $this->iconList);
			else if( Yii::app()->controller->action->id == 'index' )
				$menuindex = array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList);



$this->menu = array(		
        array('label' => $this->pluralTitle, 'url' => array('index'), 'icon' => $this->iconList),
);

?>

<h1>Create <?php echo $this->singleTitle; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
