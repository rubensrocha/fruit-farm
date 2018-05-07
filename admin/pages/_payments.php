<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header clearfix">
                <h4 class="pull-left"><?php echo $lang['payouts']['title']; ?></h4>
                <div class="pull-right">
                    <a href="<?php echo $func->urlAdmin('payments');?>" class="btn btn-info btn-sm"><?php echo $lang['payouts']['_paid'];?></a>
                    <a href="<?php echo $func->urlAdmin('payments/balance');?>" class="btn btn-success btn-sm"><?php echo $lang['payouts']['_balance'];?></a>
                    <a href="<?php echo $func->urlAdmin('payments/list_day');?>" class="btn btn-success btn-sm"><?php echo $lang['payouts']['_daily'];?></a>
                    <a href="<?php echo $func->urlAdmin('payments/last_31');?>" class="btn btn-success btn-sm"><?php echo $lang['payouts']['_month'];?></a>
                </div>
            </div>
            <div class="card-body">
    <?PHP
    # График
    if(isset($_GET["last_31"])){

        $dlim = time() - 60*60*24*30;
        $db->Query("SELECT * FROM db_payment WHERE date_add > $dlim ORDER BY id DESC");

        $days_money = array();
        $days_insert = array();

        if($db->NumRows() > 0){

            while($data = $db->FetchArray()){
            $index = date("d.m.Y", $data["date_add"]);

                $days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["sum"] : $data["sum"];
                $days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;

            }

        # Вывод
        if(count($days_money) > 0){

            $array_for_chart = array();
            $array_for_chart2 = array();
            $array_for_chart3 = array();

                foreach($days_money as $date => $sum){

                    $array_for_chart[] = "['".$date."', ".round($sum)."]";
                    $array_for_chart2[] = "['".$date."', ".$days_insert[$date]."]";
                    $array_for_chart3[] = "['".$date."', ".round($sum / $days_insert[$date], 2)."]";

                }

                $retd = implode(", ", array_reverse($array_for_chart));
                $retd2 = implode(", ", array_reverse($array_for_chart2));
                $retd3 = implode(", ", array_reverse($array_for_chart3));

            ?>

        <script type="text/javascript" src="https://www.google.com/jsapi"></script>
        <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['<?php echo $lang['common']['day'];?>', '<?php echo $lang['common']['qtd'];?>'],
              <?=$retd; ?>
            ]);

            var options = {
              title: '<?php echo $lang['payouts']['legend_graph1'];?>',
              hAxis: {title: '<?php echo $lang['payouts']['footer_graph1'];?>',  titleTextStyle: {color: 'green'}}
            };

            var chart = new google.visualization.SteppedAreaChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
        <div id="chart_div" style="width: 100%; height: 500px;"></div>

        <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart2);
          function drawChart2() {
            var data2 = google.visualization.arrayToDataTable([
              ['<?php echo $lang['common']['day'];?>', '<?php echo $lang['common']['count'];?>'],
              <?=$retd2; ?>
            ]);

            var options2 = {
              title: '<?php echo $lang['payouts']['legend_graph2'];?> (<?php echo $lang['common']['count'];?>)',
              hAxis: {title: '<?php echo $lang['payouts']['footer_graph2'];?>',  titleTextStyle: {color: 'green'}}
            };

            var chart2 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
          }
        </script>
        <div id="chart_div2" style="width: 100%; height: 500px;"></div>
        <script type="text/javascript">
          google.load("visualization", "1", {packages:["corechart"]});
          google.setOnLoadCallback(drawChart3);
          function drawChart3() {
            var data3 = google.visualization.arrayToDataTable([
              ['<?php echo $lang['common']['day'];?>', '<?php echo $lang['common']['qtd'];?>'],
              <?=$retd3; ?>
            ]);

            var options3 = {
              title: 'AVG (<?php echo $lang['common']['qtd'];?> / <?php echo $lang['common']['count'];?>)',
              hAxis: {title: '<?php echo $lang['payouts']['footer_graph3'];?>',  titleTextStyle: {color: 'green'}}
            };

            var chart3 = new google.visualization.SteppedAreaChart(document.getElementById('chart_div3'));
            chart3.draw(data3, options3);
          }
        </script>
        <div id="chart_div3" style="width: 100%; height: 500px;"></div>


            <?PHP

        }

        }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";
    ?>
            </div>
        </div>
    </div>
