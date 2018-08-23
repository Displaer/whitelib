<?php
/* @var $this BooksController */
/* @var $model TblBooks */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tbl-books-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longname'); ?>
		<?php echo $form->textField($model,'longname',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'longname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'annotation'); ?>
		<?php echo $form->textArea($model,'annotation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'annotation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'published_year'); ?>
		<?php echo $form->textField($model,'published_year'); ?>
		<?php echo $form->error($model,'published_year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'book_url'); ?>
		<?php echo $form->textField($model,'book_url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'book_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cover_erl'); ?>
		<?php echo $form->textField($model,'cover_erl',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'cover_erl'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'author_count'); ?>
		<?php echo $form->textField($model,'author_count'); ?>
		<?php echo $form->error($model,'author_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page_count'); ?>
		<?php echo $form->textField($model,'page_count'); ?>
		<?php echo $form->error($model,'page_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->textField($model,'deleted',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->