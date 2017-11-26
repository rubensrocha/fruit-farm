<?PHP
$tfstats = time() - 60*60*24;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment, 
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();
?>	
<div class="stat">
	<div class="h-title">Статистика</div>
	<div class="st-lf">
	<div class="line">Всего участников: </div>
	<div class="line">Новых за 24 часа: </div>
	<div class="line">Выплачено всего: </div>
	<div class="line">Резерв проекта: </div>
	</div>
	<div class="st-rg">
	<div class="line-st"><a href="/users" style="text-decoration:none; color: blue;"><?=$stats_data["all_users"]; ?></a> чел.</div>
	<div class="line-st"><?=$stats_data["new_users"]; ?> чел.</div>
	<div class="line-st"><a href="/payments" style="text-decoration:none; color: blue;"><?=sprintf("%.2f",$stats_data["all_payment"]); ?></a> <?=$config->VAL; ?></div>
	<div class="line-st"><?=sprintf("%.2f",$stats_data["all_insert"]); ?> <?=$config->VAL; ?></div>
	</div>
	<div class="clr"></div>
	<div class="st-time"><img style="vertical-align:-5px; margin-right:5px;" src="/img/clock.png" />Проекту пошел: <font color="#f77827"><?=intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) +1); ?> - й</font> день</div>
</div>
<div class="stat">
	<div class="h-title">Платежные системы:</div>
	<div class="cntrl-ps">
		<div class="clr"></div>
	</div>
<div class="clr"></div>
</div>

