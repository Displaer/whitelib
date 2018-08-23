<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Authors';
$this->breadcrumbs=array(
    'Авторы',
);
?>
<div id="container">
    <div class="book-list"></div>
</div>
<?php $this->renderPartial('author-scripts'); ?>
