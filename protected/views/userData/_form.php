<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-data-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'data1',array('class'=>'span5','maxlength'=>35)); ?>

	<?php echo $form->textFieldRow($model,'data2',array('class'=>'span5','maxlength'=>35)); ?>

	<?php echo $form->textFieldRow($model,'data3',array('class'=>'span5','maxlength'=>35)); ?>

	<?php echo $form->textFieldRow($model,'data4',array('class'=>'span5','maxlength'=>35)); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
