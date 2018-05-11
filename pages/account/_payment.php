<?PHP
$_OPTIMIZATION["title"] = $lang['payment']['title'];
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
$status_array = array( 0 => "Checked", 1 => "Выплачивается", 2 => "Canceled", 3 => "Paid");
# Минималка серебром!
$minPay = $sonfig_site['min_pay']; 
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <p>Payments are made automatically and only on the payment system <a href="https://payeer.com/" target="_blank">Payeer</a>. The percentage of withdrawal is 0%.</p>
                <?PHP
                    function ViewPurse($purse){
                        if( substr($purse,0,1) != "P" ) return false;
                        if( !preg_match("/^[0-9]{7,8}$/", substr($purse,1)) ) return false;
                        return $purse;
                    }
                    # Заносим выплату
                    if(isset($_POST["purse"])){
                        $purse = ViewPurse($_POST["purse"]);
                        $sum = intval($_POST["sum"]);
                        $val = "RUB";
                        if($purse !== false){
                            if($sum >= $minPay){
                                if($sum <= $user_data["money_p"]){
                                    # Проверяем на существующие заявки
                                    $db->Query("SELECT COUNT(*) FROM db_payment WHERE user_id = '$usid' AND (status = '0' OR status = '1')");
                                    if($db->FetchRow() == 0){
                                        ### Делаем выплату ###
                                        $payeer = new cPayeer($config->AccountNumber, $config->apiId, $config->apiKey);
                                        if ($payeer->isAuth())
                                        {
                                            $arBalance = $payeer->getBalance();
                                            if($arBalance["auth_error"] == 0)
                                            {
                                                $sum_pay = round( ($sum / $sonfig_site["ser_per_wmr"]), 2);
                                                $balance = $arBalance["balance"]["RUB"]["DOSTUPNO"];
                                                if($balance >= $sum_pay){
                                                    $arTransfer = $payeer->transfer(array(
                                                    'curIn' => 'RUB', // счет списания
                                                    'sum' => $sum_pay, // сумма получения
                                                    'curOut' => 'RUB', // валюта получения
                                                    'to' => $purse, // получатель (email)
                                                    'comment' => iconv('windows-1251', 'utf-8', "Payment to the user {$usname} from the project ".$_SERVER["HTTP_HOST"])
                                                    ));
                                                    if (!empty($arTransfer["historyId"]))
                                                    {
                                                        # Снимаем с пользователя
                                                        $db->Query("UPDATE db_users_b SET money_p = money_p - '$sum' WHERE id = '$usid'");
                                                        # Вставляем запись в выплаты
                                                        $da = time();
                                                        $dd = $da + 60*60*24*15;
                                                        $ppid = $arTransfer["historyId"];
                                                        $db->Query("INSERT INTO db_payment (user, user_id, purse, sum, valuta, serebro, payment_id, date_add, status) VALUES ('$usname','$usid','$purse','$sum_pay','RUB', '$sum','$ppid','".time()."', '3')");
                                                        $db->Query("UPDATE db_users_b SET payment_sum = payment_sum + '$sum_pay' WHERE id = '$usid'");
                                                        $db->Query("UPDATE db_stats SET all_payments = all_payments + '$sum_pay' WHERE id = '1'");
                                                        echo "<div class='alert alert-success'>{$lang['payment']['success']}</div>";
                                                    }
                                                    else
                                                    {
                                                        echo "<div class='alert alert-danger'>{$lang['payment']['errorUnkdown']}</div>";
                                                    }
                                                }else echo "<div class='alert alert-danger'>{$lang['payment']['error629']}</div>";
                                            }else echo "<div class='alert alert-danger'>{$lang['payment']['error630']}</div>";
                                        }else echo "<div class='alert alert-danger'>{$lang['payment']['error631']}</div>";
                                    }else echo "<div class='alert alert-danger'>{$lang['payment']['errorWait']}</div>";
                                }else echo "<div class='alert alert-danger'>{$lang['payment']['errorMax']}</div>";
                            }else $errorMsg = sprintf($lang['payment']['errorMin'],$minPay,$config->settings['coins']); echo "<div class='alert alert-danger'>{$errorMsg}</div>";
                        }else echo "<div class='alert alert-danger'>{$lang['payment']['errorWallet']}</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<section class="no-padding-top">
    <div class="col-sm-6 offset-3">
        <div class="card">
            <div class="card-header text-center">
                <h4><?php echo $lang['payment']['title'];?></h4>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label><?php echo $lang["common"]['wallet']; ?></label>
                        <input type="text" name="purse" size="15" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang["payment"]['give']; ?> [<?php echo $lang["common"]['min']; ?> <?php echo $minPay;?>] <?php echo $config->settings['coins'];?></label>
                        <input type="text" class="form-control" name="sum" id="sum" value="<?php echo round($user_data["money_p"]); ?>" size="15" onkeyup="PaymentSum();" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang["payment"]['receive']; ?> <span id="res_val"></span></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="res" id="res_sum" value="0" size="15" readonly/>
                            <div class="input-group-text"><?php echo $config->currency['symbol'];?></div>
                        </div>
                    </div>
                    <input type="hidden" name="per" id="RUB" value="<?php echo $sonfig_site["ser_per_wmr"]; ?>" disabled="disabled"/>
                    <input type="hidden" name="per" id="min_sum_RUB" value="0.5" disabled="disabled"/>
                    <input type="hidden" name="val_type" id="val_type" value="RUB" />
                    <button type="submit" name="swap" class="btn btn-primary"><?php echo $lang["btn"]['withdraw']; ?></button>
                    </tr>
                </form>
                <script language="javascript">PaymentSum(); SetVal();</script>
            </div>
        </div>
    </div>
</section>
<section class="no-padding-top">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header text-center">
                <h4><?php echo $lang["payment"]['latests']; ?></h4>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="text-center">
                        <th><?php echo $lang["payment"]['give']; ?></th>
                        <th><?php echo $lang["payment"]['receive']; ?></th>
                        <th><?php echo $lang["common"]['wallet']; ?></th>
                        <th><?php echo $lang["common"]['date']; ?></th>
                        <th><?php echo $lang["common"]['status']; ?></th>
                    </thead>
                    <?PHP
                    $db->Query("SELECT * FROM db_payment WHERE user_id = '$usid' ORDER BY id DESC LIMIT 20");
                    if($db->NumRows() > 0){
                        while($ref = $db->FetchArray()){
                            ?>
                            <tr class="htt">
                                <td align="center"><?php echo $ref["serebro"]; ?></td>
                                <td align="center"><?php echo sprintf("%.2f",$ref["sum"] - $ref["comission"]); ?> <?php echo $ref["valuta"]; ?></td>
                                <td align="center"><?php echo $ref["purse"]; ?></td>
                                <td align="center"><?php echo date("d.m.Y",$ref["date_add"]); ?></td>
                                <td align="center"><?php echo $status_array[$ref["status"]]; ?></td>
                            </tr>
                            <?PHP
                        }
                    }else echo '<tr><td align="center" colspan="5">'.$lang["error_messages"]['noresults'].'</td></tr>'
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>