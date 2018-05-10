<?PHP
$_OPTIMIZATION["title"] = $lang['market']['title'];
$usid = $_SESSION["user_id"];
$usname = $_SESSION["user"];
$db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
$user_data = $db->FetchArray();
$db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
$sonfig_site = $db->FetchArray();
$p_convert = 100-$sonfig_site["percent_sell"];
$b_convert = $sonfig_site["percent_sell"];
?><section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card articles">
            <div class="card-body">
                <p><?php echo sprintf($lang['market']['text'],$config->settings['product'],$config->settings['coins'],$p_convert,$b_convert);?></p>
                <p>Conversion Rate: <span class="text-danger"><?=$sonfig_site["items_per_coin"]; ?> kilometers = 1 silver.</span></p>
                <?PHP
                # Продажа
                if(isset($_POST["sell"])){
                    $all_items = $user_data["a_b"] + $user_data["b_b"] + $user_data["c_b"] + $user_data["d_b"] + $user_data["e_b"] + $user_data["f_b"];
                    if($all_items > 0){
                        $money_add = $func->SellItems($all_items, $sonfig_site["items_per_coin"]);
                        $item1_b = $user_data["a_b"];
                        $item2_b = $user_data["b_b"];
                        $item3_b = $user_data["c_b"];
                        $item4_b = $user_data["d_b"];
                        $item5_b = $user_data["e_b"];
                        $item6_b = $user_data["f_b"];
                        $money_b = ( (100 - $sonfig_site["percent_sell"]) / 100) * $money_add;
                        $money_p = ( ($sonfig_site["percent_sell"]) / 100) * $money_add;
                        # Обновляем юзверя
                        $db->Query("UPDATE db_users_b SET money_b = money_b + '$money_b', money_p = money_p + '$money_p', a_b = 0, b_b = 0, c_b = 0, d_b = 0, e_b = 0 
                        WHERE id = '$usid'");
                        $da = time();
                        $dd = $da + 60*60*24*15;
                        # Вставляем запись в статистику
                        $db->Query("INSERT INTO db_sell_items (user, user_id, a_s, b_s, c_s, d_s, e_s, f_s,amount, all_sell, date_add, date_del) VALUES 
                        ('$usname','$usid','$item1_b','$item2_b','$item3_b','$item4_b','$item5_b','$item6_b','$money_add','$all_items','$da','$dd')");
                        $message = sprintf($lang['market']['sold'],$all_items,$config->settings['product'],$money_add,$config->settings['coins']);
                        echo "<div class='alert alert-success'>{$message}</div>";
                        $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
                        $user_data = $db->FetchArray();
                    }else echo "<div class='alert alert-danger'>{$lang['market']['error']}</div>";
                }
                ?>
                <table class="table table-striped">
                  <thead class="text-center">
                    <th><?php echo $config->items['names'];?></td>
                    <th><?php echo $config->settings['product'];?></td>
                    <th><?php echo $config->settings['coins'];?></td>
                  </thead>
                  <tr class="text-center">
                    <td><?php echo $config->items['item1'];?></td>
                    <td><?php echo $user_data["a_b"]; ?></td>
                    <td><?php echo $func->SellItems($user_data["a_b"], $sonfig_site["items_per_coin"]); ?></td>
                  </tr>
                  <tr class="text-center">
                      <td><?php echo $config->items['item2'];?></td>
                    <td><?php echo $user_data["b_b"]; ?></td>
                    <td><?php echo $func->SellItems($user_data["b_b"], $sonfig_site["items_per_coin"]); ?></td>
                  </tr>
                  <tr class="text-center">
                      <td><?php echo $config->items['item3'];?></td>
                    <td><?php echo $user_data["c_b"]; ?></td>
                    <td><?php echo $func->SellItems($user_data["c_b"], $sonfig_site["items_per_coin"]); ?></td>
                  </tr>
                  <tr class="text-center">
                      <td><?php echo $config->items['item4'];?></td>
                    <td><?php echo $user_data["d_b"]; ?></td>
                    <td><?php echo $func->SellItems($user_data["d_b"], $sonfig_site["items_per_coin"]); ?></td>
                  </tr>
                  <tr class="text-center">
                      <td><?php echo $config->items['item5'];?></td>
                    <td><?php echo $user_data["e_b"]; ?></td>
                    <td><?php echo $func->SellItems($user_data["e_b"], $sonfig_site["items_per_coin"]); ?></td>
                  </tr>
                </table>
                <form action="" method="post" class="text-center">
                    <button type="submit" name="sell" class="btn btn-primary"><?php echo $lang['btn']['sellAll'];?></button>
                </form>
            </div>
        </div>
    </div>
</section>
