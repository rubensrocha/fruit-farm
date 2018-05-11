<section class="no-padding-bottom">
<div class="col-lg-12">
    <div class="card articles">
        <div class="card-body">
            <p><?php echo $lang['store']['subtitle']; ?></p>
            <?PHP
            $_OPTIMIZATION["title"] = $lang['store']['title'];
            $usid = $_SESSION["user_id"];
            $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
            $user_data = $db->FetchArray();
            $db->Query("SELECT * FROM db_config WHERE id = '1' LIMIT 1");
            $sonfig_site = $db->FetchArray();
                if(isset($_POST["sbor"])){
                    if($user_data["last_sbor"] < (time() - 600) ){
                        $_item1 = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);
                        $_item2 = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);
                        $_item3 = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);
                        $_item4 = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);
                        $_item5 = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);
                        $_item6 = $func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);
                        $db->Query("UPDATE db_users_b SET 
                        a_b = a_b + '$_item1', 
                        b_b = b_b + '$_item2', 
                        c_b = c_b + '$_item3', 
                        d_b = d_b + '$_item4', 
                        e_b = e_b + '$_item5', 
                        f_b = f_b + '$_item6', 
                        all_time_a = all_time_a + '$_item1',
                        all_time_b = all_time_b + '$_item2',
                        all_time_c = all_time_c + '$_item3',
                        all_time_d = all_time_d + '$_item4',
                        all_time_e = all_time_e + '$_item5',
                        all_time_f = all_time_f + '$_item6',
                        last_sbor = '".time()."' 
                        WHERE id = '$usid' LIMIT 1");
                        $message = sprintf($lang['store']['success'],$config->settings['product']);
                        echo "<div class='alert alert-success'>{$message}</div>";
                        $db->Query("SELECT * FROM db_users_b WHERE id = '$usid' LIMIT 1");
                        $user_data = $db->FetchArray();
                    }else echo "<div class='alert alert-danger'>{$lang['store']['error']}</div>";
                }
                $veloc1 = ($sonfig_site["a_in_h"] /3600) * $user_data["a_t"];
                $item1 = $func->SumCalc($sonfig_site["a_in_h"], $user_data["a_t"], $user_data["last_sbor"]);

                $veloc2 = ($sonfig_site["b_in_h"] /3600) * $user_data["b_t"];
                $item2 = $func->SumCalc($sonfig_site["b_in_h"], $user_data["b_t"], $user_data["last_sbor"]);

                $veloc3 = ($sonfig_site["c_in_h"] /3600) * $user_data["c_t"];
                $item3 = $func->SumCalc($sonfig_site["c_in_h"], $user_data["c_t"], $user_data["last_sbor"]);

                $veloc4 = ($sonfig_site["d_in_h"] /3600) * $user_data["d_t"];
                $item4 = $func->SumCalc($sonfig_site["d_in_h"], $user_data["d_t"], $user_data["last_sbor"]);

                $veloc5 = ($sonfig_site["e_in_h"] /3600) * $user_data["e_t"];
                $item5 = $func->SumCalc($sonfig_site["e_in_h"], $user_data["e_t"], $user_data["last_sbor"]);

                $veloc6 = ($sonfig_site["f_in_h"] /3600) * $user_data["f_t"];
                $item6 = $func->SumCalc($sonfig_site["f_in_h"], $user_data["f_t"], $user_data["last_sbor"]);
            ?>
            <div class="item d-flex align-items-center">
                <div class="image"><img src="/img/fruit/1.png" class="img-fluid rounded-circle"></div>
                <div class="text">
                    <h3 class="h5"><?php echo $config->settings['product'];?> <span id="counter1"><?php echo $item1;?></span></h3>
                    <small><b>Quantity:</b> <?=$user_data["a_t"]; ?> <?php echo $config->items['names'];?></small>
                </div>
            </div>
            <div class="item d-flex align-items-center">
                <div class="image"><img src="/img/fruit/2.png" class="img-fluid rounded-circle"></div>
                <div class="text">
                    <h3 class="h5"><?php echo $config->settings['product'];?> <span id="counter2"><?php echo $item2;?></span></h3>
                    <small><b>Quantity:</b> <?=$user_data["b_t"]; ?> <?php echo $config->items['names'];?></small>
                </div>
            </div>
            <div class="item d-flex align-items-center">
                <div class="image"><img src="/img/fruit/3.png" class="img-fluid rounded-circle"></div>
                <div class="text">
                    <h3 class="h5"><?php echo $config->settings['product'];?> <span id="counter3"><?php echo $item3;?></span></h3>
                    <small><b>Quantity:</b> <?=$user_data["c_t"]; ?> <?php echo $config->items['names'];?></small>
                </div>
            </div>
            <div class="item d-flex align-items-center">
                <div class="image"><img src="/img/fruit/4.png" class="img-fluid rounded-circle"></div>
                <div class="text">
                    <h3 class="h5"><?php echo $config->settings['product'];?> <span id="counter4"><?php echo $item4;?></span></h3>
                    <small><b>Quantity:</b> <?=$user_data["d_t"]; ?> <?php echo $config->items['names'];?></small>
                </div>
            </div>
            <div class="item d-flex align-items-center">
                <div class="image"><img src="/img/fruit/5.png" class="img-fluid rounded-circle"></div>
                <div class="text">
                    <h3 class="h5"><?php echo $config->settings['product'];?> <span id="counter5"><?php echo $item5;?></span></h3>
                    <small><b>Quantity:</b> <?=$user_data["e_t"]; ?> <?php echo $config->items['names'];?></small>
                </div>
            </div>
            <div class="item d-flex align-items-center">
                <div class="image"><img src="/img/fruit/6.png" class="img-fluid rounded-circle"></div>
                <div class="text">
                    <h3 class="h5"><?php echo $config->settings['product'];?> <span id="counter6"><?php echo $item6;?></span></h3>
                    <small><b>Quantity:</b> <?=$user_data["f_t"]; ?> <?php echo $config->items['names'];?></small>
                </div>
            </div>
            <form action="" method="post" class="text-center">
                <input type="submit" name="sbor" class="btn btn-primary" value="Collect All" />
            </form>
        </div>
    </div>
