<?PHP
$_OPTIMIZATION["title"] = $lang['recovery']['title'];
if(isset($_SESSION["user_id"])){ Header("Location: /account"); return; }
// Reset password
if(isset($_GET['hash'])){
    $getHash = strip_tags($_GET['hash']);
    $db->Query("SELECT id,email,hash FROM db_recovery WHERE hash='$getHash' LIMIT 1");
    // Redirect to index if invalid hash
    if($db->NumRows() == 0){
        Header("Location: /");
        return;
    }
    $recovery = $db->FetchArray();
    $csrfCheck = $func->csrfVerify();
    if(isset($_POST["resetPassword"]) and $csrfCheck == TRUE){
        $validate = GUMP::is_valid($_POST, array(
            'captcha' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|max_len,20|min_len,4|alpha_numeric',
            'repass' => 'required|max_len,20|min_len,4|alpha_numeric',
        ));

        if($validate === true) {
            $captcha = $_POST["captcha"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $repass = $_POST["repass"];
            if (isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])) {
                unset($_SESSION["captcha"]);
                $time = time();
                $newPass = $func->md5Password($password);
                if ($email !== false) {
                    if($password !== false){
                        if($password == $repass){
                            $db->Query("DELETE FROM db_recovery WHERE date_del < '$time'");
                            $db->Query("SELECT id, user, email, pass FROM db_users_a WHERE email = '$email' LIMIT 1");
                            if ($db->NumRows() == 1) {
                                $data = $db->FetchArray();
                                $uId = $data["id"];
                                $db->Query("UPDATE db_users_a SET pass = '$newPass' WHERE id = '$uId'");
                                $showSuccess = $lang['recovery']['resetSuccess'];
                                $showError = null;
                            } else $showError = $lang['error_messages']['notfoundAccount'];
                        }else $showError = $lang['error_messages']['passwordMatch'];
                    }else $showError = $lang['error_messages']['emptyPassword'];
                } else $showError = $lang['error_messages']['emailInvalid'];
            } else $showError = $lang['error_messages']['captcha'];
        }else{
            $showError = $lang['error_messages']['invalidData'];
        }
    }
?>
    <section class="no-padding-bottom">
        <div class="col-lg-6 offset-3">
            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <?php $func->csrf(); ?>
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
                            <span onclick="ResetCaptcha(this);"><img class="captcha" src="/captcha.php?rnd=<?=rand(1,10000); ?>" /></span>
                            <small class="form-text text-muted"><?php echo $lang['common']['captcha_h'];?></small>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"><?php echo $lang['common']['captcha'];?></label>
                            <input name="captcha" type="text" size="25" maxlength="50" class="form-control" />
                        </div>
                        <button type="submit" name="resetPassword" class="btn btn-primary"><?php echo $lang['btn']['forgot'];?></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php
}else{
    // Request reset link
    $csrfCheck = $func->csrfVerify();
    if(isset($_POST["requestRecovery"]) and $csrfCheck == TRUE){
        $validate = GUMP::is_valid($_POST, array(
            'captcha' => 'required',
            'email' => 'required|valid_email',
        ));

        if($validate === true) {
            $captcha = $_POST["captcha"];
            $email = $_POST["email"];
            if (isset($_SESSION["captcha"]) AND strtolower($_SESSION["captcha"]) == strtolower($_POST["captcha"])) {
                unset($_SESSION["captcha"]);
                $time = time();
                $tdel = $time + 60 * 15;
                $hash = $func->randomPassword();
                $newHash = $func->md5Password($hash);
                if ($email !== false) {
                    $db->Query("DELETE FROM db_recovery WHERE date_del < '$time'");
                    $db->Query("SELECT COUNT(*) FROM db_recovery WHERE ip = INET_ATON('" . $func->UserIP . "') OR email = '$email'");
                    if ($db->FetchRow() == 0) {
                        $db->Query("SELECT id, user, email, pass FROM db_users_a WHERE email = '$email'");
                        if ($db->NumRows() == 1) {
                            $data = $db->FetchArray();
                            # Вносим запись в БД
                            $db->Query("INSERT INTO db_recovery (email, ip, hash, date_add, date_del) VALUES ('$email',INET_ATON('" . $func->UserIP . "'),'$newHash','$time','$tdel')");
                            # Отправляем пароль
                            $sender = new Isender;
                            $sender->RecoveryPassword($data["user"], $newHash, $data["email"]);
                            $showSuccess = $lang['recovery']['requestSended'];
                        } else $showError = $lang['error_messages']['notfoundAccount'];
                    } else $showError = $lang['error_messages']['requestReset'];
                } else $showError = $lang['error_messages']['emailInvalid'];
            } else $showError = $lang['error_messages']['captcha'];
        }else{
            $showError = $lang['error_messages']['invalidData'];
        }
    }
?>
<section class="no-padding-bottom">
    <div class="col-lg-6 offset-3">
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <?php $func->csrf(); ?>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['email'];?></label>
                        <input type="email" name="email" value="<?=(isset($_POST["email"])) ? $_POST["email"] : false; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <span onclick="ResetCaptcha(this);"><img class="captcha" src="/captcha.php?rnd=<?=rand(1,10000); ?>" /></span>
                        <small class="form-text text-muted"><?php echo $lang['common']['captcha_h'];?></small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['captcha'];?></label>
                        <input name="captcha" type="text" size="25" maxlength="50" class="form-control" />
                    </div>
                    <button type="submit" name="requestRecovery" class="btn btn-primary"><?php echo $lang['btn']['forgot'];?></button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
