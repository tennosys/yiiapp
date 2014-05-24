<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'data1',array('class'=>'span5','maxlength'=>35)); ?>

		<?php echo $form->textFieldRow($model,'data2',array('class'=>'span5','maxlength'=>35)); ?>

		<?php echo $form->textFieldRow($model,'data3',array('class'=>'span5','maxlength'=>35)); ?>

		<?php echo $form->textFieldRow($model,'data4',array('class'=>'span5','maxlength'=>35)); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
