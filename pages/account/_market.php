<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Торговая лавка";
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Торговая лавка</div>
</div>
<div class="silver-bk">Торговая лавка позволит вам продать все ваши фрукты за серебро, которое можно обменять на реальные 
деньги. Вырученное с продажи серебро распределяется между двумя счетами (счет для покупок и счет 
для вывода) в пропорциях: <?=100-$sonfig_site["percent_sell"]; ?>% на счет для покупок и <?=$sonfig_site["percent_sell"]; ?>% на вывод.<br /><br />
Курс продажи любых плодов: <font color="#f59f97"><?=$sonfig_site["items_per_coin"]; ?> фруктов = 1 серебро.</font>
<div class="clr"></div><BR />
<?PHP
# Продажа
if(isset($_POST["sell"])){
	$all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"];
	if($all_items > 0){
		$money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);
		$tomat_b = $user_data["a_b"];
		$straw_b = $user_data["b_b"];
		$pump_b = $user_data["c_b"];
		$pean_b = $user_data["d_b"];
		$peas_b = $user_data["e_b"];
		$money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
		$money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
		# Обновляем юзверя
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0 
		WHERE id = '$usid'");
		$da = time();
		$dd = $da + 60*60*24*15;
		# Вставляем запись в статистику
		$db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, amount, all_sell, date_add, date_del) VALUES 
		('$usname','$usid','$tomat_b','$straw_b','$pump_b','$pean_b','$peas_b','$money_add','$all_items','$da','$dd')");
		echo "<center><font color = 'green'><b>Вы продали {$all_items} плодов, на сумму {$money_add} серебра</b></font></center><BR />";
		$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
		$user_data = $db->FetchArray();
	}else echo "<center><font color = 'red'><b>Вам нечего продавать :(</b></font></center><BR />";
}
?>	       
<form action="" method="post">
<table width="480" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" align="center" valign="middle">&nbsp;</td>
    <td height="30" align="center" valign="middle"><strong>У вас в наличии</strong></td>
    <td height="30" align="center" valign="middle"><strong>На сумму (серебра)</strong></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/fruit/lime-small.jpg" /></div></td>
    <td align="center" valign="middle"><?=$user_data["a_b"]; ?> плодов</td>
    <td align="center" valign="middle"><?=$func->SellItems($user_data["a_b"], $sonfig_site["items_per_coin"]); ?></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/fruit/cherry-small.jpg" /></div></td>
    <td align="center" valign="middle"><?=$user_data["b_b"]; ?> плодов</td>
    <td align="center" valign="middle"><?=$func->SellItems($user_data["b_b"], $sonfig_site["items_per_coin"]); ?></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/fruit/kiwi-small.jpg" /></div></td>
    <td align="center" valign="middle"><?=$user_data["c_b"]; ?> плодов</td>
    <td align="center" valign="middle"><?=$func->SellItems($user_data["c_b"], $sonfig_site["items_per_coin"]); ?></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/fruit/strawberries-small.jpg" /></td>
    <td align="center" valign="middle"><?=$user_data["d_b"]; ?> плодов</td>
    <td align="center" valign="middle"><?=$func->SellItems($user_data["d_b"], $sonfig_site["items_per_coin"]); ?></td>
  </tr>
  <tr>
    <td width="30" height="30" align="center" valign="middle"><div class="sm-line-nt"><img src="/img/fruit/orange-small.jpg" /></div></td>
    <td align="center" valign="middle"><?=$user_data["e_b"]; ?> плодов</td>
    <td align="center" valign="middle"><?=$func->SellItems($user_data["e_b"], $sonfig_site["items_per_coin"]); ?></td>
  </tr>
  <tr>
    <td align="center" valign="middle" colspan="3">
	<BR />
	<input type="submit" name="sell" value="Продать все" class="button_0" style="height: 30px;"></td>
  </tr>
  
</table>
</form>

</div>
								
<div class="clr"></div>	
