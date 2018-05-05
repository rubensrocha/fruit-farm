<?PHP/*
if(isset($_SESSION["user"])){
	if(isset($_SESSION["admin"]) AND $_GET["menu"] == "admin"){
		include("inc/_admin_menu.php");
	}else include("inc/_user_menu.php");
}else include("inc/_login.php");
include("inc/_stats.php");*/
?>
<nav class="side-navbar">
    <?PHP if($_SESSION["user"]) { ?>
        <!-- START USER MENU -->
        <?php include('_user_menu.php');?>
        <!-- END USER MENU -->
    <?php } else { ?>
        <br>
        <span class="heading"><?php echo $lang['menu_left']['game'];?></span>
        <ul class="list-unstyled">
            <li> <a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-sign-in"></i><?php echo $lang['menu_left']['login'];?></a></li>
            <li> <a href="<?php $func->url('signup');?>"> <i class="fa fa-plus-circle"></i><?php echo $lang['menu_left']['register'];?></a></li>
            <li> <a href="<?php $func->url('recovery');?>"> <i class="fa fa-unlock"></i><?php echo $lang['menu_left']['resetpass'];?></a></li>
        </ul>
        <span class="heading"><?php echo $lang['menu_left']['info'];?></span>
        <ul class="list-unstyled">
            <li> <a href="<?php $func->url('rules');?>"> <i class="fa fa-bookmark"></i><?php echo $lang['menu_left']['rules'];?></a></li>
            <li> <a href="<?php $func->url('about');?>"> <i class="fa fa-exclamation-circle"></i><?php echo $lang['menu_left']['about'];?></a></li>
            <li> <a href="<?php $func->url('stat');?>"> <i class="fa fa-signal"></i><?php echo $lang['menu_left']['statistics'];?></a></li>

        </ul>
    <?PHP } ?>
    <div class="text-center">
        <img src="<?php $func->url('img/payment.png');?>" style="width: 88px;">
    </div>
</nav><!-- /Sidebar Header-->
