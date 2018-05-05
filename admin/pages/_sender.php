<div class="s-bk-lf">
	<div class="acc-title">Рассылка пользователям</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<center>
	<a href = "/admin/sender" class="stn">Список рассылок</a> || <a href = "/admin/sender/add" class="stn">Добавить рассылку</a>
</center>
<BR />
<?PHP
if(isset($_POST["title"])){
$title = strval($_POST["title"]);
$mess = $func->TextClean($_POST["mess"]);
	if(strlen($title) > 3){
		if(strlen($mess) > 10){
		$db->Query("INSERT INTO db_sender (name, mess, date_add) VALUES ('$title','$mess','".time()."')");
		echo "<center><b>Рассылка поставлена в очередь на выполнение</b></center><BR />";
		}else echo "<center><b>Сообщение должно быть больше 10 символов</b></center><BR />";
	}else echo "<center><b>Заголовок должен быть больше 3х символов</b></center><BR />";
}
# Добавление рассылки
if(isset($_GET["add"])){
?>
<form action="" method="post">
<table width="" border="0">
  <tr>
    <td>Заголовок сообщения:</td>
    <td align="right"><input type="text" name="title" size="35"/></td>
  </tr>
  <tr>
    <td align="center" colspan="2">
	<textarea name="mess" cols="78" rows="15"></textarea>
	</td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" value="Добавить"/></td>
  </tr>
</table>
</form>
<BR /><BR />
<b>Маркеры для замены:</b><BR />
<font color = "red">{!USER!}</font> - Имя пользователя<BR />
<font color = "red">{!PASS!}</font> - Текущий пароль<BR />
<font color = "red">{!REFERER!}</font> - Реферер<BR />
<font color = "red">{!REFERALS!}</font> - Кол-во рефералов<BR />
<font color = "red">{!MONEY_B!}</font> - Баланс для покупок<BR />
<font color = "red">{!MONEY_P!}</font> - Баланс на вывод<BR />
<BR /><BR />
</div>
<div class="clr"></div>	
<?PHP
return;
}
# Удаление
if(isset($_POST["del"])){
	$db->Query("DELETE FROM db_sender WHERE id = '".intval($_POST["del"])."'");	
	echo "<center><b>Рассылка удалена</b></center><BR />";
}
$db->Query("SELECT * FROM db_sender ORDER BY id DESC");
if($db->NumRows() > 0){
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb"><b>ID</b></td>
    <td align="center" class="m-tb"><b>Название</b></td>
    <td align="center" width="100" class="m-tb"><b>Отправлено</b></td>
	<td align="center" width="100" class="m-tb"><b>Статус</b></td>
	<td align="center" width="50" class="m-tb"><b>Удалить</b></td>
  </tr>
<?PHP
while($data = $db->FetchArray()){
?>
	<tr>
    <td align="center"><?=$data["id"]; ?></td>
    <td align="center"><?=$data["name"]; ?></td>
    <td align="center"><?=$data["sended"]; ?> шт.</td>
	<td align="center"><?=$data["status"] == 0 ? "Отправка" : "Завершено"; ?></td>
	<td align="center">
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
<BR />
<?PHP
}else echo "<center><b>Рассылок нет</b></center><BR />";
?>
</div>
<div class="clr"></div>	