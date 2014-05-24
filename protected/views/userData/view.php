<?php
$this->breadcrumbs=array(
	'User Datas'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List UserData','url'=>array('index')),
array('label'=>'Create UserData','url'=>array('create')),
array('label'=>'Update UserData','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete UserData','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage UserData','url'=>array('admin')),
);
?>

<h1>View UserData #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'data1',
		'data2',
		'data3',
		'data4',
),
)); ?>
