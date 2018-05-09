<?PHP
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */
# Start Session
@session_start();
# Buffer Start
@ob_start();
# Load Composer classes and Packages
include ("../vendor/autoload.php");

# Load Config Class
$config = new Config;
# Constant for Include
define('CONST_FF_SM', true);
# Load Func Class
$func = new Func;
# Database
$db = new Db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);

# Settings
$db->Query("SELECT * FROM db_config WHERE id = '1'");
$defaultSettings = $db->FetchArray();
#Lang
$langs = new Language;
require_once '../langs/' . $defaultSettings['default_lang'] . '_admin.php';

# Login
if(!isset($_SESSION["admin"])){ include("pages/_login.php"); return; }

# Header
@include("inc/_header.php");
if(isset($_GET["menu"])){
    $smenu = strval($_GET["menu"]);
    switch($smenu){
        case "404": include("pages/_404.php"); break; // Страница ошибки
        case "story_buy": include("pages/_story_buy.php"); break; // История покупок деревьев
        case "story_swap": include("pages/_story_swap.php"); break; // История обмена в обменнике
        case "story_insert": include("pages/_story_insert.php"); break; // История пополнений баланса
        case "story_sell": include("pages/_story_sell.php"); break; // История рынка
        case "news": include("pages/_news.php"); break; // Новости
        case "about": include("pages/_about.php"); break; // о ферме
        case "rules": include("pages/_rules.php"); break; // Правила
        case "contacts": include("pages/_contacts.php"); break; // Контакты
        case "users": include("pages/_users.php"); break; // Список пользователей
        case "sender": include("pages/_sender.php"); break; // Рассылка пользователям
        case "payments": include("pages/_payments.php"); break; // Список выплат
        case "config": include("pages/_config.php"); break; // Настройки
        case "exit": @session_destroy(); Header("Location: /"); return; break; // Настройки
        # Страница ошибки
        default: @include("pages/_404.php"); break;
    }
}else {
    include("pages/_index.php");
}
# Footer
@include("inc/_footer.php");

?>