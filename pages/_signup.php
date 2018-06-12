<?PHP
$_OPTIMIZATION["title"] = $lang['register']['title'];
if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
?>
<section class="no-padding-bottom">
    <div class="col-lg-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h3><?php echo $lang['register']['title'];?></h3>
            </div>
            <div class="card-body">
                <?PHP
                # Регистрация
                $csrfCheck = $func->csrfVerify();
                if(isset($_POST["signup"]) and $csrfCheck == TRUE){
                    $validate = GUMP::is_valid($_POST, array(
                        'captcha' => 'required',
                        'login' => 'required|alpha_numeric|max_len,20|min_len,4',
                        'email' => 'required|valid_email',
                        'password' => 'required|max_len,20|min_len,4|alpha_numeric',
                        'repass' => 'required|max_len,20|min_len,4|alpha_numeric',
                    ));

                    if($validate === true) {
                        $captcha = $_POST["captcha"];
                        $email = $_POST["email"];
                        $login = $_POST["login"];
                        $password = $_POST["password"];
                        $securePass = $func->md5Password($_POST["password"]);
                        $repass  = $_POST["repass"];

                        if(isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])){
                            unset($_SESSION["captcha"]);
                            $ip = $func->UserIP;
                            $rules = isset($_POST["rules"]) ? true : false;
                            $time = time();
                            $referer_id = (isset($_COOKIE["i"]) AND intval($_COOKIE["i"]) > 0 AND intval($_COOKIE["i"]) < 1000000) ? intval($_COOKIE["i"]) : 1;
                            $referer_name = "";
                            if($referer_id != 1){
                                $db->Query("SELECT user FROM db_users_a WHERE id = '$referer_id' LIMIT 1");
                                if($db->NumRows() > 0){$referer_name = $db->FetchRow();}
                                else{ $referer_id = 1; $referer_name = "Admin"; }
                            }else{ $referer_id = 1; $referer_name = "Admin"; }
                            if($rules){
                                if($email !== false){
                                    if($login !== false){
                                        if($password !== false){
                                            if($password == $repass){
                                                $db->Query("SELECT COUNT(*) FROM db_users_a WHERE user = '$login'");
                                                if($db->FetchRow() == 0){
                                                    # Регаем пользователя
                                                    $db->Query("INSERT INTO db_users_a (user, email, pass, referer, referer_id, date_reg, ip) VALUES ('$login','{$email}','$securePass','$referer_name','$referer_id','$time',INET_ATON('$ip'))");
                                                    $lid = $db->LastInsert();
                                                    $db->Query("INSERT INTO db_users_b (id, user, a_t, last_sbor) VALUES ('$lid','$login','1', '".time()."')");
                                                    # Вставляем статистику
                                                    $db->Query("UPDATE db_stats SET all_users = all_users +1 WHERE id = '1'");
                                                    # Отправляем на почту
                                                    $sender = new Isender;
                                                    $sender -> SendAfterReg($login,$email, $password);
                                                    $_SESSION["user_id"] = $lid;
                                                    $_SESSION["user"] = $login;
                                                    $_SESSION["referer_id"] = $referer_id;
                                                    Header("Location: /account");
                                                    ?></section>
                                                        <div class="clr"></div>
                                                    <?PHP
                                                    return;
                                                    }else $showError = $lang['error_messages']['usernameInUse'];
                                                }else $showError = $lang['error_messages']['passwordMatch'];
                                            }else $showError = $lang['error_messages']['emptyPassword'];
                                        }else $showError = $lang['error_messages']['emptyLogin'];
                                    }else $showError = $lang['error_messages']['emailInvalid'];
                                }else $showError = $lang['error_messages']['tosConfirm'];
                        }else $showError = $lang['error_messages']['captcha'];
                    }else{
                        $showError = $lang['error_messages']['invalidData'];
                    }
                }
                ?>
                <form action="" method="post">
                    <?php $func->csrf(); ?>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['username'];?></label>
                        <input name="login" type="text" minlength="4" maxlength="20" value="<?=(isset($_POST["login"])) ? $_POST["login"] : false; ?>" class="form-control">
                        <small class="form-text text-muted"><?php echo $lang['register']['username_h'];?></small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['email'];?></label>
                        <input type="email" name="email" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['password'];?></label>
                        <input name="password" type="password" minlength="4" maxlength="20" value="<?=(isset($_POST["password"])) ? $_POST["password"] : false; ?>" class="form-control">
                        <small class="form-text text-muted"><?php echo $lang['register']['password_h'];?></small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['register']['passConfirm'];?></label>
                        <input name="repass" type="password" minlength="4" maxlength="20" value="<?=(isset($_POST["repass"])) ? $_POST["repass"] : false; ?>" class="form-control">
                        <small class="form-text text-muted"><?php echo $lang['register']['passConfirm_h'];?></small>
                    </div>
                    <div class="form-group">
                        <input name="rules" type="checkbox" value="1" class="checkbox-template" />&nbsp;&nbsp; <a href="/rules" target="_blank"><?php echo $lang['register']['acceptRules'];?></a>
                    </div>
                    <div class="form-group">
                        <span onclick="ResetCaptcha(this);"><img src="/captcha.php?rnd=<?=rand(1,10000); ?>" /></span>
                        <small class="form-text text-muted"><?php echo $lang['common']['captcha_h'];?></small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['captcha'];?></label>
                        <input name="captcha" type="text" size="25" maxlength="50" class="form-control" />
                    </div>
                    <button type="submit" name="signup" class="btn btn-primary"><?php echo $lang['btn']['register'];?></button>
                </form>
            </div>
        </div>
    </div>
</section>
