<?php
$this->breadcrumbs=array(
	'User Datas'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List UserData','url'=>array('index')),
array('label'=>'Manage UserData','url'=>array('admin')),
);
?>

<h1>Create UserData</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>