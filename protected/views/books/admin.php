<?php
/* @var $this BooksController */
/* @var $model TblBooks */

$this->breadcrumbs=array(
	'Tbl Books'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TblBooks', 'url'=>array('index')),
	array('label'=>'Create TblBooks', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbl-books-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tbl Books</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
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

		/*
		'published_year',
		'book_url',

		'cover_erl',
		'author_count',
		'page_count',
		'active',
		'deleted',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
