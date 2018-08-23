<?php
/* @var $this AuthorsController */
/* @var $model TblAuthors */

$this->breadcrumbs=array(
	'Tbl Authors'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblAuthors', 'url'=>array('index')),
	array('label'=>'Create TblAuthors', 'url'=>array('create')),
	array('label'=>'View TblAuthors', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblAuthors', 'url'=>array('admin')),
);
?>

<h1>Update TblAuthors <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>