</section>
<?PHP
    return;
    }

    # Вывод статистики по дням
    if(isset($_GET["list_day"])){

        $db->Query("SELECT * FROM db_payment ORDER BY id DESC");
        $days_money = array();
        $days_insert = array();

        if($db->NumRows() > 0){
            while($data = $db->FetchArray()){
                $index = date("d.m.Y", $data["date_add"]);
                $days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["sum"] : $data["sum"];
                $days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;
            }

            # Вывод
            if(count($days_money) > 0){
        ?>
                <table class="table table-striped">
                    <thead class="text-center">
                        <th><?php echo $lang['common']['date'];?></th>
                        <th><?php echo $lang['payouts']['payments'];?></th>
                        <th><?php echo $lang['common']['amount'];?></th>
                        <th>AVG</th>
                    </thead>
                <?PHP
                    $array_for_chart = array();
                    foreach($days_money as $date => $sum){
                ?>
                        <tr class="text-center">
                            <td><?php echo $date; ?></td>
                            <td><?php echo $days_insert[$date]; ?></td>
                            <td><?php echo $func->priceFormat($sum);?></td>
                            <td><?php echo $func->priceFormat($sum/$days_insert[$date]);?></td>
                        </tr>
                        <?PHP
                    }
                ?>
                </table>
<?PHP
            }
        }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";
?>
            </div>
        </div>
    </div>
</section>
<?PHP
    return;
    }

    # Проверка баланса Payeer
    if(isset($_GET["balance"])){

    $payeer = new cPayeer($config->AccountNumber, $config->apiId, $config->apiKey);
        if ($payeer->isAuth())
        {

            $arBalance = $payeer->getBalance();
            echo "<div class=\"alert alert-success\">".print_r($arBalance, true)."</div>";

        }else{
            echo '<div class="alert alert-danger">'.$payeer->getErrors()[0].'</div>';
        }
?>
            </div>
        </div>
    </div>
</section>
<?PHP
    return;
    }
    $resultsMax = 20;
    $num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
    $lim = $num_p * $resultsMax;
    $db->Query("SELECT * FROM db_payment ORDER BY id DESC LIMIT {$lim}, $resultsMax");

    if($db->NumRows() > 0){
    ?>
    <table class="table table-striped">
        <thead class="text-center">
            <th><?php echo $lang['common']['username'];?></th>
            <th><?php echo $config->settings['coins']; ?></th>
            <th><?php echo $lang['common']['amount'];?></th>
            <th><?php echo $lang['common']['wallet'];?></th>
            <th><?php echo $lang['common']['date'];?></th>
        </thead>
        <?PHP
            while($data = $db->FetchArray()){
        ?>
            <tr class="text-center">
                <td><a href="/?menu=admin4ik&sel=users&edit=<?php echo $data["user"];?>"><?php echo $data["user"]; ?></a></td>
                <td><?php echo $data["serebro"]; ?></td>
                <td><span class="<?php echo ($data["sum"] >= 100) ? 'text-red text-bold' : ''; ?>"><?php echo $func->priceFormat($data["sum"]);?></span></td>
                <td><?php echo $data["purse"]; ?></td>
                <td><?php echo date("d.m H:i:s",$data["date_add"]); ?></td>
            </tr>
        <?PHP
            }
        ?>
    </table>
    <?PHP
    }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";

    $db->Query("SELECT COUNT(*) FROM db_payment");
    $all_pages = $db->FetchRow();

        if($all_pages > $resultsMax){
            $sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
            $nav = new Navigator;
            $page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
            echo $nav->Navigation($resultsMax, $page, ceil($all_pages / $resultsMax), "/admin/payments/");
        }
    ?>
            </div>
        </div>
    </div>
</section>