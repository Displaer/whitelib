<?php
/* @var $this BooksController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Books',
);

$this->menu=array(
	array('label'=>'Create Books', 'url'=>array('create')),
	array('label'=>'Manage Books', 'url'=>array('admin')),
);
?>

<h1>Список книг</h1>

<?php $this->widget('zii.widgets.grid.CGridView',
	array(
	    'id'=>'tbl-books-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
		'id',
		'name',
		'longname',
		'annotation',
		array(
			'header'=>'authors',
			'value'=>'$data->getAuthors()'
		),

		'published_year',
		'page_count',

		/*
		'book_url',

		'cover_erl',
		'author_count',
		'active',
		'deleted',
		*/
		)
	));
?>
