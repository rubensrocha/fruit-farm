<?PHP
##################################################
# Автоматическое пополнение через Payeer		 #
# для скриптов Фруктовая Ферма с сохранением     #
# Автор: Администратор PSWeb.ru                  #
# Сайт: psweb.ru                                 #
# email: i@psweb.ru                              #
##################################################

//Проверка IP сервера оповещений Payeer
if (!in_array($_SERVER['REMOTE_ADDR'], array('185.71.65.92', '185.71.65.189', '149.202.17.210'))) die('ERROR IP');
if (isset($_POST['m_operation_id']) && isset($_POST['m_sign']))
{
# Автоподгрузка классов
	function __autoload($name){ include('classes/_class.'.$name.'.php');}
# Класс конфига 
	$config = new config;
	$m_key = $config->secretW;
# Формируем массив для генерации подписи
	$arHash = array(
	$_POST['m_operation_id'],
	$_POST['m_operation_ps'],
	$_POST['m_operation_date'],
	$_POST['m_operation_pay_date'],
	$_POST['m_shop'],
	$_POST['m_orderid'],
	$_POST['m_amount'],
	$_POST['m_curr'],
	$_POST['m_desc'],
	$_POST['m_status']
	);
# Если были переданы дополнительные параметры, то добавляем их вмассив
	if (isset($_POST['m_params']))
	{
	$arHash[] = $_POST['m_params'];
	}
# Добавляем в массив секретный ключ
	$arHash[] = $m_key;
# Формируем подпись
	$sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));
# Если подписи совпадают и статус платежа “Выполнен”
	if ($_POST['m_sign'] == $sign_hash && $_POST['m_status'] == 'success')
	{
	# База данных
		$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
	# Функции
		$func = new func;
	# Информация о платеже из базы
		$db->Query("SELECT * FROM db_payeer_insert WHERE id = ".$_POST['m_orderid']) or die($_POST['m_orderid'].'|error');
	# Если в базе нет такого платежа, выдаем "Ошибка"
		if($db->NumRows() == 0){ exit($_POST['m_orderid'].'|error');}
	# Массив информации о платеже	
		$payeer_row = $db->FetchArray();
	# Если статус платежа 1 ('Выполнено'), возвращаем 'Выполненно'
		if($payeer_row['status'] == 1){ exit($_POST['m_orderid'].'|success');}
	# Если сумма платежа в оповещении не равна сумме в базе
		if($payeer_row['sum'] != $_POST['m_amount']){ exit($_POST['m_orderid'].'|error');}
	# Сумма платежа		
		$amount = $payeer_row['sum'];
	# ID пользователя
		$user_id = $payeer_row['user_id']; 
	# Настройки из базы
		$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
		$config_site = $db->FetchArray();
	# Информация о пользователе и реферере
		$db->Query("SELECT user, referer_id FROM db_users_a WHERE id = '".$user_id."' LIMIT 1");
		$user_data = $db->FetchArray();
		$user_name = $user_data['user'];
		$refid = $user_data['referer_id'];
	# Зачисляем баланс
		$serebro = sprintf("%.4f", floatval($config_site['ser_per_wmr'] * $amount) );
		$db->Query("SELECT insert_sum FROM db_users_b WHERE id = '".$user_id."' LIMIT 1");
		$insert_sum = $db->FetchRow();
	# Бонус при первом пополнении
		$serebro = intval($insert_sum == 0) ? ($serebro + ($serebro * 0.55) ) : $serebro;
	# Дерево/фрукт при пополнении на определенную сумму
		$add_tree = ( $amount >= 500) ? 2 : 0;
	# Отчисления рефералу
		$to_referer = ($serebro * 0.10);
	# Зачисляем пользователю
		$db->Query("UPDATE db_users_b SET money_b = money_b + '$serebro', e_t = e_t + '$add_tree', to_referer = to_referer + '$to_referer', last_sbor = '".time()."', insert_sum = insert_sum + '$amount' WHERE id = '$user_id'") or die ($_POST['m_orderid'].'|error');
		$db->Query("UPDATE db_payeer_insert SET status = '1' WHERE id = '".$_POST['m_orderid']."'") or die(mysql_error());
	# Зачисляем средства рефереру и дерево
		$add_tree_referer = ($insert_sum <= 0.01) ? ", a_t = a_t + 1" : "";
		$db->Query("UPDATE db_users_b SET money_b = money_b + $to_referer, from_referals = from_referals + '$to_referer' $add_tree_referer WHERE id = '$refid'") or die(mysql_error());
	# Статистика пополнений
		$da = time();
		$dd = $da + 60*60*24*15;
		$db->Query("INSERT INTO db_insert_money (user, user_id, money, serebro, date_add, date_del) VALUES ('$user_name','$user_id','$amount','$serebro','$da','$dd')") or die(mysql_error());
	# Обновление статистики сайта
		$db->Query("UPDATE db_stats SET all_insert = all_insert + '$amount' WHERE id = '1'") or die(mysql_error());
		exit($_POST['m_orderid'].'|success');
	}
}
exit($_POST['m_orderid'].'|error');
?>