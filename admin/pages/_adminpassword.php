<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $lang['adminpass']['title']; ?></h4>
            </div>
            <div class="card-body">
                <?PHP
                $db->Query("SELECT * FROM db_admins WHERE id = '1'");
                $data_c = $db->FetchArray();

                # Обновление
                if (isset($_POST["admin"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $password_confirmation = $_POST["password_confirmation"];
                    $password_old = $_POST["password_old"];
                    # Проверка на ошибки
                    $errors = true;
                    if (!$username || !$password_old) {
                        $errors = false;
                        $showError = $lang['adminpass']['error_emptyfields'];
                    }
                    if($func->md5Password($password_old) != $data_c['pass']){
                        $errors = false;
                        $showError = $lang['adminpass']['error_oldpass'];
                    }
                    if($password && $password != $password_confirmation){
                        $errors = false;
                        $showError = $lang['adminpass']['error_newpassmatch'];
                    }

                    # Обновление
                    if ($errors) {
                        if($password){
                            $newpass = $func->md5Password($password);
                            $db->Query("UPDATE db_admins SET 
                                user = '$username',
                                pass = '$newpass'		
                            WHERE id = '1'"
                            );
                        }else{
                            $db->Query("UPDATE db_admins SET 
                                user = '$username'	
                            WHERE id = '1'"
                            );
                        }

                        $_SESSION['adminUs'] = $username;

                        $showSuccess = $lang['success_messages']['changesSaved'];
                        $db->Query("SELECT * FROM db_admins WHERE id = '1'");
                        $data_c = $db->FetchArray();
                    }
                }

                ?>
                <?php
                if ($showError) {
                    echo "<div class='alert alert-danger'>{$showError}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                }
                if ($showSuccess) {
                    echo "<div class='alert alert-success'>{$showSuccess}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                }
                ?>
                <form action="" method="post">
                    <?php $func->csrf(); ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['adminpass']['username']; ?></label>
                                <input class="form-control" type="text" name="username"
                                       value="<?php echo $data_c['user']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['adminpass']['password']; ?></label>
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['adminpass']['password_confirmation']; ?></label>
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['adminpass']['password_old']; ?></label>
                                <input class="form-control" type="password" name="password_old" required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="admin"
                            class="btn btn-primary"><?php echo $lang['btn']['save']; ?></button>
                </form>
            </div>
        </div>
    </div>
</section>