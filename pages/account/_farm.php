<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card articles">
            <div class="card-body">
	            <p><?php echo $lang['farm']['text'];?></p>
                <div class="text-danger text-bold"><?php echo sprintf($lang['farm']['alert'],$config->settings['coins']);?></div>
                <?PHP
                $_OPTIMIZATION["title"] = $lang['farm']['title'];
                $usid = $_SESSION["user_id"];
                $refid = $_SESSION["referer_id"];
                $usname = $_SESSION["user"];
                $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
                $user_data = $db->FetchArray();
                $db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
                $sonfig_site = $db->FetchArray();
                # Покупка нового дерева
                if(isset($_POST["item"])){
                    $array_items = array(1 => "a_t", 2 => "b_t", 3 => "c_t", 4 => "d_t", 5 => "e_t", 6 => "f_t");
                    $array_name = array(1 => $config->items['item1'], 2 => $config->items['item2'], 3 => $config->items['item3'], 4 => $config->items['item4'], 5 => $config->items['item5'], 6 => $config->items['item6']);
                    $item = intval($_POST["item"]);
                    $citem = $array_items[$item];
                    if(strlen($citem) >= 3){
                        # Проверяем средства пользователя
                        $need_money = $sonfig_site["amount_".$citem];
                        if($need_money <= $user_data["money_b"]){
                            if($user_data["last_sbor"] == 0 OR $user_data["last_sbor"] > ( time() - 60*20) ){
                                # Добавляем дерево и списываем деньги
                                $db->Query("UPDATE db_users_b SET money_b = money_b - $need_money, $citem = $citem + 1, last_sbor = IF(last_sbor > 0, last_sbor, '".time()."') WHERE id = '$usid'");
                                # Вносим запись о покупке
                                $db->Query("INSERT INTO db_stats_btree (user_id, user, tree_name, amount, date_add, date_del) VALUES ('$usid','$usname','".$array_name[$item]."','$need_money','".time()."','".(time()+60*60*24*15)."')");
                                $message = sprintf($lang['farm']['purchased'],$config->items['name']);
                                echo "<div class='alert alert-success'>{$message}</div>";
                                $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
                                $user_data = $db->FetchArray();
                            }else {
                                $error_message = sprintf($lang['farm']['alert'],$config->settings['coins']);
                                echo "<div class='alert alert-danger'>{$error_message}</div>";
                            }
                        }else{
                            $error_message = sprintf($lang['farm']['noEnoughCoins'],$config->settings['coins']);
                            echo "<div class='alert alert-danger'>{$error_message}</div>";
                        }
                    }
                }
            ?>
            </div>
        </div>
    </div>
</section>

