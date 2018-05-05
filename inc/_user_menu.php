<!-- Sidebar Header-->
<div class="sidebar-header d-flex align-items-center">
    <div class="client">
        <div class="client-avatar">
            <a href="<?php $func->url('account');?>"><img class="img-fluid rounded-circle" src="/img/noavatar.png" width="60" height="60"></a>
            <div title="Online" class="status bg-green"></div>
        </div>
    </div>
    <div class="title">
        <h1 class="h4"><?=$_SESSION["user"]; ?> </h1>
        <p><?=$user_data["name"];?></p>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 offset-1">
        <div class="text-xsmall">
            <?php echo $lang['menu_left']['profit'];?>:<span class="pull-right"> <?=sprintf("%.2f",$sumzar);?> <font color="Gold"><i class="fa fa-percent"></i></font></span>
            <div class="progress">
                <div role="progressbar" style="width: <?=sprintf("%.2f",$sumzar);?>%;height:6px;" aria-valuenow="<?=sprintf("%.2f",$sumzar);?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet" data-toggle="tooltip" data-placement="bottom" title=" <?=sprintf("%.2f",$sumzar);?>%"></div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-10 offset-1">
        <div class="text-small">
            <div class=""><?php echo $lang['menu_left']['p_balance'];?>: <span class="pull-right">{!BALANCE_B!} <i class="fa fa-money"></i></div>
            <div class=""><?php echo $lang['menu_left']['w_balance'];?>: <span class="pull-right">{!BALANCE_P!} <i class="fa fa-money"></i></div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 5px">
    <div class="col-sm-10 offset-1">
        <div class="text-center left-menu-buttons">
            <a href="<?php $func->url('account/insert');?>" class="btn btn-success btn-sm" data-toggle="tooltip" title="<?php echo $lang['btn']['deposit'];?>"><i class="fa fa-plus-circle"></i></a>
            <a href="<?php $func->url('account/payment');?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="<?php echo $lang['btn']['withdraw'];?>"><i class="fa fa-minus-circle"></i></a>
            <a href="<?php $func->url('account/swap');?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="<?php echo $lang['btn']['exchange'];?>"><i class="fa fa-refresh"></i></a>
        </div>
    </div>
</div>
<hr>

<span class="heading"><?php echo $lang['menu_left']['_acc'];?></span>
<ul class="list-unstyled" >
    <li <?php $func->activeMenu('account');?>> <a href="<?php $func->url('account');?>"><i class="fa fa-user"></i><?php echo $lang['menu_left']['account'];?></a></li>
    <li <?php $func->activeMenu('account','referals');?>> <a href="<?php $func->url('account/referals');?>"><i class="fa fa-users"></i><?php echo $lang['menu_left']['referrals'];?></a></li>
    <li <?php $func->activeMenu('account','im');?>> <a href="<?php $func->url('account/im');?>"><i class="fa fa-envelope"></i><?php echo $lang['menu_left']['messages'];?> <span class="pull-right"></span></a></li>
    <li <?php $func->activeMenu('account','config');?>> <a href="<?php $func->url('account/config');?>"><i class="fa fa-cog"></i><?php echo $lang['menu_left']['config'];?> <span class="pull-right"></span></a></li>
</ul>

<span class="heading"><?php echo $lang['menu_left']['_game'];?></span>
<ul class="list-unstyled">
    <li <?php $func->activeMenu('account','farm');?>> <a href="<?php $func->url('account/farm');?>"><i class="fa fa-shopping-cart"></i><?php echo $lang['menu_left']['farm'];?></a></li>
    <li <?php $func->activeMenu('account','store');?>> <a href="<?php $func->url('account/store');?>"><i class="fa fa-briefcase"></i><?php echo $lang['menu_left']['store'];?></a></li>
</ul>

<span class="heading"><?php echo $lang['menu_left']['_earn'];?></span>
<ul class="list-unstyled" >
    <li <?php $func->activeMenu('account','game');?>> <a href="<?php $func->url('account/game');?>"> <i class="fa fa-gamepad"></i><?php echo $lang['menu_left']['games'];?> </a></li>
    <li <?php $func->activeMenu('account','bonus');?>> <a href="<?php $func->url('account/bonus');?>"> <i class="fa fa-gift"></i><?php echo $lang['menu_left']['bonus'];?> </a></li>
</ul>