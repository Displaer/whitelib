<?php
/* @var $this BooksController */
/* @var $model TblBooks */

$this->breadcrumbs=array(
	'Tbl Books'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblBooks', 'url'=>array('index')),
	array('label'=>'Create TblBooks', 'url'=>array('create')),
	array('label'=>'View TblBooks', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblBooks', 'url'=>array('admin')),
);
?>

<h1>Update TblBooks <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>