<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
    'Читалка',
);


?>
<div id="container">
    <div class="search-form"></div>
    <br>
    <div class="book-list"></div>
</div>
<?php $this->renderPartial('index-scripts'); ?>