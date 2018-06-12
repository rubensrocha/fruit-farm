<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $config->settings['sitename'];?> - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php $func->url('vendor/bootstrap/css/bootstrap.min.css');?>">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php $func->url('vendor/font-awesome/css/font-awesome.min.css');?>">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php $func->url('css/fontastic.css');?>">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="<?php $func->url('css/style.default.css');?>" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php $func->url('css/custom.css');?>">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php $func->url('img/favicon.ico');?>">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body>
<div class="page login-page">
    <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
            <div class="row">
                <!-- Logo & Information Panel-->
                <div class="col-lg-6">
                    <div class="info d-flex align-items-center">
                        <div class="content">
                            <div class="logo">
                                <h1><?php echo $lang['title'];?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form Panel    -->
                <div class="col-lg-6 bg-white">
                    <div class="form d-flex align-items-center">
                        <div class="content">
                            <?PHP
                            $csrfCheck = $func->csrfVerify();
                            if(isset($_POST["auth"])  and $csrfCheck == TRUE){
                                $validate = GUMP::is_valid($_POST, array(
                                    'username' => 'required|alpha_numeric',
                                    'password' => 'required|max_len,20|min_len,4|alpha_numeric'
                                ));

                                if($validate === true) {
                                    $username = $_POST["username"];
                                    $password = $func->md5Password($_POST["password"]);
                                    if($email !== false && $password !== false){
                                        $db->Query("SELECT id, user, pass FROM db_admins WHERE user = '$username'");
                                        if($db->NumRows() == 1){
                                            $data = $db->FetchArray();
                                            if(strtolower($data["pass"]) == strtolower($password)){
                                                $db->Query("UPDATE db_admins SET date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$data["id"]."'");
                                                $_SESSION["adminId"] = $data["id"];
                                                $_SESSION["adminUs"] = $data["user"];
                                                $_SESSION['admin'] = TRUE;
                                                Header("Location: /admin");
                                            }else $showError = $lang['error_messages']['wrongLogin'];
                                        }else $showError = $lang['error_messages']['notfoundAccount'];
                                    }else $showError = $lang['error_messages']['wrongLogin'];
                                }else{
                                    $showError = $lang['error_messages']['invalidData'];
                                }
                            }
                            ?>
                            <?php
                            if($showError){
                                echo "<div class='alert alert-danger'>{$showError}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                            }?>
                            <form method="post" class="form-validate" action="">
                                <?php $func->csrf(); ?>
                                <div class="form-group">
                                    <input id="login-username" type="text" name="username" required class="input-material">
                                    <label for="login-username" class="label-material"><?php echo $lang['common']['username'];?></label>
                                </div>
                                <div class="form-group">
                                    <input id="login-password" type="password" name="password" required class="input-material">
                                    <label for="login-password" class="label-material"><?php echo $lang['common']['password'];?></label>
                                </div>
                                <button type="submit" name="auth" class="btn btn-primary"><?php echo $lang['btn']['login'];?></button>
                                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                            </form>
                            <br>
                            <!-- <a href="#" class="forgot-pass"><?php echo $lang['btn']['forgotL'];?></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyrights text-center">
        <p>Design by <a href="https://bootstrapious.com/admin-templates" class="external" target="_blank">Bootstrapious</a>
            <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
        </p>
    </div>
</div>
<!-- JavaScript files-->
<script src="<?php $func->url('vendor/jquery/jquery.min.js');?>"></script>
<script src="<?php $func->url('vendor/popper.js/umd/popper.min.js');?>"></script>
<script src="<?php $func->url('vendor/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php $func->url('vendor/jquery.cookie/jquery.cookie.js');?>"></script>
<script src="<?php $func->url('vendor/jquery-validation/jquery.validate.min.js');?>"></script>
<!-- Main File-->
<script src="<?php $func->url('js/front.js');?>"></script>
</body>
</html>
