<?php
/* @var $this AuthorsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Authors',
);

$this->menu=array(
	array('label'=>'Create TblAuthors', 'url'=>array('create')),
	array('label'=>'Manage TblAuthors', 'url'=>array('admin')),
);
?>

<h1>Список авторов</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tbl-authors-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'author_key',
		'borndate',
		'fullname',
		'about',
		'active',
	),
));
?>