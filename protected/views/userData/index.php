<?php
$this->breadcrumbs=array(
	'User Datas',
);

$this->menu=array(
array('label'=>'Create UserData','url'=>array('create')),
array('label'=>'Manage UserData','url'=>array('admin')),
);
?>

<h1>User Datas</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
