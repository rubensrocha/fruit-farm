                <!-- Page Footer-->
                <footer class="main-footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>&copy; <?php echo $config->settings['sitename']; ?> <?php echo date('Y');?>. <?php echo $lang['common']['copyright'];?></p>
                            </div>
                            <div class="col-sm-6 text-right">
                                <p><a href="https://github.com/rubensrocha/fruit-farm" target="_blank" class="external"><?php echo $config->scriptName; ?></a></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div><!-- content-inner -->
        </div><!-- page-content -->
    </div><!-- page -->
    <!-- JavaScript files-->
    <script src="<?php $func->url('vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php $func->url('vendor/popper.js/umd/popper.min.js');?>"></script>
    <script src="<?php $func->url('vendor/bootstrap/js/bootstrap.min.js');?>"></script>
    <script src="<?php $func->url('vendor/jquery.cookie/jquery.cookie.js');?>"></script>
    <script src="<?php $func->url('vendor/chart.js/Chart.min.js');?>"></script>
    <script src="<?php $func->url('vendor/jquery-validation/jquery.validate.min.js');?>"></script>
    <!-- Main File-->
    <script src="<?php $func->url('js/front.js');?>"></script>
    <script src="<?php $func->url('js/functions.js');?>"></script>
    <!-- Custom Scripts -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            <?PHP if($_SESSION["user"] && $_SERVER['REQUEST_URI']=='/account') { ?>
            //Pie Chart Account
            var PIECHARTEXMPLE    = $('#pieChartAccount');
            var pieChartExample = new Chart(PIECHARTEXMPLE, {
                type: 'pie',
                data: {
                    labels: [
                        "<?php echo $lang["common"]['withdraws']; ?>",
                        "<?php echo $lang["common"]['deposits']; ?>",
                        "<?php echo $lang["common"]['referrals']; ?>"
                    ],
                    datasets: [
                        {
                            data: [<?php echo $func->price($prof_data['payment_sum']); ?>, <?php echo $func->price($prof_data['insert_sum']); ?>, <?php echo $func->price($prof_data['from_referals']); ?>],
                            borderWidth: 0,
                            backgroundColor: [
                                '#2eff74',
                                "#2d9de6",
                                "#f2d214"
                            ],
                            hoverBackgroundColor: [
                                '#25a452',
                                "#1a55e6",
                                "#ef961a"
                            ]
                        }]
                }
            });
            var pieChartExample = {
                responsive: true
            };
            <?php } ?>
            <?PHP if($_SESSION["user"] && $_SERVER['REQUEST_URI']=='/account/bonus') { ?>
            //Timer for Bonus
            setInterval(function(){
                $('.countdown').each(function(){
                    var time=$(this).text().split(':');
                    var timestamp=time[0]*3600+ time[1]*60+ time[2]*1;timestamp-=timestamp>0;
                    var hours=Math.floor(timestamp/3600);
                    var minutes=Math.floor((timestamp- hours*3600)/ 60);
                    var seconds=timestamp- hours*3600- minutes*60;if(hours<10){hours='0'+ hours;}

                    if(minutes<10){minutes='0'+ minutes;}
                    if(seconds<10){seconds='0'+ seconds;}
                    if(timestamp>0){
                        $(this).text(hours+':'+ minutes+':'+ seconds);
                    }else{
                        location.reload();
                    }
                });
            },1000);
            <?php } ?>
            <?PHP if($_SESSION["user"] && $_SERVER['REQUEST_URI']=='/account/store') { ?>
            //Instant counter production
            var now1=<?php echo $item1;?>;
            var vel1=<?php echo $veloc1;?>;
            var now2=<?php echo $item2;?>;
            var vel2=<?php echo $veloc2;?>;
            var now3=<?php echo $item3;?>;
            var vel3=<?php echo $veloc3;?>;
            var now4=<?php echo $item4;?>;
            var vel4=<?php echo $veloc4;?>;
            var now5=<?php echo $item5;?>;
            var vel5=<?php echo $veloc5;?>;
            var now6=<?php echo $item6;?>;
            var vel6=<?php echo $veloc6;?>;
            setInterval(function() {
                    now1=now1+vel1;
                    now2=now2+vel2;
                    now3=now3+vel3;
                    now4=now4+vel4;
                    now5=now5+vel5;
                    now6=now6+vel6;
                    $("#counter1").text(now1.toFixed(2));
                    $("#counter2").text(now2.toFixed(2));
                    $("#counter3").text(now3.toFixed(2));
                    $("#counter4").text(now4.toFixed(2));
                    $("#counter5").text(now5.toFixed(2));
                    $("#counter6").text(now6.toFixed(2));
                }, 1000);
            //End instant counter production
            <?php } ?>
        });
    </script>
</body>
</html>