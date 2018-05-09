<?PHP
$db->Query("SELECT COUNT(id) all_users,  SUM(money_b) money_b,  SUM(money_p) money_p,  SUM(a_t) a_t,  SUM(b_t) b_t,  SUM(c_t) c_t,  SUM(d_t) d_t,  SUM(e_t) e_t,  SUM(a_b) a_b,  SUM(b_b) b_b,  SUM(c_b) c_b,  SUM(d_b) d_b,  SUM(e_b) e_b,  SUM(all_time_a) all_time_a,  SUM(all_time_b) all_time_b,  SUM(all_time_c) all_time_c,  SUM(all_time_d) all_time_d,  SUM(all_time_e) all_time_e, SUM(payment_sum) payment_sum,  SUM(insert_sum) insert_sum, COUNT(insert_sum) as inserts, COUNT(payment_sum) as payouts FROM db_users_b");
$data_stats = $db->FetchArray();
$profit = ($data_stats['insert_sum']-$data_stats['payment_sum']);
$profitPercent = ($data_stats['payment_sum']*100)/$data_stats['insert_sum'];
?>
<section class="">
    <div class="container-fluid">
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-users"></i></div>
                    <div class="text"><strong><?=$data_stats["all_users"]; ?></strong><br>
                        <small><?php echo $lang['dashboard']['total_users']; ?></small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-info"><i class="fa fa-shopping-bag"></i></div>
                    <div class="text"><strong><?=sprintf("%.0f",$data_stats["money_b"]); ?></strong><br>
                        <small><?php echo $lang['common']['total']; ?> <?php echo $config->settings['coins']; ?> (<?php echo $lang['common']['p_balance']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-green"><i class="fa fa-money"></i></div>
                    <div class="text"><strong><?=sprintf("%.0f",$data_stats["money_p"]); ?></strong><br>
                        <small><?php echo $lang['common']['total']; ?> <?php echo $config->settings['coins']; ?> (<?php echo $lang['common']['w_balance']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <br>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-6">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-success"><i class="fa fa-arrow-circle-down"></i></div>
                    <div class="text"><strong><?=$func->priceFormat($data_stats["insert_sum"]); ?></strong><br>
                        <small><?php echo $lang['common']['deposits']; ?></small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-6">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-danger"><i class="fa fa-arrow-circle-up"></i></div>
                    <div class="text"><strong><?=$func->priceFormat($data_stats["payment_sum"]); ?></strong><br>
                        <small><?php echo $lang['common']['withdraws']; ?></small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <br>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-12">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-money"></i></div>
                    <div class="text"><strong><?=$func->priceFormat($profit); ?></strong><br>
                        <small><?php echo $lang['dashboard']['profit']; ?></small>
                        <div class="progress" data-toggle="tooltip" title="<?=sprintf("%.2f",$profitPercent);?>%">
                            <div role="progressbar" style="width: <?=sprintf("%.2f",$profitPercent);?>%; height: 4px;" aria-valuenow="<?=sprintf("%.2f",$profitPercent);?>" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-danger"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <br>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-industry"></i></div>
                    <div class="text"><strong><?=intval($data_stats["a_t"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['bought']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item1']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-industry"></i></div>
                    <div class="text"><strong><?=intval($data_stats["b_t"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['bought']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item2']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-industry"></i></div>
                    <div class="text"><strong><?=intval($data_stats["c_t"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['bought']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item3']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-industry"></i></div>
                    <div class="text"><strong><?=intval($data_stats["d_t"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['bought']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item4']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-industry"></i></div>
                    <div class="text"><strong><?=intval($data_stats["e_t"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['bought']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item5']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-warning"><i class="fa fa-industry"></i></div>
                    <div class="text"><strong><?=intval($data_stats["f_t"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['bought']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item6']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <br>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-bank"></i></div>
                    <div class="text"><strong><?=intval($data_stats["a_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['warehouses']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item1']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-bank"></i></div>
                    <div class="text"><strong><?=intval($data_stats["b_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['warehouses']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item2']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-bank"></i></div>
                    <div class="text"><strong><?=intval($data_stats["c_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['warehouses']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item3']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-bank"></i></div>
                    <div class="text"><strong><?=intval($data_stats["d_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['warehouses']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item4']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-bank"></i></div>
                    <div class="text"><strong><?=intval($data_stats["e_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['warehouses']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item5']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-primary"><i class="fa fa-bank"></i></div>
                    <div class="text"><strong><?=intval($data_stats["f_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['warehouses']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item6']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <br>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-database"></i></div>
                    <div class="text"><strong><?=intval($data_stats["all_time_a"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['collected']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item1']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-database"></i></div>
                    <div class="text"><strong><?=intval($data_stats["all_time_b"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['collected']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item2']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-database"></i></div>
                    <div class="text"><strong><?=intval($data_stats["all_time_c"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['collected']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item3']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
        <div class="row">
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-database"></i></div>
                    <div class="text"><strong><?=intval($data_stats["all_time_d"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['collected']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item4']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-database"></i></div>
                    <div class="text"><strong><?=intval($data_stats["all_time_e"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['collected']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item5']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
            <!-- Item -->
            <div class="statistics col-sm-4">
                <div class="statistic d-flex align-items-center bg-white has-shadow">
                    <div class="icon bg-secondary"><i class="fa fa-database"></i></div>
                    <div class="text"><strong><?=intval($data_stats["all_time_f"]); ?></strong><br>
                        <small><?php echo $lang['dashboard']['collected']; ?> <?php echo $config->items['names']; ?> (<?php echo $config->items['item6']; ?>)</small></div>
                </div>
            </div>
            <!-- /Item -->
        </div>
    </div>
</section>