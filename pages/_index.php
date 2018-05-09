<?php
$_OPTIMIZATION["title"] = $lang['home']['title'];
$db->Query("SELECT COUNT(id) all_users, SUM(payment_sum) payment_sum FROM db_users_b");
$site_stats = $db->FetchArray();
?>
<section class="no-padding-bottom">
    <div class="col-lg-12 text-center">
        <div class="card">
            <div class="card-body">
                <label class="form-control-label">Welcome! We suggest you play our exciting game to raise your budget!</label><br>
                <label class="form-control-label">We have no restrictions on payment. Earned and won money can be immediately displayed on your wallet <span class="text-info">PAYEER</span>.</label><br>
                <div class="row">
                    <div class="col-md-4"><img class="pull-right" src="/img/logo.png" style="width: 230px;margin-top: 15px;">
                    </div>
                    <div class="col-md-8">
                        <div class="media">
                            <div class="pull-left" style="margin-right: 30px;">
                                <span class="grow"><img class="media-object" src="/img/game.png" alt="1" style="width: 70px;margin-top: 15px;margin-left: 15px;"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading text-info" style="margin: 10px 0;">How to start playing?</h3>
                                Buy cars and earn a stable income!
                            </div>
                        </div>

                        <div class="media">
                            <div class="pull-left" style="margin-right: 30px;">
                                <span class="grow"><img class="media-object" src="/img/aff.png" alt="2" style="width: 70px;margin-top: 15px;margin-left: 15px;"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading text-info" style="margin: 10px 0;">Affiliate Program</h3>
                                1-level affiliate program up to 15% on withdrawal!
                            </div>
                        </div>

                        <div class="media">
                            <div class="pull-left" style="margin-right: 30px;">
                                <span class="grow"><img class="media-object" src="/img/favicon.ico" alt="3" style="width: 70px;margin-top: 15px;margin-left: 15px;"></span>
                            </div>
                            <div class="media-body">
                                <h3 class="media-heading text-info" style="margin: 10px 0;">Games</h3>
                                Play our exciting games and get paid!
                            </div>
                        </div>

                    </div>
                </div>
                <?PHP if(!$_SESSION["user"]) { ?>
                <br>
                <a href="<?php $func->url('signup');?>" class="btn btn-primary">Register and get a bonus!</a>
                <?PHP } ?>
            </div>
        </div>
    </div>
</section>

<section class="no-padding-top">
    <div class="col-lg-12">
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-users"></i></div>
                    <div class="text"><strong><?php echo $site_stats["all_users"]; ?></strong><br>
                        <small><?php echo $lang['home']['total_users']; ?></small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-info"><i class="fa fa-clock-o"></i></div>
                    <div class="text">
                        <strong><?php echo intval(((time() - $config->SYSTEM_START_TIME) / 86400 )+1); ?></strong> <?php echo $lang['common']['days']; ?><br>
                        <small><?php echo $lang['home']['working_time']; ?></small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-money"></i></div>
                    <div class="text"><strong><?php echo $func->priceFormat($site_stats["payment_sum"]); ?></strong><br>
                        <small><?php echo $lang['home']['total_paid']; ?></small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
    </div>
</section>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h3 class="h4"><?php echo $lang['payments']['title'];?></h3>
                </div>
                <div class="card-body">
                    <?PHP
                    $dt = time() - 60*60*48;
                    $db->Query("SELECT * FROM db_payment WHERE status = '3' AND date_add > '$dt' ORDER BY id DESC LIMIT 20");
                    if($db->NumRows() > 0){
                        $all_pay = 0;
                        $all_pay_sum = 0;
                    ?>
                    <table class="table">
                        <thead>
                            <th><?php echo $lang['common']['username'];?></th>
                            <th><?php echo $lang['common']['amount'];?></th>
                            <th><?php echo $lang['common']['status'];?></th>
                            <th><?php echo $lang['common']['date'];?></th>
                        </thead>
                        <tbody>
                        <?PHP
                        while($data = $db->FetchArray()){
                            $all_pay ++;
                            $all_pay_sum += $data["sum"];
                        ?>
                        <tr>
                            <td><?php echo $data["user"]; ?></td>
                            <td><?php echo $func->priceFormat($data["sum"]); ?></td>
                            <td><span class="text-success"><?php echo $lang['common']['status_paid'];?></span></td>
                            <td><?php echo date("d.m.Y H:i:s",$data["date_add"]); ?></td>
                        </tr>
                        <?PHP
                        }
                    }else echo "<center>{$lang['error_messages']['noresults']}</center>";
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>