</div>
</section>
<section class="no-padding-bottom no-padding-top">
    <div class="col-lg-12">
        <div class="card articles">
            <div class="card-body">
                <h4 class="text-center">You have in stock</h4>
                <br>
                <div class="row text-center">
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $config->items['item1'];?></h4>
                            </div>
                            <img class="card-img-top" src="/img/fruit/1.png">
                            <div class="card-footer">
                                <p class="card-text"><?=$user_data["a_b"]; ?> <?php echo $config->settings['product'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $config->items['item2'];?></h4>
                            </div>
                            <img class="card-img-top" src="/img/fruit/2.png">
                            <div class="card-footer">
                                <p class="card-text"><?=$user_data["b_b"]; ?> <?php echo $config->settings['product'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $config->items['item3'];?></h4>
                            </div>
                            <img class="card-img-top" src="/img/fruit/3.png">
                            <div class="card-footer">
                                <p class="card-text"><?=$user_data["c_b"]; ?> <?php echo $config->settings['product'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $config->items['item4'];?></h4>
                            </div>
                            <img class="card-img-top" src="/img/fruit/4.png">
                            <div class="card-footer">
                                <p class="card-text"><?=$user_data["d_b"]; ?> <?php echo $config->settings['product'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $config->items['item5'];?></h4>
                            </div>
                            <img class="card-img-top" src="/img/fruit/5.png">
                            <div class="card-footer">
                                <p class="card-text"><?=$user_data["e_b"]; ?> <?php echo $config->settings['product'];?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="card">
                            <div class="card-header">
                                <h4><?php echo $config->items['item6'];?></h4>
                            </div>
                            <img class="card-img-top" src="/img/fruit/6.png">
                            <div class="card-footer">
                                <p class="card-text"><?=$user_data["f_b"]; ?> <?php echo $config->settings['product'];?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>