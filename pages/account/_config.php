<?PHP
$_OPTIMIZATION["title"] = "Аккаунт - Настройки";
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
?>
<div class="s-bk-lf">
	<div class="acc-title">Настройки</div>
</div>
<div class="silver-bk">
<div class="clr"></div>	
<center><b>Смена пароля</b></center>
<BR />
<?PHP
	if(isset($_POST["old"])){
		$old = $func->IsPassword($_POST["old"]);
		$new = $func->IsPassword($_POST["new"]);
			if($old !== false AND strtolower($old) == strtolower($user_data["pass"])){
				if($new !== false){
					if( strtolower($new) == strtolower($_POST["re_new"])){
						$db->Query("UPDATE db_users_a SET pass = '$new' WHERE id = '$usid'");
						echo "<center><font color = 'green'><b>Новый пароль успешно установлен</b></font></center><BR />";
					}else echo "<center><font color = 'red'><b>Пароль и повтор пароля не совпадают</b></font></center><BR />";
				}else echo "<center><font color = 'red'><b>Новый пароль имеет неверный формат</b></font></center><BR />";
			}else echo "<center><font color = 'red'><b>Старый паполь заполнен неверно</b></font></center><BR />";
	}
?>
<form action="" method="post">
<table width="330" border="0" align="center">
  <tr>
    <td><b>Старый пароль:</b></td>
    <td align="center"><input type="password" name="old" /></td>
  </tr>
  <tr>
    <td><b>Новый пароль:</b></td>
    <td align="center"><input type="password" name="new" /></td>
  </tr>
  <tr>
    <td><b>Повтор пароля:</b></td>
    <td align="center"><input type="password" name="re_new" /></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><BR /><input type="submit" value="Сменить пароль" /></td>
  </tr>
</table>
</form>
<BR />
Поле Пароль должно иметь от 6 до 20 символов (только англ. символы)
<div class="clr"></div>		
</div>