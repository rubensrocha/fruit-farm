<?PHP
$_OPTIMIZATION["title"] = $lang['swap']['title'];
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
$minValue = 100;
?>
<section class="no-padding-bottom">
    <div class="col-lg-10 offset-1">
        <div class="card">
            <div class="card-body">
                <p><?php echo sprintf($lang['swap']['text'],$sonfig_site["percent_swap"]);?></p>
                <p class="text-bold text-danger"><?php echo $lang['swap']['alert'];?></p>
                <?PHP
                if(isset($_POST["sum"])){
                    $sum = intval($_POST["sum"]);
                    if($sum >= $minValue){
                        if($user_data["money_p"] >= $sum){
                            $add_sum = ($sonfig_site["percent_swap"] > 0) ? ( ($sonfig_site["percent_swap"] / 100) * $sum) + $sum : $sum;
                            $ta = time();
                            $td = $ta + 60*60*24*15;
                            $db->Query("UPDATE db_users_b SET money_b = money_b + $add_sum, money_p = money_p - $sum WHERE id = '$usid'");
                            $db->Query("INSERT INTO db_swap_ser (user_id, user, amount_b, amount_p, date_add, date_del) VALUES ('$usid','$usname','$add_sum','$sum','$ta','$td')");
                            echo "<div class='alert alert-success'>{$lang['swap']['success']}</div>";
                        }else echo "<div class='alert alert-danger'>{$lang['swap']['errorBalance']}</div>";
                    }else echo "<div class='alert alert-danger'>{$lang['swap']['errorMin']} {$minValue} {$config->settings['coins']}</div>";
                }
                ?>
                <form action="" method="post">
                    <input type="hidden" name="per" id="percent" value="<?php echo $sonfig_site["percent_swap"]; ?>" disabled="disabled"/>
                    <div class="form-group">
                        <label><?php echo $lang['swap']['give'];?> [<?php echo $lang['common']['min'];?> <?php echo $minValue;?>]</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="sum" id="sum" value="<?php echo $minValue;?>" onkeyup="GetSumPer();"/>
                            <span class="input-group-text"><i class="fa fa-money"></i></span>
                        </div>
                    </div>
                    <p><?php echo $lang['swap']['receive'];?> [+<?php echo $sonfig_site["percent_swap"]; ?>%]</p>
                    <p><span id="res_sum" name="res">0.00</span></p>
                    <button type="submit" name="swap" class="btn btn-primary"><?php echo $lang['btn']['exchange'];?></button>
                </form>
            </div>
        </div>
    </div>
</section>