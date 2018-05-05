<?PHP
$_OPTIMIZATION["title"] = $lang['payments']['title'];
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center"><?php echo $lang['payments']['subtitle'];?></h4>
                <br>
                <table class="table table-striped">
                    <thead class="text-center">
                        <th><?php echo $lang['common']['username'];?></th>
                        <th><?php echo $lang['common']['amount'];?></th>
                        <th><?php echo $lang['common']['wallet'];?></th>
                        <th><?php echo $lang['common']['date'];?></th>
                    </thead>
                    <?PHP
                    $dt = time() - 60*60*48;
                    $db->Query("SELECT * FROM db_payment WHERE status = '3' AND date_add > '$dt' LIMIT 20");
                    if($db->NumRows() > 0){
                        $all_pay = 0;
                        $all_pay_sum = 0;
                        while($data = $db->FetchArray()){
                            $all_pay ++;
                            $all_pay_sum += $data["sum"];
                            ?>
                            <tr class="text-center">
                                <td><?php echo $data["user"]; ?></td>
                                <td><?php echo $func->priceFormat($data["sum"]); ?></td>
                                <td><?php echo substr($data["purse"],0,-4); ?><span class='text-blue'>XXX</span></td>
                                <td><?php echo date("d.m.Y H:i:s",$data["date_add"]); ?></td>
                            </tr>
                    <?PHP
                        }
                    ?>
                            <tfoot>
                                <tr>
                                    <td class="text-center" colspan='2'><b><?php echo $lang['payments']['count'];?>:</b> <?php echo $all_pay; ?></td>
                                    <td class="text-center" colspan='2'><b><?php echo $lang['payments']['total'];?>:</b> <?php echo $func->priceFormat($all_pay_sum); ?></td>
                                </tr>
                            </tfoot>
                    <?PHP
                }else echo "<tr><td class='text-center' colspan='4'>{$lang['error_messages']['noresults']}</td></tr>";
                ?>
                </table>
            </div>
        </div>
    </div>
</section>