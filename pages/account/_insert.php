<?PHP
$_OPTIMIZATION["title"] = $lang['insert']['title'];
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
$minDeposit = 1;
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <p><?php echo sprintf($lang['insert']['text'],$config->settings['coins']);?></p>
                <p><?php echo $lang['common']['conversionRate'];?>:
                    <span class="text-danger">
                        1 RUB = <?php echo $sonfig_site["ser_per_wmr"];?> <?php echo $config->settings['coins'];?> |
                        1 USD = <?php echo $sonfig_site["ser_per_wmz"];?> <?php echo $config->settings['coins'];?> |
                        1 EUR = <?php echo $sonfig_site["ser_per_wme"];?> <?php echo $config->settings['coins'];?>
                    </span></p>
                <?php
                /// db_payeer_insert
                if(isset($_POST["sum"])){
                    $sum = round(floatval($_POST["sum"]),2);
                    if($sum >= $minDeposit){
                        # Заносим в БД
                        $db->Query("INSERT INTO db_payeer_insert (user_id, user, sum, date_add,description) VALUES ('".$_SESSION["user_id"]."','".$_SESSION["user"]."','$sum','".time()."','Payeer')");
                        $desc = base64_encode("Deposit on ".$_SERVER["HTTP_HOST"]." of Username ".$_SESSION["user"]);
                        $m_shop = $config->shopID;
                        $m_orderid = $db->LastInsert();
                        $m_amount = number_format($sum, 2, ".", "");
                        $m_curr = "RUB";
                        $m_desc = $desc;
                        $m_key = $config->secretW;
                        $arHash = array(
                            $m_shop,
                            $m_orderid,
                            $m_amount,
                            $m_curr,
                            $m_desc,
                            $m_key
                        );
                        $sign = strtoupper(hash('sha256', implode(":", $arHash)));
                        ?>
                        <form method="POST" action="//payeer.com/api/merchant/m.php">
                            <input type="hidden" name="m_shop" value="<?php echo $config->shopID; ?>">
                            <input type="hidden" name="m_orderid" value="<?php echo $m_orderid; ?>">
                            <input type="hidden" name="m_amount" value="<?php echo number_format($sum, 2, ".", "")?>">
                            <input type="hidden" name="m_curr" value="RUB">
                            <input type="hidden" name="m_desc" value="<?php echo $desc; ?>">
                            <input type="hidden" name="m_sign" value="<?php echo $sign; ?>">
                            <input type="submit" name="m_process" class="btn btn-primary" value="<?php echo $lang['btn']['payNow'];?>" />
                        </form>
            </div>
        </div>
    </div>
</section>
                        <?PHP
                        return;
                    }else echo '<div class="alert alert-danger">'.$lang['insert']['errorMin'].' '.$minDeposit.' '.$config->currency['symbol'].'</div>';
                }
                ?>
            </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4">Payeer</h3>
                </div>
                <div class="card-body text-center">
                    <p><img src="/img/payeer.png" width="150"></p>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label><?php echo $lang['common']['amount'];?></label>
                            <div class="input-group">
                                <input type="number" value="1" name="sum" size="7" id="psevdo" class="form-control">
                                <span class="input-group-text"><?php echo $config->currency['symbol'];?></span>
                            </div>
                        </div>
                        <p><?php echo $lang['insert']['receive'];?>: <span id="res_sum"><?php echo $sonfig_site["ser_per_wmr"];?></span> <?php echo $config->settings['coins'];?></p>
                        <button type="submit" id="submit" class="btn btn-primary"><?php echo $lang['btn']['deposit'];?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>