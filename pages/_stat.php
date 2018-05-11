<?PHP
$_OPTIMIZATION["title"] = $lang['statistics']['title'];
$tfstats = time() - 60*60*24;
$db->Query("SELECT 
(SELECT COUNT(*) FROM db_users_a) all_users,
(SELECT SUM(insert_sum) FROM db_users_b) all_insert, 
(SELECT SUM(payment_sum) FROM db_users_b) all_payment, 
(SELECT COUNT(*) FROM db_users_a WHERE date_reg > '$tfstats') new_users");
$stats_data = $db->FetchArray();
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h3 class="h4"><?php echo $lang['statistics']['subtitle']; ?></h3>
            </div>
            <div class="card-body text-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $lang['statistics']['totalUsers']; ?></h5>
                                    <p class="card-text"><?php echo $stats_data["all_users"]; ?> <?php echo $lang['common']['users']; ?></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $lang['statistics']['users24']; ?></h5>
                                    <p class="card-text"><?php echo $stats_data["new_users"]; ?> <?php echo $lang['common']['users']; ?></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $lang['statistics']['projectStart']; ?></h5>
                                    <p class="card-text"><?php echo intval(((time() - $config->SYSTEM_START_TIME) / 86400 ) +1); ?> <?php echo $lang['common']['days']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-deck">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $lang['statistics']['deposits']; ?></h5>
                                    <p class="card-text"><?php echo sprintf("%.2f",$stats_data["all_insert"]); ?> <?php echo $config->currency['symbol'];?></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $lang['statistics']['reserve']; ?></h5>
                                    <p class="card-text"><?php echo sprintf("%.2f",$stats_data["all_insert"]-$stats_data["all_payment"]); ?> <?php echo $config->currency['symbol'];?></p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $lang['statistics']['withdraws']; ?></h5>
                                    <p class="card-text"><?php echo sprintf("%.2f",$stats_data["all_payment"]); ?> <?php echo $config->currency['symbol'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
