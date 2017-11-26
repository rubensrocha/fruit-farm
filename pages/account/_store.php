<div class="s-bk-lf">
	<div class="acc-title">‘руктовый склад</div>
</div>
<div class="silver-bk">—обирайте на фруктовом складе ваши плоды посаженые на фруктовой ферме. ¬аша ферма дает урожай 
каждые 10 минут. ѕлоды посто¤нно накапливаетс¤, не об¤зательно собирать каждые 10 мин. достаточно
собрать их раз в мес¤ц.<br />  ак вам удобнее.
<BR />
<BR />
<?PHP
$_OPTIMIZATION["title"] = "јккаунт - —клад";
$_OPTIMIZATION["description"] = "‘руктовый склад";
$_OPTIMIZATION["keywords"] = "јккаунт, ‘руктовый склад, пользователь";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
	if(isset($_POST["sbor"])){
		if($user_data["last_sbor"] < (time() - 600) ){
			$tomat_s = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
			$straw_s = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
			$pump_s = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
			$peas_s = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
			$pean_s = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
			$db->Query("UPDATE db_users_b SET 
			a_b = a_b + '$tomat_s', 
			b_b = b_b + '$straw_s', 
			c_b = c_b + '$pump_s', 
			d_b = d_b + '$peas_s', 
			e_b = e_b + '$pean_s', 
			all_time_a = all_time_a + '$tomat_s',
			all_time_b = all_time_b + '$straw_s',
			all_time_c = all_time_c + '$pump_s',
			all_time_d = all_time_d + '$peas_s',
			all_time_e = all_time_e + '$pean_s',
			last_sbor = '".time()."' 
			WHERE id = '$usid' LIMIT 1");
			echo "<center><font color = 'green'><b>¬ы собрали урожай</b></font></center><BR />";
			$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
			$user_data = $db->FetchArray();
		}else echo "<center><font color = 'red'><b>”рожай можно собирать не чаще 1го раза за 10 минут</b></font></center><BR />";
	}
?>
<form action="" method="post">
	<div class="clr"></div>	
	<div class="sm-line">
		<img src="/img/fruit/lime-small.jpg" />¬аших <?=$user_data["a_t"]; ?> саженцев уродили: <font color="#000"> <?=$func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);?> плодов</font>
	</div>
	<div class="sm-line">
		<img src="/img/fruit/cherry-small.jpg" />¬аших <?=$user_data["b_t"]; ?> саженцев уродили: <font color="#000"> <?=$func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);?> плодов</font>
	</div>
	<div class="sm-line">
		<img src="/img/fruit/kiwi-small.jpg" />¬аших <?=$user_data["c_t"]; ?> саженцев уродили: <font color="#000"> <?=$func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);?> плодов</font>
	</div>
	<div class="sm-line">
		<img src="/img/fruit/strawberries-small.jpg" />¬аших <?=$user_data["d_t"]; ?> саженцев уродили: <font color="#000"> <?=$func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);?> плодов</font>
	</div>
	<div class="sm-line">
		<img src="/img/fruit/orange-small.jpg" />¬аших <?=$user_data["e_t"]; ?> саженцев уродили: <font color="#000"> <?=$func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);?> плодов</font>
	</div>
	<div class="clr"></div>
	<center><input type="submit" name="sbor" value="—обрать все" style="height:30px;"/></center>
</form>                
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" align="center" style="padding:5px;"><b>” вас имеетс¤ на складе:</b></td>
    </tr>
  <tr>
    <td align="center" width="20%"><div class="sm-line-nt"><img src="/img/fruit/lime-small.jpg" /></div></td>
    <td align="center" width="20%"><div class="sm-line-nt"><img src="/img/fruit/cherry-small.jpg" /></div></td>
	<td align="center" width="20%"><div class="sm-line-nt"><img src="/img/fruit/kiwi-small.jpg" /></div></td>
    <td align="center" width="20%"><div class="sm-line-nt"><img src="/img/fruit/strawberries-small.jpg" /></div></td>
    <td align="center" width="20%"><div class="sm-line-nt"><img src="/img/fruit/orange-small.jpg" /></div></td>
  </tr>
  <tr>
    <td align="center"><?=$user_data["a_b"]; ?></td>
    <td align="center"><?=$user_data["b_b"]; ?></td>
    <td align="center"><?=$user_data["c_b"]; ?></td>
    <td align="center"><?=$user_data["d_b"]; ?></td>
    <td align="center"><?=$user_data["e_b"]; ?></td>
  </tr>
</table>
<div class="clr"></div>
</div>