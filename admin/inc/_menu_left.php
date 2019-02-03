<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="client">
            <div class="client-avatar">
                <img class="img-fluid rounded-circle" src="/img/noavatar.png" width="60" height="60">
                <div title="Online" class="status bg-green"></div>
            </div>
        </div>
        <div class="title">
            <h1 class="h4"><?php echo $_SESSION["adminUs"]; ?> </h1>
        </div>
    </div>
    <span class="heading"><?php echo $lang['menu_left']['_home'];?></span>
    <ul class="list-unstyled">
        <li class="<?php echo (!$_GET['menu'])?'active':''; ?>"><a href="<?php $func->urlAdmin('');?>"><i class="fa fa-home"></i> <?php echo $lang['menu_left']['home'];?></a></li>
        <li <?php $func->activeMenu('users');?>><a href="<?php $func->urlAdmin('users');?>"><i class="fa fa-users"></i> <?php echo $lang['menu_left']['users'];?></a></li>
        <li <?php $func->activeMenu('sender');?>><a href="<?php $func->urlAdmin('sender');?>"><i class="fa fa-send"></i> <?php echo $lang['menu_left']['sender'];?></a></li>
        <li <?php $func->activeMenu('config');?>><a href="<?php $func->urlAdmin('config');?>"><i class="fa fa-cogs"></i> <?php echo $lang['menu_left']['settings'];?></a></li>
        <li <?php $func->activeMenu('adminpassword');?>><a href="<?php $func->urlAdmin('adminpassword');?>"><i class="fa fa-user-secret"></i> <?php echo $lang['menu_left']['adminpass'];?></a></li>
    </ul>

    <span class="heading"><?php echo $lang['menu_left']['_transactions'];?></span>
    <ul class="list-unstyled">
        <li <?php $func->activeMenu('story_buy');?>><a href="<?php $func->urlAdmin('story_buy');?>"><i class="fa fa-bank"></i> <?php echo $lang['menu_left']['purchases'];?></a></li>
        <li <?php $func->activeMenu('story_swap');?>><a href="<?php $func->urlAdmin('story_swap');?>"><i class="fa fa-refresh"></i> <?php echo $lang['menu_left']['exchanges'];?></a></li>
        <li <?php $func->activeMenu('story_insert');?>><a href="<?php $func->urlAdmin('story_insert');?>"><i class="fa fa-arrow-circle-left"></i> <?php echo $lang['menu_left']['deposits'];?></a></li>
        <li <?php $func->activeMenu('story_sell');?>><a href="<?php $func->urlAdmin('story_sell');?>"><i class="fa fa-shopping-basket"></i> <?php echo $lang['menu_left']['sales'];?></a></li>
        <li <?php $func->activeMenu('payments');?>><a href="<?php $func->urlAdmin('payments');?>"><i class="fa fa-money"></i> <?php echo $lang['menu_left']['withdraws'];?></a></li>
    </ul>

    <span class="heading"><?php echo $lang['menu_left']['_sections'];?></span>
    <ul class="list-unstyled">
        <li <?php $func->activeMenu('news');?>><a href="<?php $func->urlAdmin('news');?>"><i class="fa fa-newspaper-o"></i> <?php echo $lang['menu_left']['news'];?></a></li>
        <li <?php $func->activeMenu('about');?>><a href="<?php $func->urlAdmin('about');?>"><i class="fa fa-exclamation-circle"></i> <?php echo $lang['menu_left']['about'];?></a></li>
        <li <?php $func->activeMenu('rules');?>><a href="<?php $func->urlAdmin('rules');?>"><i class="fa fa-bookmark"></i> <?php echo $lang['menu_left']['rules'];?></a></li>
        <li <?php $func->activeMenu('contacts');?>><a href="<?php $func->urlAdmin('contacts');?>"><i class="fa fa-envelope"></i> <?php echo $lang['menu_left']['contact'];?></a></li>
    </ul>

</nav><!-- /Sidebar Header-->
