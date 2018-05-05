<?PHP
if(isset($_POST["auth"])){
    $validate = GUMP::is_valid($_POST, array(
        'email' => 'required|valid_email',
        'password' => 'required|max_len,20|min_len,4|alpha_numeric'
    ));

    if($validate === true) {
        $email = $_POST["email"];
        $password = $func->md5Password($_POST["password"]);
        if($email !== false && $password !== false){
            $db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$email'");
            if($db->NumRows() == 1){
                $data = $db->FetchArray();
                if(strtolower($data["pass"]) == strtolower($password)){
                    if($data["banned"] == 0){
                        # Считаем рефералов
                        $db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$data["id"]."'");
                        $refs = $db->FetchRow();
                        $db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$data["id"]."'");
                        $_SESSION["user_id"] = $data["id"];
                        $_SESSION["user"] = $data["user"];
                        $_SESSION["referer_id"] = $data["referer_id"];
                        if($data['id'] == 1) $_SESSION['admin'] = TRUE;
                        Header("Location: /account");
                    }else $showError = $lang['error_messages']['accountBanned'];
                }else $showError = $lang['error_messages']['wrongLogin'];
            }else $showError = $lang['error_messages']['notfoundAccount'];
        }else $showError = $lang['error_messages']['wrongLogin'];
    }else{
        $showError = $lang['error_messages']['invalidData'];
    }
}
?>
<div class="autoriz">
    <?php
    if($showError){
        echo "<div class='alert alert-danger'>{$showError}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
    }?>
	<form action="" method="post">
        <?php $func->csrf(); ?>
	<div class="h-title">Вход в аккаунт</div>	
	<table width="200" border="0" align="center">
	  <tr>
		<td colspan="2">Email:<BR /><input name="email" type="text" size="23" maxlength="35" class="lg"/></td>
	  </tr>
	  <tr>
		<td colspan="2">Пароль [<a href="/recovery" class="rs-ps">Забыли пароль?</a>]:<BR /><input name="password" type="password" size="23" maxlength="35" class="ps"/></td>
	  </tr>
	  <tr height="5">
		<td align="center" valign="top"><input type="submit" name="auth" value="Войти" class="btn_in"/></form></td>
		<td align="center" valign="top"><form action="/signup" method="post"><input type="submit" value="Регистрация" class="btn_reg"/></form></td>
	  </tr>
	</table>
</div>