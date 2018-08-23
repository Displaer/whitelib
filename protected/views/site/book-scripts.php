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
                    $($table).addClass('table table-bordered table-hover table-stripped');
                    console.log(head);
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
            loadBooks:function(){
                $.ajax({
                    type: "POST",
                    dataType: 'JSON',
                    url: this.baseUrl,
                    data: {
                        YII_CSRF_TOKEN:this.YiiCsrfToken,
                        product:"reader",
                        action:"list",
                    },
                    success: function (data) {
                        $(reader.buildTable(data.table)).appendTo("#container .book-list")
                        //$("#container .search-form").html(data);
                        //reader.rebindSearchForm();
                    },
                    error:function (xhr,e,error) {
                        alert(xhr.statusText);
                    }
                });
            },

            // Init
            init:function () {
                /**
                 load books
                 */
                // load books
                this.loadBooks();
            }
        };
        reader.init();
    });
</script>