<section class="no-padding-bottom no-padding-top">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3><?php echo $config->items['item1'];?></h3>
                    </div>
                    <div class="card-body text-center">
                        <img width="150" src="/img/fruit/1.png">
                        <ul class="list-group list-group-flush text-left clearfix">
                            <li class="list-group-item"><?php echo $lang['farm']['perHour'];?> <span class="pull-right"><?php echo $sonfig_site["a_in_h"]; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['perMonth'];?> <span class="pull-right"><?php echo $sonfig_site["a_in_h"]*720; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['warehouse'];?> <span class="pull-right"><?php echo $user_data["a_t"]; ?></span></li>
                        </ul>
                        <br>
                        <h1><span class="badge badge-danger"><?php echo $func->priceFormat($sonfig_site["amount_a_t"]); ?></span></h1>
                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="post">
                            <input type="hidden" name="item" value="1" />
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> <?php echo $lang['btn']['buyNow'];?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3><?php echo $config->items['item2'];?></h3>
                    </div>
                    <div class="card-body text-center">
                        <img width="150" src="/img/fruit/2.png">
                        <ul class="list-group list-group-flush text-left clearfix">
                            <li class="list-group-item"><?php echo $lang['farm']['perHour'];?> <span class="pull-right"><?php echo $sonfig_site["b_in_h"]; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['perMonth'];?> <span class="pull-right"><?php echo $sonfig_site["b_in_h"]*720; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['warehouse'];?> <span class="pull-right"><?php echo $user_data["b_t"]; ?></span></li>
                        </ul>
                        <br>
                        <h1><span class="badge badge-danger"><?php echo $func->priceFormat($sonfig_site["amount_b_t"]); ?></span></h1>
                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="post">
                            <input type="hidden" name="item" value="2" />
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> <?php echo $lang['btn']['buyNow'];?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3><?php echo $config->items['item3'];?></h3>
                    </div>
                    <div class="card-body text-center">
                        <img width="150" src="/img/fruit/3.png">
                        <ul class="list-group list-group-flush text-left clearfix">
                            <li class="list-group-item"><?php echo $lang['farm']['perHour'];?> <span class="pull-right"><?php echo $sonfig_site["c_in_h"]; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['perMonth'];?> <span class="pull-right"><?php echo $sonfig_site["c_in_h"]*720; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['warehouse'];?> <span class="pull-right"><?php echo $user_data["c_t"]; ?></span></li>
                        </ul>
                        <br>
                        <h1><span class="badge badge-danger"><?php echo $func->priceFormat($sonfig_site["amount_c_t"]); ?></span></h1>
                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="post">
                            <input type="hidden" name="item" value="3" />
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> <?php echo $lang['btn']['buyNow'];?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3><?php echo $config->items['item4'];?></h3>
                    </div>
                    <div class="card-body text-center">
                        <img width="150" src="/img/fruit/4.png">
                        <ul class="list-group list-group-flush text-left clearfix">
                            <li class="list-group-item"><?php echo $lang['farm']['perHour'];?> <span class="pull-right"><?php echo $sonfig_site["d_in_h"]; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['perMonth'];?> <span class="pull-right"><?php echo $sonfig_site["d_in_h"]*720; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['warehouse'];?> <span class="pull-right"><?php echo $user_data["d_t"]; ?></span></li>
                        </ul>
                        <br>
                        <h1><span class="badge badge-danger"><?php echo $func->priceFormat($sonfig_site["amount_d_t"]); ?></span></h1>
                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="post">
                            <input type="hidden" name="item" value="4" />
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> <?php echo $lang['btn']['buyNow'];?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3><?php echo $config->items['item5'];?></h3>
                    </div>
                    <div class="card-body text-center">
                        <img width="150" src="/img/fruit/5.png">
                        <ul class="list-group list-group-flush text-left clearfix">
                            <li class="list-group-item"><?php echo $lang['farm']['perHour'];?> <span class="pull-right"><?php echo $sonfig_site["e_in_h"]; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['perMonth'];?> <span class="pull-right"><?php echo $sonfig_site["e_in_h"]*720; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['warehouse'];?> <span class="pull-right"><?php echo $user_data["e_t"]; ?></span></li>
                        </ul>
                        <br>
                        <h1><span class="badge badge-danger"><?php echo $func->priceFormat($sonfig_site["amount_e_t"]); ?></span></h1>
                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="post">
                            <input type="hidden" name="item" value="5" />
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> <?php echo $lang['btn']['buyNow'];?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h3><?php echo $config->items['item6'];?></h3>
                    </div>
                    <div class="card-body text-center">
                        <img width="150" src="/img/fruit/6.png">
                        <ul class="list-group list-group-flush text-left clearfix">
                            <li class="list-group-item"><?php echo $lang['farm']['perHour'];?> <span class="pull-right"><?php echo $sonfig_site["f_in_h"]; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['perMonth'];?> <span class="pull-right"><?php echo $sonfig_site["f_in_h"]*720; ?></span></li>
                            <li class="list-group-item"><?php echo $lang['farm']['warehouse'];?> <span class="pull-right"><?php echo $user_data["f_t"]; ?></span></li>
                        </ul>
                        <br>
                        <h1><span class="badge badge-danger"><?php echo $func->priceFormat($sonfig_site["amount_f_t"]); ?></span></h1>
                    </div>
                    <div class="card-footer text-center">
                        <form action="" method="post">
                            <input type="hidden" name="item" value="6" />
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> <?php echo $lang['btn']['buyNow'];?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>