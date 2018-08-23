<?php
/* @var $this BooksController */
/* @var $model TblBooks */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblBooks', 'url'=>array('index')),
	array('label'=>'Manage TblBooks', 'url'=>array('admin')),
);
?>

<h1>Create TblBooks</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>