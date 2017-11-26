<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Лотерея";
$usid = $_SESSION["user_id"];
$uname = $_SESSION["user"];
# Настройки лотерея
$amount_lottery = 100; // Стоимость лотерейного билета
$num_bil = 10; // Количество билетов
?>
<div class="s-bk-lf">
	<div class="acc-title">Лотерея</div>
</div>
<div class="silver-bk">
<?PHP
# список предыдущих лотерей
if(isset($_GET["winners"])){ ?>
<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
  <tr>
    <td colspan="6" align="center"><h4>Завершенные лотереи</h4></td>
    </tr>
  <tr>
    <td align="center" class="m-tb">№</td>
    <td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	<td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	<td align="center" class="m-tb">Пользователь<BR />[Билет]</td>
	<td align="center" class="m-tb">Банк</td>
	<td align="center" class="m-tb">Дата</td>
  </tr>
  <?PHP
  $db->Query("SELECT * FROM db_lottery_winners ORDER BY id DESC");
	if($db->NumRows() > 0){
  		while($ref = $db->FetchArray()){
		?>
		<tr class="htt">
    		<td align="center"><?=$ref["id"]; ?></td>
			<td align="center"><?=$ref["user_a"]; ?><BR />Билет: <?=$ref["bil_a"]; ?></td>
			<td align="center"><?=$ref["user_b"]; ?><BR />Билет: <?=$ref["bil_b"]; ?></td>
			<td align="center"><?=$ref["user_c"]; ?><BR />Билет: <?=$ref["bil_c"]; ?></td>
			<td align="center"><?=$ref["bank"]; ?></td>
			<td align="center"><?=date("d.m.Y",$ref["date_add"]); ?></td>
  		</tr>
		<?PHP
		}
	}else echo '<tr><td align="center" colspan="6">Нет записей</td></tr>'
  ?>
</table>
<div class="clr"></div></div>
<?PHP return; } ?>
<b>Лотерея</b> - это такая игры :) Всего имеется <?=$num_bil; ?> билетов. После того, как все билеты будут проданы состоится розыгрыш счастливых билетов. Система случайным образом выберет 3 номера счастливых билетов и зачислит им призы. <BR />
1 место - 50% от общего банка [<?=($amount_lottery * $num_bil) * 0.5; ?> серебра]. <BR />
2 место - 25% от общего банка [<?=($amount_lottery * $num_bil) * 0.25; ?> серебра]. <BR />
3 место - 20% от общего банка [<?=($amount_lottery * $num_bil) * 0.2; ?> серебра]. <BR />
Остальные 5% составляют комиссию системы.
<BR />
<u>Стоимость билета = <?=$amount_lottery; ?> серебра</u>.
<BR />
<a href="/account/lottery/winners">Список завершенных лотерей</a>
<BR /><BR />
<?PHP
	if(isset($_POST["set_lottery"], $_POST["hash"]) AND $_SESSION["lot_hash"] == $_POST["hash"]){
		$db->Query("SELECT money_b FROM db_users_b WHERE id = '{$usid}' LIMIT 1");
		if($db->FetchRow() >= $amount_lottery){
			$db->Query("UPDATE db_users_b SET money_b = money_b - '$amount_lottery' WHERE id = '{$usid}'");
			$db->Query("INSERT INTO db_lottery (user_id, user, date_add) VALUE ('$usid','$uname','".time()."')");
			$lid = $db->LastInsert();
			if( $lid >= $num_bil){
				# Розыгрываем призы
				while(true){
					$winner_a = rand(1, $num_bil);
					$winner_b = rand(1, $num_bil);
					$winner_c = rand(1, $num_bil);
					if($winner_a != $winner_b AND $winner_b != $winner_c AND $winner_c != $winner_a) break;
				}
				# Пользователь 1
				$db->Query("SELECT user FROM db_lottery WHERE id = '$winner_a'");
				$user_a = $db->FetchRow();
				# Пользователь 2
				$db->Query("SELECT user FROM db_lottery WHERE id = '$winner_b'");
				$user_b = $db->FetchRow();
				# Пользователь 3
				$db->Query("SELECT user FROM db_lottery WHERE id = '$winner_c'");
				$user_c = $db->FetchRow();
				# чистим таблицу
				$db->Query("TRUNCATE TABLE db_lottery");
				# Вставляем запись о победителях
				$all_bank = ($num_bil * $amount_lottery);
				$db->Query("INSERT INTO db_lottery_winners (user_a, bil_a, user_b, bil_b, user_c, bil_c, bank, date_add) 
				VALUES ('$user_a','$winner_a','$user_b','$winner_b','$user_c','$winner_c','$all_bank','".time()."')");
				# Обновляем средства пользователям
				# 1 место
				$money_a = $all_bank * 0.5;
				$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_a' WHERE user = '$user_a'");
				# 2 место
				$money_b = $all_bank * 0.25;
				$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b' WHERE user = '$user_b'");
				# 3 место
				$money_c = $all_bank * 0.20;
				$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_c' WHERE user = '$user_c'");
				echo "<center><b><font color='green'>Лотерея окончена</font></b></center><BR />";
			}else echo "<center><b><font color='green'>Билет успешно куплен</font></b></center><BR />";
		}else echo "<center><b><font color='red'>Недостаточно средств для покупки билета</font></b></center><BR />";
	}
?>
<center>
<?PHP
$_SESSION["lot_hash"] = rand(1, 9999999);
?>
<form action="" method="post">
<input type="submit" name="set_lottery" value="Купить билет" style="padding:7px;" />
<input type="hidden" name="hash" value="<?=$_SESSION["lot_hash"]; ?>" />
</form>
</center>
	<table cellpadding='3' cellspacing='0' border='0' bordercolor='#336633' align='center' width="99%">
	  <tr>
		<td colspan="5" align="center"><h4>Пользователи купившие билеты</h4></td>
		</tr>
	  <tr>
		<td align="center" class="m-tb">№ билета</td>
		<td align="center" class="m-tb">Пользователь</td>
		<td align="center" class="m-tb">Дата</td>
	  </tr>
	  <?PHP
	$db->Query("SELECT * FROM db_lottery ORDER BY id DESC");
	if($db->NumRows() > 0){
		while($ref = $db->FetchArray()){
		?>
			<tr class="htt">
				<td align="center"><?=$ref["id"]; ?></td>
				<td align="center"><?=$ref["user"]; ?></td>
				<td align="center"><?=date("d.m.Y",$ref["date_add"]); ?></td>
			</tr>
			<?PHP
			}
		}else echo '<tr><td align="center" colspan="3">Нет записей</td></tr>'
	  ?>
	</table>
	<div class="clr"></div>	
</div>