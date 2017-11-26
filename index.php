<?PHP
# Счетчик
function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}
$_timer_a = TimerSet();
# Старт сессии
@session_start();
# Старт буфера
@ob_start();
# Default
$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = "Фруктовая ферма";
$_OPTIMIZATION["description"] = "Фруктовая ферма";
$_OPTIMIZATION["keywords"] = "Заработок на растениях, вложения, заработать, ферма, денежная ферма, заработать на ферме";
# Константа для Include
define('CONST_PSWeb', true);
# Автоподгрузка классов
function __autoload($name){ include("classes/_class.".$name.".php");}
# Класс конфига 
$config = new config;
# Функции
$func = new func;
# Установка REFERER
include("inc/_set_referer.php");
# База данных
$db = new db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
# Шапка
@include("inc/_header.php");
	if(isset($_GET["menu"])){
		$menu = strval($_GET["menu"]);
		switch($menu){
			case "404": include("pages/_404.php"); break; // Страница ошибки
			case "rules": include("pages/_rules.php"); break; // Правила проекта
			case "about": include("pages/_about.php"); break; // О проекте
			case "contacts": include("pages/_contacts.php"); break; // Контакты
			case "news": include("pages/_news.php"); break; // Новости
			case "signup": include("pages/_signup.php"); break; // Регистрация
			case "recovery": include("pages/_recovery.php"); break; // Восстановление пароля
			case "payments": include("pages/_payments.php"); break; // Выплаты
			case "users": include("pages/_users.php"); break; // Пользователи
			case "account": include("pages/_account.php"); break; // Аккаунт
			case "admin": include("pages/_admin.php"); break; // Админка
			case "success": include("pages/_success.php"); break; // Успешная оплата
			case "fail": include("pages/_fail.php"); break; // Неуспешная оплата
			# Страница ошибки
			default: @include("pages/_404.php"); break;
		}
	}else @include("pages/_index.php");
# Подвал
@include("inc/_footer.php");
# Заносим контент в переменную
$content = ob_get_contents();
# Очищаем буфер
ob_end_clean();
	# Заменяем данные
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	# Вывод баланса
	if(isset($_SESSION["user_id"])){
		$user_id = $_SESSION["user_id"];
		$db->Query("SELECT money_b, money_p FROM db_users_b WHERE id = '$user_id'");
		$balance = $db->FetchArray();
		$content = str_replace('{!BALANCE_B!}', sprintf("%.2f", $balance["money_b"]) ,$content);
		$content = str_replace('{!BALANCE_P!}', sprintf("%.2f", $balance["money_p"]) ,$content);
	}
// Выводим контент
echo $content;
?>