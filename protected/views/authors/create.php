<?php
/* @var $this AuthorsController */
/* @var $model TblAuthors */

$this->breadcrumbs=array(
	'Tbl Authors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblAuthors', 'url'=>array('index')),
	array('label'=>'Manage TblAuthors', 'url'=>array('admin')),
);
?>

<h1>Create TblAuthors</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>