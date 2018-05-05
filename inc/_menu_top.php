<!-- Navbar Menu -->
<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
    <li class="nav-item"><a href="<?php $func->url('news');?>" class="nav-link"><?php echo $lang['menu_top']['news'];?></a></li>
    <li class="nav-item"><a href="<?php $func->url('payments');?>" class="nav-link"><?php echo $lang['menu_top']['payments'];?></a></li>
    <li class="nav-item"><a href="<?php $func->url('contacts');?>" class="nav-link"><?php echo $lang['menu_top']['contact'];?></a></li>
    <?PHP if($_SESSION["user"]) { ?>
        <li class="nav-item"><a href="<?php $func->url('account');?>" class="nav-link"><?php echo $lang['menu_top']['account'];?></a></li>
        <li class="nav-item"><a href="<?php $func->url('account/exit');?>" class="nav-link"><?php echo $lang['menu_top']['exit'];?></a></li>
    <?php } ?>
    <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <img src='<?php echo $func->url("img/flags/{$langs->getCurrentLang()}.png'");?>' title='<?php echo $lang['langSelect'];?>'/>
        </a>
        <ul aria-labelledby="user" class="dropdown-menu">
            <?php foreach($config->languages as $k => $v){ ?>
                <li><a href="<?php $func->url('?lang='.$k);?>" class="dropdown-item"><img src="<?php $func->url('img/flags/'.$k.'.png');?>" /> <?php echo $v;?></a></li>
            <?php } ?>
        </ul>
    </li>
</ul>