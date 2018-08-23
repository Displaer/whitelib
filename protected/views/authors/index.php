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

<h1>Tbl Authors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
