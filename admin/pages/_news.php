<div class="s-bk-lf">
	<div class="acc-title">Новости проекта</div>
</div>
<div class="silver-bk"><div class="clr"></div>	

<center><a href = "/admin/news" class="stn">Список новостей</a> || <a href = "/admin/news/add" class="stn">Добавить новость</a></center>
<BR />
<script type="text/javascript" src="../../js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<?PHP
if(isset($_POST["del"])){
$ret_id = intval($_POST["del"]);
$db->Query("DELETE FROM db_news WHERE id = '$ret_id'");
	echo "<center><b>Новость удалена</b></center><BR />";
}
# добавление новости
if(isset($_GET["add"])){
	if(isset($_POST["title"], $_SESSION["add_news"]) AND $_SESSION["add_news"] == $_POST["add_news"]){
	unset($_SESSION["add_news"]);
	$title = $func->TextClean($_POST["title"]);
	$text = $_POST["ntext"];
		if(strlen($title) >= 3){
			$db->Query("INSERT INTO db_news (title, news, date_add) VALUES ('$title','$text','".time()."')");
			echo "<center><b><font color = 'green'>Новость добавлена</font></b></center><BR />";	
		}else echo "<center><b><font color = 'red'>Заголовк не может быть менее 3х символов</font></b></center><BR />";
	}
?>

<form action="" method="post">
<b>Заголовок:</b><BR />
<input type="text" name="title" size="45" value="<?=(isset($_POST["title"])) ? $_POST["title"] : false; ?>" /><BR /><BR />
<b>Новость:</b><BR />
<textarea name="ntext" cols="78" rows="25"><?=(isset($_POST["ntext"])) ? $_POST["ntext"] : false; ?></textarea><BR />
<center><input type="submit" value="Сохранить" /></center>
<?PHP
$_SESSION["add_news"] = rand(1,1000);
?>
<input type="hidden" name="add_news" value="<?=$_SESSION["add_news"]; ?>" />
</form>
</div>
<div class="clr"></div>	
<?PHP
return;
}
# редактирование
if(isset($_GET["edit"])){
$idr = intval($_GET["edit"]);
$db->Query("SELECT * FROM db_news WHERE id = '$idr' LIMIT 1");
if($db->NumRows() != 1){ echo "<center><b>Новость с таким ID не найдена</b></center><BR />"; return;}
	if(isset($_POST["title"])){
	$title = $func->TextClean($_POST["title"]);
	$title = (strlen($title) > 0) ? $title : "Без заголовка";
	$text = $_POST["ntext"];
	$db->Query("UPDATE db_news SET title = '$title', news = '$text' WHERE id = '$idr'");
	$db->Query("SELECT * FROM db_news WHERE id = '$idr' LIMIT 1");
	 echo "<center><b>Новость отредактирована</b></center><BR />";
	}
$news = $db->FetchArray();
?>
<form action="" method="post">
<b>Заголовок:</b><BR />
<input type="text" name="title" size="45" value="<?=$news["title"]; ?>" /><BR /><BR />
<b>Новость:</b><BR />
<textarea name="ntext" cols="78" rows="25"><?=$news["news"]; ?></textarea><BR />
<center><input type="submit" value="Сохранить" /></center>
</form>
</div>
<div class="clr"></div>	
<?PHP
return;
}
$db->Query("SELECT * FROM db_news ORDER BY id DESC");
if($db->NumRows() > 0){
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb">ID</td>
    <td align="center" class="m-tb">Название</td>
	<td align="center" width="70" class="m-tb">Удалить</td>
  </tr>
<?PHP
	while($data = $db->FetchArray()){
	?>
	<tr class="htt">
    <td align="center" width="50"><?=$data["id"]; ?></td>
    <td align="center"><a href="/admin/news/edit/<?=$data["id"]; ?>" class="stn"><?=$data["title"]; ?></a></td>
	<td align="center" width="70">
	<form action="" method="post">
	<input type="hidden" name="del" value="<?=$data["id"]; ?>" />
	<input type="submit" value="Удалить" />
	</form>
	</td>
  	</tr>
	<?PHP
	}
?>

</table>
<?PHP
}else echo "<center><b>Новостей нет</b></center><BR />";
?>
</div>
<div class="clr"></div>	