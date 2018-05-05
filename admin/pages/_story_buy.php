<div class="s-bk-lf">
	<div class="acc-title">История покупок деревьев</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
$tdadd = time() - 5*60;
	if(isset($_POST["clean"])){
		$db->Query("DELETE FROM db_stats_btree WHERE date_add < '$tdadd'");
		echo "<center><font color = 'green'><b>Очищено</b></font></center><BR />";
	}
$db->Query("SELECT * FROM db_stats_btree ORDER BY id DESC");
if($db->NumRows() > 0){
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb">ID</td>
    <td align="center" class="m-tb">Пользователь</td>
    <td align="center" width="75" class="m-tb">Дерево</td>
	<td align="center" width="75" class="m-tb">Цена</td>
	<td align="center" width="150" class="m-tb">Дата</td>
  </tr>
<?PHP
	while($data = $db->FetchArray()){
	?>
	<tr class="htt">
    <td align="center" width="50"><?=$data["id"]; ?></td>
    <td align="center"><?=$data["user"]; ?></td>
    <td align="center" width="75"><?=$data["tree_name"]; ?></td>
	<td align="center" width="75"><?=$data["amount"]; ?></td>
	<td align="center" width="150"><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
  	</tr>
	<?PHP
	}
?>
</table>
<BR />
<form action="" method="post">
<center><input type="submit" name="clean" value="Очистить" /></center>
</form>
<?PHP
}else echo "<center><b>Записей нет</b></center><BR />";
?>
</div>
<div class="clr"></div>	