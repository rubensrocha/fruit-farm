<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header clearfix">
                <h4><?php echo $lang['users']['title']; ?></h4>
            </div>
            <div class="card-body">
                <?PHP
                # Редактирование пользователя
                if(isset($_GET["edit"])){
                    $eid = intval($_GET["edit"]);
                    $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
                    # Проверяем на существование
                    if($db->NumRows() != 1){ echo "<div class='alert alert-danger'>{$lang['error_messages']['notfoundAccount']}</div>"; }
                    # Добавляем дерево
                    if(isset($_POST["set_tree"])){
                        $tree = $_POST["set_tree"];
                        $type = ($_POST["type"] == 1) ? "-1" : "+1";
                        $db->Query("UPDATE db_users_b SET {$tree} = {$tree} {$type} WHERE id = '$eid'");
                        $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
                        echo "<div class='alert alert-success'>{$lang['users']['itemAdded']}</div>";
                    }
                    # Пополняем баланс
                    if(isset($_POST["balance_set"])){
                        $sum = intval($_POST["sum"]);
                        $bal = $_POST["schet"];
                        $type = ($_POST["balance_set"] == 1) ? "-" : "+";
                        $string = ($type == "-") ? sprintf($lang['users']['balanceMinus'],$sum) : sprintf($lang['users']['balancePlus'],$sum);
                        $db->Query("UPDATE db_users_b SET {$bal} = {$bal} {$type} {$sum} WHERE id = '$eid'");
                        $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
                        echo "<div class='alert alert-success'>{$string}</div>";
                    }
                    # Забанить пользователя
                    if(isset($_POST["banned"])){
                        $db->Query("UPDATE db_users_a SET banned = '".intval($_POST["banned"])."' WHERE id = '$eid'");
                        $db->Query("SELECT *, INET_NTOA(db_users_a.ip) uip FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_b.id = '$eid' LIMIT 1");
                        echo "<div class='alert alert-success'>".($_POST["banned"] > 0 ? $lang['users']['banned'] : $lang['users']['unbanned'])."</div>";
                    }
                    $data = $db->FetchArray();
                    ?>
                    <table class="table table-striped table-sm">
                      <tr>
                        <td># ID</td>
                        <td class="text-center"><?=$data["id"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['username']; ?></td>
                        <td class="text-center"><?=$data["user"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['email']; ?></td>
                        <td class="text-center"><?=$data["email"]; ?></td>
                      </tr>


                      <tr>
                        <td><?php echo $config->settings['coins']; ?> (<?php echo $lang['common']['p_balance']; ?>):</td>
                        <td class="text-center"><?=sprintf("%.2f",$data["money_b"]); ?></td>
                      </tr>

                      <tr>
                        <td><?php echo $config->settings['coins']; ?> (<?php echo $lang['common']['w_balance']; ?>):</td>
                        <td class="text-center"><?=sprintf("%.2f",$data["money_p"]); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $config->settings['product']; ?> (<?php echo $config->items['item1']; ?>):</td>
                        <td class="text-center"><?=$data["a_b"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $config->settings['product']; ?> (<?php echo $config->items['item2']; ?>):</td>
                        <td class="text-center"><?=$data["b_b"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $config->settings['product']; ?> (<?php echo $config->items['item3']; ?>):</td>
                        <td class="text-center"><?=$data["c_b"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $config->settings['product']; ?> (<?php echo $config->items['item4']; ?>):</td>
                        <td class="text-center"><?=$data["d_b"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $config->settings['product']; ?> (<?php echo $config->items['item5']; ?>):</td>
                        <td class="text-center"><?=$data["e_b"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $config->items['names']; ?> (<?php echo $config->items['item1']; ?>):</td>
                        <td class="text-center">

                            <table width="100%" border="0">
                              <tr>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="a_t" />
                                    <input type="hidden" name="type" value="1" />
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i> 1</button>
                                </form>
                                </td>
                                <td align="center"><?=$data["a_t"]; ?></td>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="a_t" />
                                    <input type="hidden" name="type" value="2" />
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> 1</button>
                                </form>
                                </td>
                              </tr>
                            </table>

                        </td>
                      </tr>

                      <tr>
                        <td><?php echo $config->items['names']; ?> (<?php echo $config->items['item2']; ?>):</td>
                        <td class="text-center">

                            <table width="100%" border="0">
                              <tr>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="b_t" />
                                    <input type="hidden" name="type" value="1" />
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i> 1</button>
                                </form>
                                </td>
                                <td align="center"><?=$data["b_t"]; ?></td>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="b_t" />
                                    <input type="hidden" name="type" value="2" />
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> 1</button>
                                </form>
                                </td>
                              </tr>
                            </table>

                        </td>
                      </tr>

                      <tr>
                        <td><?php echo $config->items['names']; ?> (<?php echo $config->items['item3']; ?>):</td>
                        <td class="text-center">

                            <table width="100%" border="0">
                              <tr>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="c_t" />
                                    <input type="hidden" name="type" value="1" />
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i> 1</button>
                                </form>
                                </td>
                                <td align="center"><?=$data["c_t"]; ?></td>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="c_t" />
                                    <input type="hidden" name="type" value="2" />
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> 1</button>
                                </form>
                                </td>
                              </tr>
                            </table>

                        </td>
                      </tr>

                      <tr>
                        <td><?php echo $config->items['names']; ?> (<?php echo $config->items['item4']; ?>):</td>
                        <td class="text-center">

                            <table width="100%" border="0">
                              <tr>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="d_t" />
                                    <input type="hidden" name="type" value="1" />
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i> 1</button>
                                </form>
                                </td>
                                <td align="center"><?=$data["d_t"]; ?></td>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="d_t" />
                                    <input type="hidden" name="type" value="2" />
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> 1</button>
                                </form>
                                </td>
                              </tr>
                            </table>

                        </td>
                      </tr>

                      <tr>
                        <td><?php echo $config->items['names']; ?> (<?php echo $config->items['item5']; ?>):</td>
                        <td class="text-center">

                            <table width="100%" border="0">
                              <tr>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="e_t" />
                                    <input type="hidden" name="type" value="1" />
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-minus-circle"></i> 1</button>
                                </form>
                                </td>
                                <td align="center"><?=$data["e_t"]; ?></td>
                                <td>
                                <form action="" method="post">
                                    <input type="hidden" name="set_tree" value="e_t" />
                                    <input type="hidden" name="type" value="2" />
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> 1</button>
                                </form>
                                </td>
                              </tr>
                            </table>

                        </td>
                      </tr>



                      <tr>
                        <td><?php echo $lang['common']['totalCollected']; ?> (<?php echo $config->items['item1']; ?>):</td>
                        <td class="text-center"><?=$data["all_time_a"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['totalCollected']; ?> (<?php echo $config->items['item2']; ?>):</td>
                        <td class="text-center"><?=$data["all_time_b"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['totalCollected']; ?> (<?php echo $config->items['item3']; ?>):</td>
                        <td class="text-center"><?=$data["all_time_c"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['totalCollected']; ?> (<?php echo $config->items['item4']; ?>):</td>
                        <td class="text-center"><?=$data["all_time_d"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['totalCollected']; ?> (<?php echo $config->items['item5']; ?>):</td>
                        <td class="text-center"><?=$data["all_time_e"]; ?></td>
                      </tr>


                      <tr>
                        <td><?php echo $lang['common']['referrer']; ?></td>
                        <td class="text-center">[<?=$data["referer_id"]; ?>] <?=$data["referer"]; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['referrals']; ?></td>

                        <?PHP
                        $db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$data["id"]."'");
                        $counter_res = $db->FetchRow();
                        ?>

                        <td class="text-center"><?=$data["referals"]; ?> [<?=$counter_res; ?>]</td>
                      </tr>

                      <tr>
                        <td><?php echo $lang['users']['ref_earns']; ?></td>
                        <td class="text-center"><?=sprintf("%.2f",$data["from_referals"]); ?> сер.</td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['users']['ref_pays']; ?></td>
                        <td class="text-center"><?=sprintf("%.2f",$data["to_referer"]); ?> сер.</td>
                      </tr>



                      <tr>
                        <td><?php echo $lang['common']['resgetedOn']; ?>:</td>
                        <td class="text-center"><?=date("d.m.Y в H:i:s",$data["date_reg"]); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['users']['lastLogin']; ?></td>
                        <td class="text-center"><?=date("d.m.Y в H:i:s",$data["date_login"]); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['users']['lastIP']; ?></td>
                        <td class="text-center"><?=$data["uip"]; ?></td>
                      </tr>

                      <tr>
                        <td><?php echo $lang['common']['deposits']; ?></td>
                        <td class="text-center"><?php echo $func->priceFormat($data["insert_sum"]); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo $lang['common']['withdraws']; ?></td>
                        <td class="text-center"><?php echo $func->priceFormat($data["payment_sum"]); ?></td>
                      </tr>

                      <tr>
                        <td><?php echo $lang['users']['bannedStatus']; ?> (<?=($data["banned"] > 0) ? '<span class="text-red"><b>'.$lang['common']['yes'].'</b></span>' : '<span class="text-green"><b>'.$lang['common']['no'].'</b></span>'; ?>):</td>
                        <td class="text-center">
                        <form action="" method="post">
                            <input type="hidden" name="banned" value="<?=($data["banned"] > 0) ? 0 : 1 ;?>" />
                            <input type="submit" class="btn btn-sm btn-danger" value="<?=($data["banned"] > 0) ? $lang['btn']['unban'] : $lang['btn']['ban']; ?>" />
                        </form>
                        </td>
                      </tr>

                    </table>
                    <BR />
                    <form action="" method="post">
                        <table class="table table-striped">
                          <tr>
                            <td align="center" colspan="4"><b><?php echo $lang['common']['actions']; ?></b></td>
                          </tr>
                          <tr>
                            <td align="center">
                                <select name="balance_set" class="form-control">
                                    <option value="2"><?php echo $lang['users']['addTo']; ?></option>
                                    <option value="1"><?php echo $lang['users']['removeFrom']; ?></option>
                                </select>
                            </td>
                            <td align="center">
                                <select name="schet" class="form-control">
                                    <option value="money_b"><?php echo $lang['common']['p_balance']; ?></option>
                                    <option value="money_p"><?php echo $lang['common']['w_balance']; ?></option>
                                </select>
                            </td>
                            <td align="center"><input type="text" name="sum"  class="form-control" placeholder="1.00"/></td>
                            <td align="center"><input type="submit" class="btn btn-sm btn-primary" value="<?php echo $lang['btn']['update']; ?>" /></td>
                          </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </section>
                <?PHP
                    return;
                }
                ?>
                <form action="<?php echo $func->urlAdmin('users/search');?>" method="post" class="form-inline">
                  <div class="input-group">
                    <label><?php echo $lang['common']['username'];?></label>
                    <input type="text" name="sear" class="form-control" />
                    <div class="input-group-append">
                        <input type="submit" value="<?php echo $lang['btn']['search'];?>" class="btn btn-primary" />
                    </div>
                  </div>
                </form>
                <br>
                <?PHP
                function sort_b($int_s){
                    $int_s = intval($int_s);
                    switch($int_s){
                        case 1: return "db_users_a.user";
                        case 2: return "all_serebro";
                        case 3: return "all_trees";
                        case 4: return "db_users_a.date_reg";
                        default: return "db_users_a.id";
                    }
                }
                $resultsMax = 50;
                $sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
                $str_sort = sort_b($sort_b);
                $num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
                $lim = $num_p * $resultsMax;
                if(isset($_GET["search"])){
                $search = $_POST["sear"];
                $db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t + db_users_b.d_t + db_users_b.e_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro 
                FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.user = '$search' ORDER BY {$str_sort} DESC LIMIT {$lim}, {$resultsMax}");
                }else $db->Query("SELECT *, (db_users_b.a_t + db_users_b.b_t + db_users_b.c_t + db_users_b.d_t + db_users_b.e_t) all_trees, (db_users_b.money_b + db_users_b.money_p) all_serebro FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id ORDER BY {$str_sort} DESC LIMIT {$lim}, {$resultsMax}");
                if($db->NumRows() > 0){
                ?>
                <table class="table table-striped">
                  <thead class="text-center">
                    <th><a href="/admin/users/sort/0" class="stn-sort"># ID</a></th>
                    <th><a href="/admin/users/sort/1" class="stn-sort"><?php echo $lang['common']['username'];?></a></th>
                    <th><a href="/admin/users/sort/2" class="stn-sort"><?php echo $config->settings['coins'];?></a></th>
                    <th><a href="/admin/users/sort/3" class="stn-sort"><?php echo $config->items['names'];?></a></th>
                    <th><a href="/admin/users/sort/4" class="stn-sort"><?php echo $lang['common']['resgetedOn'];?></a></th>
                    <th><a href="/admin/users/sort/1" class="stn-sort"><?php echo $lang['common']['actions'];?></a></th>
                  </thead>
                <?PHP
                    while($data = $db->FetchArray()){
                ?>
                    <tr class="text-center">
                        <td><?php echo $data["id"]; ?></td>
                        <td><?php echo $data["user"]; ?></td>
                        <td><?php echo sprintf("%.2f",$data["all_serebro"]); ?></td>
                        <td><?php echo $data["all_trees"]; ?></td>
                        <td><?php echo date("d.m.Y",$data["date_reg"]); ?></td>
                        <td><a href="/admin/users/edit/<?php echo $data["id"]; ?>" class="btn btn-sm btn-info"><i class="fa fa-edit"></i> <?php echo $lang['btn']['edit'];?></a></td>
                    </tr>
                <?PHP
                    }
                ?>
                </table>
                <?PHP
                }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";
                    if(isset($_GET["search"])){
                ?>
            </div>
        </div>
    </div>
</section>
                <?PHP
                    return;
                    }
                $db->Query("SELECT COUNT(*) FROM db_users_a");
                $all_pages = $db->FetchRow();
                    if($all_pages > $resultsMax){
                        $sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
                        $nav = new Navigator;
                        $page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
                        echo $nav->Navigation(10, $page, ceil($all_pages / $resultsMax), "/admin/users/sort/{$sort_b}/page/");
                    }
                ?>
            </div>
        </div>
    </div>
</section>