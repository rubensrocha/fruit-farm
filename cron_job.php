<?PHP
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */
@error_reporting(E_ALL ^ E_NOTICE);
@ini_set('display_errors', true);
@ini_set('html_errors', false);
@ini_set('error_reporting', E_ALL ^ E_NOTICE);
# Подматываем классы
function __autoload($name){ include("classes/_class.".$name.".php");}
# Класс конфига 
$config = new Config;
$type = "sender";//strval($_GET["type"]);
# Функции
$func = new Func;
# База данных
$db = new Db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
switch($type){
	case "sender": include("cron_job/_sender.php"); break; // Отправка пользователям
	default: die("Type not exist"); break;
}
?>