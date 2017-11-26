<?PHP
if(isset($_SESSION["user"])){
	if(isset($_SESSION["admin"]) AND $_GET["menu"] == "admin"){
		include("inc/_admin_menu.php");
	}else include("inc/_user_menu.php");
}else include("inc/_login.php");
include("inc/_stats.php");
?>