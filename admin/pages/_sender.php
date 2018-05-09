<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header clearfix">
                <h4 class="pull-left"><?php echo $lang['sendermail']['title']; ?></h4>
                <div class="pull-right">
                    <a href="<?php echo $func->urlAdmin('sender');?>" class="btn btn-info btn-sm"><?php echo $lang['sendermail']['list'];?></a>
                    <a href="<?php echo $func->urlAdmin('sender/add');?>" class="btn btn-success btn-sm"><?php echo $lang['sendermail']['add'];?></a>
                </div>
            </div>
            <div class="card-body">
                <?PHP
                if(isset($_POST["title"])){
                $title = strval($_POST["title"]);
                $mess = $func->TextClean($_POST["mess"]);
                    if(strlen($title) > 3){
                        if(strlen($mess) > 10){
                        $db->Query("INSERT INTO db_sender (name, mess, date_add) VALUES ('$title','$mess','".time()."')");
                        echo "<div class='alert alert-success'>{$lang['sendermail']['created']}</div>";
                        }else echo "<div class='alert alert-danger'>{$lang['sendermail']['error_minContent']}</div>";
                    }else echo "<div class='alert alert-danger'>{$lang['sendermail']['error_minTitle']}</div>";
                }
                # Добавление рассылки
                if(isset($_GET["add"])){
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label><?php echo $lang['common']['title']; ?>:</label>
                        <input type="text" name="title" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang['common']['content']; ?>:</label>
                        <textarea name="mess" class="form-control" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> <?php echo $lang['btn']['create']; ?></button>
                </form>
                <hr />
                <b><?php echo $lang['sendermail']['markers']; ?>:</b>
                <br>
                <ul class="list-unstyled">
                    <li><span class="text-red">{!USER!}</span> - <?php echo $lang['common']['username']; ?><li>
                    <li><span class="text-red">{!REFERER!}</span> - <?php echo $lang['common']['referrer']; ?><li>
                    <li><span class="text-red">{!REFERALS!}</span> - <?php echo $lang['common']['referrals']; ?><li>
                    <li><span class="text-red">{!MONEY_B!}</span> - <?php echo $lang['common']['p_balance']; ?><li>
                    <li><span class="text-red">{!MONEY_P!}</span> - <?php echo $lang['common']['w_balance']; ?><li>
                </ul>
            </div>
        </div>
    </div>
</section>
                <?PHP
                return;
                }
                # Удаление
                if(isset($_POST["del"])){
                    $db->Query("DELETE FROM db_sender WHERE id = '".intval($_POST["del"])."'");
                    echo "<div class='alert alert-success'>{$lang['common']['title']}</div>";
                }
                $db->Query("SELECT * FROM db_sender ORDER BY id DESC");
                if($db->NumRows() > 0){
                ?>
                <table class="table table-striped">
                  <thead class="text-center">
                    <th># ID</th>
                    <th><?php echo $lang['common']['title']; ?></th>
                    <th><?php echo $lang['sendermail']['sended']; ?></th>
                    <th><?php echo $lang['common']['status']; ?></th>
                    <th><?php echo $lang['common']['actions']; ?></th>
                  </thead>
                <?PHP
                while($data = $db->FetchArray()){
                ?>
                    <tr>
                    <td align="center"><?=$data["id"]; ?></td>
                    <td align="center"><?=$data["name"]; ?></td>
                    <td align="center"><?=$data["sended"]; ?> x</td>
                    <td align="center"><?=$data["status"] == 0 ? $lang['sendermail']['status_send'] : $lang['sendermail']['status_ok']; ?></td>
                    <td align="center">
                        <form action="" method="post">
                            <input type="hidden" name="del" value="<?=$data["id"]; ?>" />
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> <?php echo $lang['btn']['delete']; ?></button>
                        </form>
                    </td>
                    </tr>
                <?PHP
                }
                ?>
                </table>
                <BR />
                <?PHP
                }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";
                ?>
            </div>
        </div>
    </div>
</section>