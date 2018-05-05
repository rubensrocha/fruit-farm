<?PHP
$user_id = $_SESSION["user_id"];
$usid = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a WHERE id = '$usid'");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$usid'");
$prof_data = $db->FetchArray();
$sumzar = ($prof_data['payment_sum']*100)/$prof_data['insert_sum'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $config->settings['sitename'];?> - {!TITLE!}</title>
    <meta name="description" content="{!DESCRIPTION!}">
    <meta name="keywords" content="{!KEYWORDS!}">
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
<div class="page home-page">

    <!-- Main Navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <!-- Navbar Header-->
                    <div class="navbar-header">
                        <!-- Navbar Brand --><a href="/" class="navbar-brand">
                            <div class="brand-text brand-big hidden-lg-down"><img src="<?php $func->url('img/favicon.png');?>" width="25" height="25"> <span><?php echo $config->settings['sitename'];?></span></div>
                            <div class="brand-text brand-small"><img src="<?php $func->url('img/favicon.png');?>" width="25" height="25"></div></a>
                        <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
                    </div>
                    <?php include('_menu_top.php');?>
                </div>
            </div>
        </nav>
    </header>

    <div class="page-content d-flex align-items-stretch">
        <?php include('_menu_left.php');?>

        <?PHP if(!$_SESSION["user"]) { ?>
        <!-- Login Modal-->
        <div id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <br><br>
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="exampleModalLabel" class="modal-title"><?php echo $lang['common']['auth'];?></h4>
                    </div>
                    <div class="modal-body">
                        <?PHP
                        $csrfCheck = $func->csrfVerify();
                        if(isset($_POST["email"]) && isset($_POST["password"]) && $csrfCheck == TRUE){

                            $is_valid = GUMP::is_valid($_POST, array(
                                'email' => 'required|valid_email',
                                'password' => 'required|max_len,20|min_len,4|alpha_numeric'
                            ));

                            if($is_valid === true) {
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
                                                Header("Location: /account");
                                            }else $showError = $lang['error_messages']['accountBanned'];
                                        }else $showError = $lang['error_messages']['wrongLogin'];
                                    }else $showError = $lang['error_messages']['notfoundAccount'];
                                }else $showError = $lang['error_messages']['wrongLogin'];
                            }else{
                                $showError = $lang['error_messages']['invalidData'];
                            }

                        }
                        if($showError){
                            echo "<div class='alert alert-danger'>{$showError}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                        }

                        ?>
                        <form action="" method="post">
                            <?php $func->csrf(); ?>
                            <div class="form-group">
                                <label><?php echo $lang['common']['email'];?></label>
                                <input name="email" type="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label><?php echo $lang['common']['password'];?></label>
                                <input name="password" type="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><?php echo $lang['btn']['login'];?></button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="<?php $func->url('signup');?>" class="btn btn-warning"><?php echo $lang['btn']['register'];?></a>
                        <button type="button" data-dismiss="modal" class="btn btn-danger"><?php echo $lang['btn']['cancel'];?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /loginModal-->
        <?php } ?>
        <div class="content-inner">
            <div class="page-header">
                <h1>{!TITLE!}</h1>
            </div>