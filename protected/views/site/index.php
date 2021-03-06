<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
$this->breadcrumbs=array(
    'Читалка',
);


?>
<div id="container">
    <div class="search-form">
        <table class="table table-borderless table-hover">
            <tbody>
            <tr>
                <td><!--<input activate="word" class="activeWordSearch activate" type="checkbox"/ >--></td>
                <td><input class="form-control queryWord word" type="text" placeholder="Слово"/ ></td>
                <td><label style="white-space: nowrap;"><input class="inBookName word" type="checkbox" checked/> В
                        назвнии книгах </label><label style="white-space: nowrap;"><input class="inAuthorName word"
                                                                                          type="checkbox" checked/> В
                        ФИО авторах </label></td>
            </tr>
            <tr>
                <td><!--<input activate="year" class="activeYearSearch activate" type="checkbox"/ >--></td>
                <td><input class="form-control queryYear year" type="number" placeholder="Год издания/написания"/ ></td>
                <td><label style="white-space: nowrap;"><input class="nonYear year" type="checkbox"/> Не указанно
                    </label></td>
            </tr>
            <tr>
                <td><!--<input activate="count" class="activeAuthorCountSearch activate" type="checkbox"/ >--></td>
                <td><input class="form-control queryCount count" type="number" placeholder="Количество Авторов"/ ></td>
                <td><label style="white-space: nowrap;"><input class="nonCount count" type="checkbox"/> Не указанно
                    </label></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class=" btn-group">
                        <button class="btn btn-primary btn-search">Поиск</button>
                        <button class="btn btn-danger btn-reset">Сброс</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div class="book-list"></div>
    <br>
    <div class="book-view" style="display: none;"></div>
    <br>
</div>
<?php $this->renderPartial('index-scripts'); ?>