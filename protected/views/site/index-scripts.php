<?php
/* @var $this SiteController */
$partner = new stdClass();
?>
<script>
    $(function () {
        var reader = {
            baseUrl:'<?=$this->createUrl('books/rest');?>',
            YiiCsrfToken:'<?=Yii::app()->request->csrfToken; ?>',
            // Search Form, Processing result of finding Insurants
            buildTable:function (incData) {
                if (incData.hasOwnProperty('head') && incData.hasOwnProperty('data')) {
                    var head = incData.head;
                    var data = incData.data;

                    var $table = $('<table/>');
                    $($table).addClass('table table-bordered table-hover table-striped');
                    //console.log(head);
                    if(head){
                        var $tr = $('<tr />');
                        $.each(head, function (key, value) {
                            $('<th />', {'class':key,html:value}).appendTo($tr);
                        });
                        $($tr).appendTo($table);
                    }
                    if(Array.isArray(data)){
                        $.each(data, function (index,element) {
                            var $tr = $('<tr />');
                            $.each(element, function (key, value) {
                                if(key!='id')
                                $('<td />', {'class':key,html:value}).appendTo($tr);
                            });
                            //$('<td>' + element.lastname + '</td><td>' + element.firstname+ '</td><td>' + element.secondname + '</td><td>' + element.borndate + '</td>').appendTo($tr);
                            $($tr).addClass('pointer');
                            $($tr).attr('id',element.id);
                            $($tr).appendTo($table);
                        });
                    }
                    return $table;
                } else {
                    return 'Invalid data';
                }
            },
            loadSearchForm:function () {
                $.ajax({
                    type: "POST",
                    /*dataType: dataType,*/
                    url: this.baseUrl,
                    data: {
                        YII_CSRF_TOKEN:this.YiiCsrfToken,
                        product:"reader",
                        action:"form",
                    },
                    success: function (data) {
                        $("#container .search-form").html(data);
                        reader.rebindSearchForm();
                    }
                });
            },
            rebindSearchForm:function () {

                // deactivate all rows
                /*$("#container .search-form .word," +
                    "#container .search-form .year," +
                    "#container .search-form .count").prop('disabled', true);*/


                // activate row
                $("#container .search-form .activate")
                    .unbind("change")
                    .bind("change", function () {

                        var key = $(this).attr("activate");
                        if($(this).is(":checked")){
                            $("#container .search-form ." + key).prop("disabled", false);
                            /*$("#container .search-form ." + key).each(function (i,e) {
                               $(e).removeProp('disabled');
                            });*/
                        } else {
                            $("#container .search-form ."   + key).prop("disabled", true);
                        }
                    });

                // search button
                $("#container .search-form .btn-search")
                    .unbind("click")
                    .bind("click", function () {
                        var filter = {};
                        /*if($("#container .search-form .activeWordSearch").is(":checked")){*/
                            filter['word'] = {
                                'active':true,
                                'query':String($("#container .search-form .queryWord").val()),
                                'inBookName':$("#container .search-form .inBookName").is(":checked"),
                                'inAuthorName':$("#container .search-form .inAuthorName").is(":checked")
                            };
                        /*}*/

                        /*if($("#container .search-form .activeYearSearch").is(":checked")){*/
                            filter['year'] = {
                                'active':true,
                                'query':String($("#container .search-form .queryYear").val()),
                                'none':$("#container .search-form .nonYear").is(":checked")
                            };
                        /*}*/

                        /*if($("#container .search-form .activeAuthorCountSearch").is(":checked")){*/
                            filter['count'] = {
                                'active':true,
                                'query':String($("#container .search-form .queryCount").val()),
                                'none':$("#container .search-form .nonCount").is(":checked")
                            };
                        /*}*/

                        reader.filterBook = filter;
                        //console.log(reader.filterBook);
                        reader.loadBooks();

                    });

                // search button
                $("#container .search-form .btn-reset")
                    .unbind("click")
                    .bind("click", function () {
                        reader.loadSearchForm();
                        reader.filterBook = {};
                        reader.loadBooks()
                    });

            },

            loadBooks:function(){
                $("#container .book-list").html('<center><img src="<?=Yii::app()->request->baseUrl . '/images/loading.webp';?>"></center>');
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: this.baseUrl,
                    data: {
                        YII_CSRF_TOKEN:this.YiiCsrfToken,
                        product:"reader",
                        action:"list",
                        filter:reader.filterBook
                    },
                    success: function (data) {
                        if (data.error) {
                            alert(data.message);
                        } else {
                            $("#container .book-list").empty();
                            $(reader.buildTable(data.table)).appendTo("#container .book-list");
                            reader.rebindBookList();
                        }
                    },
                    error:function (xhr,e,error) {
                        alert(xhr.statusText);
                    }

                });
            },

            rebindBookList:function () {
                $("#container .book-list tr.pointer")
                    .unbind("click")
                    .bind("click", function () {
                      var id = $(this).attr('id');
                        reader.loadOneBook(id);
                    });
            },
            loadOneBook:function (id) {
                $.ajax({
                    type: "POST",
                    /*dataType: 'JSON',*/
                    url: this.baseUrl,
                    data: {
                        YII_CSRF_TOKEN:this.YiiCsrfToken,
                        product:"reader",
                        action:"one",
                        id:id
                    },
                    success: function (data) {
                        if (data) {
                            $("#container .book-view")
                                .empty()
                                .html(data)
                                .show();
                            $("#container .book-list").hide()
                            reader.rebindBookView();
                        } else {
                            alert('Error');
                        }
                    },
                    error:function (xhr,e,error) {
                        alert(xhr.statusText);
                    }

                });

            },

            rebindBookView:function () {

                $("#container .book-view .btn-close")
                    .unbind("click")
                    .bind("click",function () {
                        $("#container .book-view").hide();
                        $("#container .book-list").show()
                    });

            },

            // Init
            init:function () {
                /**
                 load search form
                 load books
                 */

                // search form
                this.rebindSearchForm();

                // load books
                this.loadBooks();

            }
        };
        reader.init();
    });
</script>
