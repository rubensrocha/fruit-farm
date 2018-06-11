<?PHP
$_OPTIMIZATION["title"] = $lang['bonus_daily']['title'];
$usid = (int)$_SESSION["user_id"];
$uname = $_SESSION["user"];
# Bonus settings
$bonus_min = 0.1;
$bonus_max = 1;
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h3><?php echo $lang['bonus_daily']['desc'];?></h3>
                <ul class="list-unstyled">
                    <li><?php echo $lang['bonus_daily']['rule1'];?></li>
                    <li><?php echo $lang['bonus_daily']['rule2'];?></li>
                    <li><?php echo sprintf($lang['bonus_daily']['rule3'],$bonus_min,$bonus_max,$config->currency['symbol']);?></li>
                </ul>
                <?PHP
                $ddel = time() + 60*60*24;
                $dadd = time();
                $db->Query("SELECT COUNT(*) FROM db_bonus_list WHERE user_id = '$usid' AND date_del > '$dadd'");
                $hide_form = false;
                if($db->FetchRow() == 0){
                    # Выдача бонуса
                    if(isset($_POST["bonus"])){
                        $sum = mt_rand($bonus_min*10,mt_rand($bonus_min*10,$bonus_max*10))/10;
                        # Credit bonus
                        $db->Query("UPDATE db_users_b SET money_b = money_b + '$sum' WHERE id = '$usid'");
                        # Insert bonus on history
                        $db->Query("INSERT INTO db_bonus_list (user, user_id, sum, date_add, date_del) VALUES ('$uname','$usid','$sum','$dadd','$ddel')");
                        # Cleaning of obsolete records
                        $db->Query("DELETE FROM db_bonus_list WHERE date_del < '$dadd'");
                        echo "<div class='alert alert-success'>".sprintf($lang['success_messages']['bonusAdded'],$sum,$config->currency['symbol'])."</div>";
                        $hide_form = true;
                    }
                    # Показывать или нет форму
                    if(!$hide_form){
                ?>
                        <div class="row">
                            <div class="col-sm-2 offset-5">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <button type="submit" name="bonus" class="btn btn-primary"><i class="fa fa-gift"></i> <?php echo $lang['btn']['getBonus'];?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                <?PHP
                    }
                }else {
                    $db->Query("SELECT date_del FROM db_bonus_list WHERE user_id = '$usid' ORDER BY id ASC LIMIT 1");
                    $time = $db->FetchRow();
                    $start = new DateTime(date('Y-m-d H:i:s'));
                    $end = new DateTime(date('Y-m-d H:i:s',$time));
                    $diff  = $start->diff($end);
                    echo "<div class='alert alert-danger text-center'>{$lang['error_messages']['bonusCollected']} <br><i class='fa fa-clock-o'></i> {$lang['bonus_daily']['leftTime']}<span class='countdown'>{$diff->format('%h:%I:%S')}</span></div>";
                    echo "";
                } ?>
                <h2 class="text-center"><?= $lang['bonus_daily']['last_20'] ?></h2>
                <table class="table table-striped">
                    <thead class="text-center">
                        <th>ID</th>
                        <th><?= $lang['common']['username'] ?></th>
                        <th><?= $lang['common']['amount'] ?></th>
                        <th><?= $lang['common']['date'] ?></th>
                    </thead>
                    <?PHP
                    $db->Query("SELECT * FROM db_bonus_list ORDER BY id DESC LIMIT 20");
                    if($db->NumRows() > 0){
                        while($bon = $db->FetchArray()){
                            ?>
                            <tr class="text-center">
                                <td><?php echo $bon["id"]; ?></td>
                                <td><?php echo $bon["user"]; ?></td>
                                <td><?php echo $func->priceFormat($bon["sum"]); ?></td>
                                <td><?php echo date("d.m.Y",$bon["date_add"]); ?></td>
                            </tr>
                            <?PHP
                        }
                    }else echo '<tr><td class="text-center" colspan="4">'. $lang['bonus_daily']['no_rec'] .'</td></tr>';
                ?>
                </table>
            </div>
        </div>
    </div>
</section>
