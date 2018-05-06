<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header clearfix">
                <h4><?php echo $lang['story_sell']['title']; ?></h4>
            </div>
            <div class="card-body">
                <?PHP
                $tdadd = time() - 5*60;
                    if(isset($_POST["clean"])){
                        $db->Query("DELETE FROM db_sell_items WHERE date_add < '$tdadd'");
                        echo "<div class='alert alert-success'>{$lang['success_messages']['cleaned']}</div>";
                    }
                $db->Query("SELECT * FROM db_sell_items ORDER BY id DESC");
                if($db->NumRows() > 0){
                ?>
                <table class="table table-striped">
                    <thead class="text-center">
                        <th># ID</th>
                        <th><?php echo $lang['common']['username']; ?></th>
                        <th><?php echo $lang['common']['sold']; ?></th>
                        <th><?php echo $lang['common']['received']; ?></th>
                        <th><?php echo $lang['common']['date']; ?></th>
                    </thead>
                <?PHP
                    while($data = $db->FetchArray()){
                    ?>
                    <tr class="text-center">
                        <td><?=$data["id"]; ?></td>
                        <td><?=$data["user"]; ?></td>
                        <td><?=$data["all_sell"]; ?></td>
                        <td><?=sprintf("%.2f",$data["amount"]); ?></td>
                        <td><?=date("d.m.Y в H:i:s",$data["date_add"]); ?></td>
                    </tr>
                    <?PHP
                    }
                ?>
                </table>
                <BR />
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