<?PHP
$_OPTIMIZATION["title"] = $lang['referrals']['title'];
$user_id = (int)$_SESSION["user_id"];
$db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '$user_id'");
$refs = $db->FetchRow();
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?php echo sprintf($lang['referrals']['description'], $config->settings['coins'])?>
                <br /><br />
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-link"></i></span>
                    </div>
                    <input readonly class="form-control" value="<?php $func->url('?i='.$user_id);?>" onclick="$(this).select();" />
                </div>
                <br>
                <h4 class="text-center"><?php echo $lang['referrals']['refs_total'];?>: <?php echo $refs; ?></h4>
                <br>

                <table class="table table-striped">
                    <thead class="text-center">
                        <th><?php echo $lang['common']['username'];?></th>
                        <th><?php echo $lang['common']['resgetedOn'];?></th>
                        <th><?php echo $lang['referrals']['ref_revenue'];?></th>
                    </thead>
                    <?PHP
                    $all_money = 0;
                    $db->Query("SELECT db_users_a.user, db_users_a.date_reg, db_users_b.to_referer FROM db_users_a, db_users_b
                        WHERE db_users_a.id = db_users_b.id AND db_users_a.referer_id = '$user_id' ORDER BY to_referer DESC");
                    if($db->NumRows() > 0){
                        while($ref = $db->FetchArray()){
                    ?>
                            <tr class="text-center">
                                <td> <?php echo $ref["user"]; ?> </td>
                                <td> <?php echo date("d.m.Y в H:i:s",$ref["date_reg"]); ?> </td>
                                <td> <?php echo $func->priceFormat($ref["to_referer"]); ?> </td>
                            </tr>
                    <?PHP
                            $all_money += $ref["to_referer"];
                        }
                    }else echo "<tr><td class='text-center' colspan='3'>{$lang['referrals']['noreferrals']}</td></tr>";
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>
