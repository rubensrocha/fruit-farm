<?PHP 
# “ут вставл¤ем в куки ID referera
if(isset($_GET["i"])){
	$_rid = (intval($_GET["i"]) > 0) ? intval($_GET["i"]) : 1; 
	setcookie("i",$_rid,time()+2592000);
	header("Location: /");
}
?>