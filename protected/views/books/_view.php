<?php
/* @var $this BooksController */
/* @var $data TblBooks */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('longname')); ?>:</b>
	<?php echo CHtml::encode($data->longname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('annotation')); ?>:</b>
	<?php echo CHtml::encode($data->annotation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('published_year')); ?>:</b>
	<?php echo CHtml::encode($data->published_year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book_url')); ?>:</b>
	<?php echo CHtml::encode($data->book_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cover_erl')); ?>:</b>
	<?php echo CHtml::encode($data->cover_erl); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('author_count')); ?>:</b>
	<?php echo CHtml::encode($data->author_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_count')); ?>:</b>
	<?php echo CHtml::encode($data->page_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php echo CHtml::encode($data->active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted')); ?>:</b>
	<?php echo CHtml::encode($data->deleted); ?>
	<br />

	*/ ?>

</div>