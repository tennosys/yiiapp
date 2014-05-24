<?php
$this->breadcrumbs=array(
	'User Datas'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List UserData','url'=>array('index')),
	array('label'=>'Create UserData','url'=>array('create')),
	array('label'=>'View UserData','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage UserData','url'=>array('admin')),
	);
	?>

	<h1>Update UserData <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>