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
    <br>
    <div class="book-view" style="display: none;"></div>
    <br>
</div>
<?php $this->renderPartial('index-scripts'); ?>