<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data1')); ?>:</b>
	<?php echo CHtml::encode($data->data1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data2')); ?>:</b>
	<?php echo CHtml::encode($data->data2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data3')); ?>:</b>
	<?php echo CHtml::encode($data->data3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data4')); ?>:</b>
	<?php echo CHtml::encode($data->data4); ?>
	<br />


</div>