<!-- Navbar Menu -->
<ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
    <li class="nav-item"><a href="<?php $func->url('news');?>" class="nav-link"><?php echo $lang['menu_top']['news'];?></a></li>
    <li class="nav-item"><a href="<?php $func->url('contacts');?>" class="nav-link"><?php echo $lang['menu_top']['contact'];?></a></li>
    <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <img src='<?php echo $func->url("img/flags/{$langs->getCurrentLang()}.png'");?>' title='<?php echo $lang['langSelect'];?>'/>
        </a>
        <ul aria-labelledby="user" class="dropdown-menu">
            <?php foreach($config->languages as $k => $v){ ?>
                <li><a href="<?php $func->url('?lang='.$k);?>" class="dropdown-item"><img src="<?php $func->url('img/flags/'.$k.'.png');?>" /> <?php echo $v;?></a></li>
            <?php } ?>
        </ul>
    </li>
    <?PHP if($_SESSION["user"]) {?>
        <li class="nav-item"><a href="<?php $func->url('account');?>" class="nav-link"><?php echo $lang['menu_top']['account'];?></a>
        </li>
    <?php }
    if(isset($_SESSION["admin"])) {?>
    <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            Admin
        </a>
        <ul aria-labelledby="user" class="dropdown-menu">
            <ul class="list-unstyled">
                <li> <a href="/?menu=admin4ik&sel=stats" class="dropdown-item"><i class="fa fa-bar-chart"></i> Statistics </a></li>
                <li> <a href="/?menu=admin4ik&sel=story_insert" class="dropdown-item"><i class="fa fa-plus-circle"></i> Deposit History </a></li>
                <li> <a href="/?menu=admin4ik&sel=news" class="dropdown-item"><i class="fa fa-newspaper-o"></i> News </a></li>
                <li> <a href="/?menu=admin4ik&sel=about" class="dropdown-item"><i class="fa fa-question"></i> About Us </a></li>
                <li> <a href="/?menu=admin4ik&sel=rules" class="dropdown-item"><i class="fa fa-exclamation-triangle"></i> Rules </a></li>
                <li> <a href="/?menu=admin4ik&sel=contacts" class="dropdown-item"><i class="fa fa-envelope"></i> Contact</a></li>
                <li> <a href="/?menu=admin4ik&sel=users" class="dropdown-item"><i class="fa fa-users"></i> Users </a></li>
                <li> <a href="/?menu=admin4ik&sel=sender" class="dropdown-item"><i class="fa fa-send"></i> Mass Mail</a></li>
                <li> <a href="/?menu=admin4ik&sel=payments" class="dropdown-item"><i class="fa fa-minus-circle"></i> Withdraws </a></li>
                <li> <a href="/?menu=admin4ik&sel=config" class="dropdown-item"><i class="fa fa-cogs"></i> Settings </a></li>
                <li> <a href="/account/exit" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout </a></li>
            </ul>
        </ul>
    </li>
</ul>
<?php } ?>