<?php
/* @var $this BooksController */
/* @var $model TblBooks */

$this->breadcrumbs=array(
	'Tbl Books'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List TblBooks', 'url'=>array('index')),
	array('label'=>'Create TblBooks', 'url'=>array('create')),
	array('label'=>'Update TblBooks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblBooks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblBooks', 'url'=>array('admin')),
);
?>

<h1>View TblBooks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'longname',
		'annotation',
		'published_year',
		'book_url',
		'cover_erl',
		'author_count',
		'page_count',
		'active',
		'deleted',
	),
)); ?>
