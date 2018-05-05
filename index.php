<?PHP
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */
# Counter
function TimerSet(){
	list($seconds, $microSeconds) = explode(' ', microtime());
	return $seconds + (float) $microSeconds;
}
$_timer_a = TimerSet();
# Start Session
@session_start();
# Buffer Start
@ob_start();
# Load Composer classes and Packages
include ("vendor/autoload.php");

# Load Config Class
$config = new Config;
# Default
$_OPTIMIZATION = array();
$_OPTIMIZATION["title"] = $config->settings['sitename'];
$_OPTIMIZATION["description"] = $config->settings['description'];
$_OPTIMIZATION["keywords"] = $config->settings['keywords'];
# Constant for Include
define('CONST_FF_SM', true);
# Load Func Class
$func = new Func;
# Set Referral Cookie
include("inc/_set_referer.php");
# Database
$db = new Db($config->HostDB, $config->UserDB, $config->PassDB, $config->BaseDB);
#Lang
$langs = new Language;
require_once 'langs/' . $langs->getCurrentLang() . '.php';
# Header
@include("inc/_header.php");
	if(isset($_GET["menu"])){
		$menu = strval($_GET["menu"]);
		switch($menu){
			case "404": include("pages/_404.php"); break; // Error page
			case "rules": include("pages/_rules.php"); break; // Rules
			case "about": include("pages/_about.php"); break; // About
			case "contacts": include("pages/_contacts.php"); break; // Contact
			case "news": include("pages/_news.php"); break; // News
			case "signup": include("pages/_signup.php"); break; // Signup
			case "recovery": include("pages/_recovery.php"); break; // Recovery Password
			case "payments": include("pages/_payments.php"); break; // Payments
			case "users": include("pages/_users.php"); break; // Users
			case "account": include("pages/_account.php"); break; // Account
			case "admin": include("pages/_admin.php"); break; // Administration
			case "success": include("pages/_success.php"); break; // Success Payment
			case "fail": include("pages/_fail.php"); break; // Fail Payment
			case "stat": include("pages/_stat.php"); break; // Project Statistics
			# Error page
			default: @include("pages/_404.php"); break;
		}
	}else @include("pages/_index.php");
# Footer
@include("inc/_footer.php");
# Enter the content in a variable
$content = ob_get_contents();
# Clear the buffer
ob_end_clean();
	# Replace data
	$content = str_replace("{!TITLE!}",$_OPTIMIZATION["title"],$content);
	$content = str_replace('{!DESCRIPTION!}',$_OPTIMIZATION["description"],$content);
	$content = str_replace('{!KEYWORDS!}',$_OPTIMIZATION["keywords"],$content);
	$content = str_replace('{!GEN_PAGE!}', sprintf("%.5f", (TimerSet() - $_timer_a)) ,$content);
	# Balance sheet
	if(isset($_SESSION["user_id"])){
		$user_id = $_SESSION["user_id"];
		$db->Query("SELECT money_b, money_p FROM db_users_b WHERE id = '$user_id'");
		$balance = $db->FetchArray();
		$content = str_replace('{!BALANCE_B!}', sprintf("%.2f", $balance["money_b"]) ,$content);
		$content = str_replace('{!BALANCE_P!}', sprintf("%.2f", $balance["money_p"]) ,$content);
	}
// Displaying content
echo $content;
?>