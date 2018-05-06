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
        <li class="<?php echo (!$_GET['menu'])?'active':''; ?>"><a href="<?php $func->urlAdmin('');?>"><i class="fa fa-home"></i> Home</a></li>
        <li <?php $func->activeMenu('users');?>><a href="<?php $func->urlAdmin('users');?>"><i class="fa fa-users"></i> View Users</a></li>
        <li <?php $func->activeMenu('sender');?>><a href="<?php $func->urlAdmin('sender');?>"><i class="fa fa-send"></i> Mass mailing</a></li>
        <li <?php $func->activeMenu('config');?>><a href="<?php $func->urlAdmin('config');?>"><i class="fa fa-cogs"></i> Settings</a></li>
    </ul>

    <span class="heading"><?php echo $lang['menu_left']['_transactions'];?></span>
    <ul class="list-unstyled">
        <li <?php $func->activeMenu('story_buy');?>><a href="<?php $func->urlAdmin('story_buy');?>"><i class="fa fa-bank"></i> Purchase history</a></li>
        <li <?php $func->activeMenu('story_swap');?>><a href="<?php $func->urlAdmin('story_swap');?>"><i class="fa fa-refresh"></i> History of exchanges</a></li>
        <li <?php $func->activeMenu('story_insert');?>><a href="<?php $func->urlAdmin('story_insert');?>"><i class="fa fa-arrow-circle-left"></i> History of replenishment</a></li>
        <li <?php $func->activeMenu('story_sell');?>><a href="<?php $func->urlAdmin('story_sell');?>"><i class="fa fa-shopping-basket"></i> Sales in the market</a></li>
        <li <?php $func->activeMenu('payments');?>><a href="<?php $func->urlAdmin('payments');?>"><i class="fa fa-money"></i> Payout list</a></li>
    </ul>

    <span class="heading"><?php echo $lang['menu_left']['_sections'];?></span>
    <ul class="list-unstyled">
        <li <?php $func->activeMenu('news');?>><a href="<?php $func->urlAdmin('news');?>"><i class="fa fa-newspaper-o"></i> News</a></li>
        <li <?php $func->activeMenu('about');?>><a href="<?php $func->urlAdmin('about');?>"><i class="fa fa-exclamation-circle"></i> About</a></li>
        <li <?php $func->activeMenu('rules');?>><a href="<?php $func->urlAdmin('rules');?>"><i class="fa fa-bookmark"></i> Rules</a></li>
        <li <?php $func->activeMenu('contacts');?>><a href="<?php $func->urlAdmin('contacts');?>"><i class="fa fa-envelope"></i> Contact</a></li>
    </ul>

</nav><!-- /Sidebar Header-->
