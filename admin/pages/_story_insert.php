<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header clearfix">
                <h4 class="pull-left"><?php echo $lang['story_insert']['title']; ?></h4>
                <div class="pull-right">
                    <a href="<?php echo $func->urlAdmin('story_insert');?>" class="btn btn-info btn-sm"><?php echo $lang['story_insert']['_list'];?></a>
                    <a href="<?php echo $func->urlAdmin('story_insert/day');?>" class="btn btn-success btn-sm"><?php echo $lang['story_insert']['_daily'];?></a>
                    <a href="<?php echo $func->urlAdmin('story_insert/month');?>" class="btn btn-success btn-sm"><?php echo $lang['story_insert']['_month'];?></a>
                </div>
            </div>
            <div class="card-body">
                <?PHP
                # График
                if(isset($_GET["month"])){
                    $dlim = time() - 60*60*24*30;
                    $db->Query("SELECT * FROM db_insert_money WHERE date_add > $dlim ORDER BY id DESC");
                    $days_money = array();
                    $days_insert = array();
                    if($db->NumRows() > 0){
                        while($data = $db->FetchArray()){
                        $index = date("d.m.Y", $data["date_add"]);
                            $days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
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
                          title: '<?php echo $lang['story_insert']['legend_graph1'];?>',
                          hAxis: {title: 'Last 30 Days',  titleTextStyle: {color: 'green'}}
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
                          title: '<?php echo $lang['story_insert']['legend_graph2'];?>',
                          hAxis: {title: '<?php echo $lang['story_insert']['footer_graph2'];?>',  titleTextStyle: {color: 'green'}}
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
                          hAxis: {title: '<?php echo $lang['story_insert']['footer_graph3'];?>',  titleTextStyle: {color: 'green'}}
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
                if(isset($_GET["day"])){
                    $db->Query("SELECT * FROM db_insert_money ORDER BY id DESC");
                    $days_money = array();
                    $days_insert = array();

                    if($db->NumRows() > 0){

                        while($data = $db->FetchArray()){
                        $index = date("d.m.Y", $data["date_add"]);

                            $days_money[$index] = (isset($days_money[$index])) ? $days_money[$index] + $data["money"] : $data["money"];
                            $days_insert[$index] = (isset($days_insert[$index])) ? $days_insert[$index] + 1 : 1;

                        }

                        # Вывод
                        if(count($days_money) > 0){

                            ?>
                            <table class="table table-striped">
                              <thead class="text-center">
                                <th><?php echo $lang['common']['date']; ?></th>
                                <th><?php echo $lang['story_insert']['deposits']; ?></th>
                                <th><?php echo $lang['common']['amount']; ?></th>
                                <th>AVG</th>
                              </thead>
                        <?PHP
                            $array_for_chart = array();
                            foreach($days_money as $date => $sum){
                        ?>
                                    <tr class="text-center">
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $days_insert[$date]; ?></td>
                                        <td><?php echo $func->priceFormat($sum); ?></td>
                                        <td><?php echo $func->priceFormat($sum/$days_insert[$date]); ?></td>
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

                $tdadd = time() - 5*60;
                    if(isset($_POST["clean"])){

                        $db->Query("DELETE FROM db_insert_money WHERE date_add < '$tdadd'");
                        echo "<div class='alert alert-success'>{$lang['success_messages']['cleaned']}</div>";
                    }

                $db->Query("SELECT * FROM db_insert_money ORDER BY id DESC");

                if($db->NumRows() > 0){

                ?>
                <table class="table table-striped">
                  <thead class="text-center">
                    <th># ID</th>
                    <th><?php echo $lang['common']['username']; ?></th>
                    <th><?php echo $lang['common']['amount']; ?></th>
                    <th>Silver</th>
                    <th><?php echo $lang['common']['date']; ?></th>
                  </thead>
                <?PHP
                    while($data = $db->FetchArray()){
                ?>
                    <tr class="text-center">
                        <td><?php echo $data["id"]; ?></td>
                        <td><?php echo $data["user"]; ?></td>
                        <td><?php echo $func->priceFormat($data["money"]); ?></td>
                        <td><?php echo $data["serebro"]; ?></td>
                        <td><?php echo date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
                    </tr>
                <?PHP
                    }
                ?>
                </table>

                <form action="" method="post" onSubmit="return confirm('<?php echo $lang['common']['confirmdelete'];?>')">
                    <button type="submit" name="clean" class="btn btn-danger" /><?php echo $lang['btn']['clear']; ?></button>
                </form>
                <?PHP
                }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";
                ?>
            </div>
        </div>
    </div>
</section>