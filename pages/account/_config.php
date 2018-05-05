<?PHP
$_OPTIMIZATION["title"] = $lang['acc_settings']['title'];
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();

$csrfCheck = $func->csrfVerify();
if(isset($_POST["old"]) and $csrfCheck == TRUE){
    $validate = GUMP::is_valid($_POST, array(
        'old' => 'required|max_len,20|min_len,4|alpha_numeric',
        'new' => 'required|max_len,20|min_len,4|alpha_numeric',
        're_new' => 'required|max_len,20|min_len,4|alpha_numeric',
    ));

    if($validate === true) {
        $old           = $_POST["old"];
        $new           = $_POST["new"];
        $repass        = $_POST["re_new"];
        $old_secure    = $func->md5Password($_POST["old"]);
        $new_secure    = $func->md5Password($_POST["new"]);
        $renew_secure  = $func->md5Password($_POST["re_new"]);
            if($old_secure !== false AND $old_secure == $user_data["pass"]){
                if($new_secure !== false){
                    if( $new_secure == $renew_secure){
                        $db->Query("UPDATE db_users_a SET pass = '$new_secure' WHERE id = '$usid'");
                        $showSuccess = $lang['success_messages']['changesSaved'];
                    }else $showError = $lang['error_messages']['passwordMatch'];
                }else $showError = $lang['error_messages']['emptyPassword'];
            }else $showError = $lang['error_messages']['oldpassword'];
    }else {
        $showError = $lang['error_messages']['invalidData'];
    }
}
?>
<section class="no-padding-bottom">
    <div class="col-lg-8 offset-2">
        <div class="card">
            <div class="card-header">
                <h3><?php echo $lang['acc_settings']['_password'];?></h3>
            </div>
            <div class="card-body">
                <?php
                if($showError){
                    echo "<div class='alert alert-danger'>{$showError}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                }
                if($showSuccess){
                    echo "<div class='alert alert-success'>{$showSuccess}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                }
                ?>
                <form action="" method="post">
                    <?php $func->csrf(); ?>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['password_old'];?></label>
                        <input name="old" type="password" minlength="4" maxlength="20" value="<?=(isset($_POST["password"])) ? $_POST["password"] : false; ?>" class="form-control">
                        <small class="form-text text-muted"><?php echo $lang['acc_settings']['old_password'];?></small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['common']['password_new'];?></label>
                        <input name="new" type="password" minlength="4" maxlength="20" value="<?=(isset($_POST["password"])) ? $_POST["password"] : false; ?>" class="form-control">
                        <small class="form-text text-muted"><?php echo $lang['register']['password_h'];?></small>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"><?php echo $lang['register']['passConfirm'];?></label>
                        <input name="re_new" type="password" minlength="4" maxlength="20" value="<?=(isset($_POST["repass"])) ? $_POST["repass"] : false; ?>" class="form-control">
                        <small class="form-text text-muted"><?php echo $lang['register']['passConfirm_h'];?></small>
                    </div>
                    <button type="submit" name="save" class="btn btn-primary"><?php echo $lang['btn']['save'];?></button>
                </form>
            </div>
        </div>
    </div>
</section>