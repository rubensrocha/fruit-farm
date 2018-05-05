<?PHP
$_OPTIMIZATION["title"] = "Account - Member List";
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="text-center">
                        <th># ID</th>
                        <th><?php echo $lang['common']['username'];?></th>
                        <th><?php echo $lang['common']['email'];?></th>
                    </thead>
                    <?php
                    $resultsMax = 10;
                    $num_p = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"]) -1) : 0;
                    $lim = $num_p * $resultsMax;
                    $db->Query("SELECT * FROM db_users_a ORDER BY id DESC LIMIT {$lim}, {$resultsMax}");
                    if($db->NumRows() > 0){
                        while($data = $db->FetchArray()){
                    ?>
                        <tr class="text-center">
                            <td><?=$data["id"]; ?></td>
                            <td><?=$data["user"]; ?></td>
                            <td><?=str_replace(substr($data["email"],2,5), '<span class="text-red">***</span>', $data["email"]); ?></td>
                        </tr>
                    <?PHP
                            }
                        }else echo "<tr><td class='text-center' colspan='3'>{$lang['error_messages']['noresults']}</td></tr>";
                    ?>
                </table>
                <?PHP
                $db->Query("SELECT COUNT(*) FROM db_users_a");
                $all_pages = $db->FetchRow();
                if($all_pages > $resultsMax){
                    $sort_b = (isset($_GET["sort"])) ? intval($_GET["sort"]) : 0;
                    $nav = new Navigator;
                    $page = (isset($_GET["page"]) AND intval($_GET["page"]) < 1000 AND intval($_GET["page"]) >= 1) ? (intval($_GET["page"])) : 1;
                    echo "".$nav->Navigation($resultsMax, $page, ceil($all_pages / $resultsMax), "/users/"), "";
                }
                ?>
            </div>
        </div>
    </div>
</section>