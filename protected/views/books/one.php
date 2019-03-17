<table class="table table-hover">
	<tr><td colspan="2" align="right"><button class="btn btn-danger btn-close right">x</button></td></tr>
	<tr>
		<th colspan="2"><h2><?=$model->name;?></h2></th>
	</tr>
	<tr>
		<td rowspan="2"><img src="<?=($model->cover_erl) ? $model->cover_erl:Yii::app()->request->baseUrl . '/images/nocover.jpeg';?>" width="180"></td>

		<td><?=$model->longname;?></td>
	</tr>
	<tr>
		<td>Автор(ы):<br><?=$model->getAuthors();?></td>
	</tr>
	<tr>
		<td colspan="2"><p>Аннотация</p><p><?=$model->annotation?></p></td>
	</tr>
	<tr>
		<td>Год:<?=$model->published_year?></td>
		<td>Страниц:<?=$model->page_count?></td>
	</tr>
</table>