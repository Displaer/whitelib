<?php
/* @var $this AuthorsController */
/* @var $model TblAuthors */

$this->breadcrumbs=array(
	'Tbl Authors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblAuthors', 'url'=>array('index')),
	array('label'=>'Create TblAuthors', 'url'=>array('create')),
	array('label'=>'Update TblAuthors', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblAuthors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblAuthors', 'url'=>array('admin')),
);
?>

<h1>View TblAuthors #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'author_key',
		'borndate',
		'fullname',
		'about',
		'active',
		'deleted',
	),
)); ?>
