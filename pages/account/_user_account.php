<?PHP
$_OPTIMIZATION["title"] = $lang['account']['title'];
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>
<section class="no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header"><h4><?php echo $lang['account']['statistics'];?></h4></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong><?php echo $lang["common"]['p_balance']; ?></strong> <span class="pull-right"><?php echo $func->priceFormat($prof_data["money_b"]); ?></span></li>
                            <li class="list-group-item"><strong><?php echo $lang["common"]['w_balance']; ?></strong> <span class="pull-right"><?php echo $func->priceFormat($prof_data["money_p"]); ?></span></li>
                            <li class="list-group-item"><strong><?php echo $lang["common"]['ref_earnings']; ?></strong> <span class="pull-right"><?php echo $func->priceFormat($prof_data["from_referals"]); ?></span></li>
                            <li class="list-group-item"><strong><?php echo $lang["common"]['paid']; ?></strong> <span class="pull-right"><?php echo $func->priceFormat($prof_data["payment_sum"]); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header"><h4><?php echo $lang['account']['chart'];?></h4></div>
                    <div class="card-body">
                        <canvas id="pieChartAccount"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><h4><?php echo $lang['account']['details'];?></h4></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>#ID / <?php echo $lang["common"]['username']; ?></strong> <span class="pull-right"># <?php echo $prof_data["id"]; ?> / <?php echo $prof_data["user"]; ?></span></li>
                            <li class="list-group-item"><strong><?php echo $lang["common"]['email']; ?></strong> <span class="pull-right"><?php echo $prof_data["email"]; ?></span></li>
                            <li class="list-group-item"><strong><?php echo $lang["common"]['referrer']; ?></strong> <span class="pull-right"><?php echo $prof_data["referer"]; ?></span></li>
                            <li class="list-group-item"><strong><?php echo $lang["common"]['resgetedOn']; ?></strong> <span class="pull-right"><?php echo date("d.m.Y H:i:s",$prof_data["date_reg"]); ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>