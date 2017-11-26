<div class="s-bk-lf">
	<div class="acc-title">Пользователи</div>
</div>
<div class="silver-bk"><div class="clr"></div>	
<?PHP
# Редактирование пользователя
if(isset($_GET["edit"])){
$eid = intval($_GET["edit"]);
$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
# Проверяем на существование
if($db->NumRows() != 1){ echo "<center><b>Указанный пользователь не найден</b></center><BR />"; }
# Добавляем дерево
if(isset($_POST["set_tree"])){
$tree = $_POST["set_tree"];
$type = ($_POST["type"] == 1) ? "-1" : "+1";
	$db->Query("UPDATE db_users_b SET {$tree} = {$tree} {$type} WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Дерево добавлено</b></center><BR />";
}
# Пополняем баланс
if(isset($_POST["balance_set"])){
$sum = intval($_POST["sum"]);
$bal = $_POST["schet"];
$type = ($_POST["balance_set"] == 1) ? "-" : "+";
$string = ($type == "-") ? "У пользователя снято {$sum} серебра" : "Пользователю добавлено {$sum} серебра";
	$db->Query("UPDATE db_users_b SET {$bal} = {$bal} {$type} {$sum} WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>$string</b></center><BR />";	
}
# Забанить пользователя
if(isset($_POST["banned"])){
	$db->Query("UPDATE db_users_a SET banned = '".intval($_POST["banned"])."' WHERE id = '$eid'");
	$db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
	echo "<center><b>Пользователь ".($_POST["banned"] > 0 ? "забанен" : "разбанен")."</b></center><BR />";
	
}
$data = $db->FetchArray();
?>
<table width="100%" border="0">
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">ID:</td>
    <td width="200" align="center"><?=$data["id"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Логин:</td>
    <td width="200" align="center"><?=$data["user"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Email:</td>
    <td width="200" align="center"><?=$data["email"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Пароль:</td>
    <td width="200" align="center"><?=$data["pass"]; ?></td>
  </tr>
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Серебро (Покупки):</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["money_b"]); ?></td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;">Серебро (Вывод):</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["money_p"]); ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Овощей на балансе (Лайм):</td>
    <td width="200" align="center"><?=$data["a_b"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Овощей на балансе (Вишня):</td>
    <td width="200" align="center"><?=$data["b_b"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Овощей на балансе (Клубника):</td>
    <td width="200" align="center"><?=$data["c_b"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Овощей на балансе (Киви):</td>
    <td width="200" align="center"><?=$data["d_b"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Овощей на балансе (Апельсин):</td>
    <td width="200" align="center"><?=$data["e_b"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Деревьев (Лайм):</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="a_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["a_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="a_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Деревьев (Вишня):</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="b_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["b_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="b_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr>
    <td style="padding-left:10px;">Деревьев (Клубника):</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="c_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["c_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="c_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Деревьев (Киви):</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="d_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["d_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="d_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>

  <tr>
    <td style="padding-left:10px;">Деревьев (Апельсин):</td>
    <td width="200" align="center">
	
		<table width="100%" border="0">
		  <tr>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="e_t" />
				<input type="hidden" name="type" value="1" />
				<input type="submit" value="-1" />
			</form>
			</td>
			<td align="center"><?=$data["e_t"]; ?> шт.</td>
			<td>
			<form action="" method="post">
				<input type="hidden" name="set_tree" value="e_t" />
				<input type="hidden" name="type" value="2" />
				<input type="submit" value="+1" />
			</form>
			</td>
		  </tr>
		</table>

	</td>
  </tr>
  
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Собрано за все время (Томат):</td>
    <td width="200" align="center"><?=$data["all_time_a"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Собрано за все время (Клубника):</td>
    <td width="200" align="center"><?=$data["all_time_b"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Собрано за все время (Тыква):</td>
    <td width="200" align="center"><?=$data["all_time_c"]; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Собрано за все время (Горох):</td>
    <td width="200" align="center"><?=$data["all_time_d"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Собрано за все время (Арахис):</td>
    <td width="200" align="center"><?=$data["all_time_e"]; ?></td>
  </tr>
  
  
  <tr>
    <td style="padding-left:10px;">Referer:</td>
    <td width="200" align="center">[<?=$data["referer_id"]; ?>]<?=$data["referer"]; ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Рефералов:</td>
	
	<?PHP
	$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$data["id"]."'");
	$counter_res = $db->FetchRow();
	?>
	
    <td width="200" align="center"><?=$data["referals"]; ?> [<?=$counter_res; ?>] чел.</td>
  </tr>
  
  <tr>
    <td style="padding-left:10px;">Заработал на рефералах:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["from_referals"]); ?> сер.</td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Принес рефереру:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["to_referer"]); ?> сер.</td>
  </tr>
  
  
  
  <tr>
    <td style="padding-left:10px;">Зарегистрирован:</td>
    <td width="200" align="center"><?=date("d.m.Y в H:i:s",$data["date_reg"]); ?></td>
  </tr>
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Последний вход:</td>
    <td width="200" align="center"><?=date("d.m.Y в H:i:s",$data["date_login"]); ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Последний IP:</td>
    <td width="200" align="center"><?=$data["uip"]; ?></td>
  </tr>
  
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Пополнено на баланс:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["insert_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  <tr>
    <td style="padding-left:10px;">Выплачено на кошелек:</td>
    <td width="200" align="center"><?=sprintf("%.2f",$data["payment_sum"]); ?> <?=$config->VAL; ?></td>
  </tr>
  
  <tr bgcolor="#efefef">
    <td style="padding-left:10px;">Забанен (<?=($data["banned"] > 0) ? '<font color = "red"><b>ДА</b></font>' : '<font color = "green"><b>НЕТ</b></font>'; ?>):</td>
    <td width="200" align="center">
	<form action="" method="post">
	<input type="hidden" name="banned" value="<?=($data["banned"] > 0) ? 0 : 1 ;?>" />
	<input type="submit" value="<?=($data["banned"] > 0) ? 'Разбанить' : 'Забанить'; ?>" />
	</form>
	</td>
  </tr>
  
  
</table>
<BR />
<BR />
<form action="" method="post">
<table width="100%" border="0">
  <tr bgcolor="#EFEFEF">
    <td align="center" colspan="4"><b>Операции с балансом:</b></td>
  </tr>
  <tr>
    <td align="center">
		<select name="balance_set">
			<option value="2">Добавить на баланс</option>
			<option value="1">Снять с баланса</option>
		</select>
	</td>
	<td align="center">
		<select name="schet">
			<option value="money_b">Для покупок</option>
			<option value="money_p">Для вывода</option>
		</select>
	</td>
    <td align="center"><input type="text" name="sum" value="100" size="7"/></td>
    <td align="center"><input type="submit" value="Выполнить" /></td>
  </tr>
</table>
</form>
</div>
<div class="clr"></div>	
<?PHP

return;
}

?>
<form action="/?menu=admin4ik&sel=users&search" method="post">
<table width="250" border="0" align="center">
  <tr>
    <td><b>Логин:</b></td>
    <td><input type="text" name="sear" /></td>
	<td><input type="submit" value="Поиск" /></td>
  </tr>
</table>
</form>
<BR />
<?PHP

function sort_b($int_s){
	$int_s = intval($int_s);
	switch($int_s){
		case 1: return "db_users_a.user";
		case 2: return "all_serebro";
		case 3: return "all_trees";
		case 4: return "db_users_a.date_reg";
		default: return "db_users_a.id";
	}
}
$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
$str_sort = sort_b($sort_b);
$num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
$lim = $num_p * 100;
if(isset($_GET["search"])){
$search = $_POST["sear"];
$db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t + db_users_b.d_t + db_users_b.e_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro 
FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.user = '$search' ORDER BY {$str_sort} DESC LIMIT {$lim}, 100");
}else $db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t + db_users_b.d_t + db_users_b.e_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id ORDER BY {$str_sort} DESC LIMIT {$lim}, 100");
if($db->NumRows() > 0){
?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr bgcolor="#efefef">
    <td align="center" width="50" class="m-tb"><a href="/admin/users/sort/0" class="stn-sort">ID</a></td>
    <td align="center" class="m-tb"><a href="/admin/users/sort/1" class="stn-sort">Пользователь</a></td>
    <td align="center" width="90" class="m-tb"><a href="/admin/users/sort/2" class="stn-sort">Серебра</a></td>
	<td align="center" width="75" class="m-tb"><a href="/admin/users/sort/3" class="stn-sort">Деревьев</a></td>
	<td align="center" width="100" class="m-tb"><a href="/admin/users/sort/4" class="stn-sort">Зарегистрирован</a></td>
  </tr>
<?PHP

	while($data = $db->FetchArray()){
	
	?>
	<tr class="htt">
    <td align="center"><?=$data["id"]; ?></td>
    <td align="center"><a href="/admin/users/edit/<?=$data["id"]; ?>" class="stn"><?=$data["user"]; ?></a></td>
    <td align="center"><?=sprintf("%.2f",$data["all_serebro"]); ?></td>
	<td align="center"><?=$data["all_trees"]; ?></td>
	<td align="center"><?=date("d.m.Y",$data["date_reg"]); ?></td>
  	</tr>
	<?PHP
	
	}

?>

</table>
<BR />
<?PHP


}else echo "<center><b>На данной странице нет записей</b></center><BR />";
	if(isset($_GET["search"])){	
	?>
	</div>
	<div class="clr"></div>	
	<?PHP
		return;
	}
$db->Query("SELECT COUNT(*) FROM db_users_a");
$all_pages = $db->FetchRow();
	if($all_pages > 100){
	$sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
	$nav = new navigator;
	$page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
	echo "<BR /><center>".$nav->Navigation(10, $page, ceil($all_pages / 100), "/admin/users/sort/{$sort_b}&page="), "</center>";
	}
?>
</div>
<div class="clr"></div>	