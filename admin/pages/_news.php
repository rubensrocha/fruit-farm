<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header clearfix">
                <h4 class="pull-left"><?php echo $lang['news']['title']; ?></h4>
                <div class="pull-right">
                    <a href = "/admin/news" class="btn btn-info btn-sm"><?php echo $lang['news']['list'];?></a>
                    <a href = "/admin/news/add" class="btn btn-success btn-sm"><?php echo $lang['btn']['create'];?></a>
                </div>
            </div>
            <div class="card-body">
            <?PHP
                if(isset($_POST["del"])){
                    $ret_id = intval($_POST["del"]);
                    $db->Query("DELETE FROM db_news WHERE id = '$ret_id'");
                    echo "<div class='alert alert-success'>{$lang['success_messages']['deleted']}</div>";
                }
                # добавление новости
                if(isset($_GET["add"])){
                    if(isset($_POST["title"], $_SESSION["add_news"]) AND $_SESSION["add_news"] == $_POST["add_news"]){
                        unset($_SESSION["add_news"]);
                        $title = $func->TextClean($_POST["title"]);
                        $text = $_POST["ntext"];
                        if(strlen($title) >= 3){
                            $db->Query("INSERT INTO db_news (title, news, date_add) VALUES ('$title','$text','".time()."')");
                            echo "<div class='alert alert-success'>{$lang['success_messages']['created']}</div>";
                        }else echo "<div class='alert alert-danger'>{$lang['news']['titleError']}</div>";
                    }
            ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label><?php echo $lang['common']['title'];?></label>
                            <input type="text" name="title" class="form-control" value="<?php echo (isset($_POST["title"])) ? $_POST["title"] : false; ?>" />
                        </div>
                        <div class="form-group">
                            <label><?php echo $lang['common']['content'];?></label>
                            <textarea name="ntext" class="form-control" rows="5"><?php echo (isset($_POST["ntext"])) ? $_POST["ntext"] : false; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo $lang['btn']['save'];?></button>
                        <?PHP
                            $_SESSION["add_news"] = rand(1,1000);
                        ?>
                        <input type="hidden" name="add_news" value="<?php echo $_SESSION["add_news"]; ?>" />
                    </form>
                </div>
            </div>
        </div>
    </section>
            <?PHP
                return;
                }
                # редактирование
                if(isset($_GET["edit"])){
                $idr = intval($_GET["edit"]);
                $db->Query("SELECT * FROM db_news WHERE id = '$idr' LIMIT 1");
                if($db->NumRows() != 1){
                    echo "<div class='alert alert-danger'>{$lang['error_messages']['itemNotFound']}</div></div></div></div></section>";
                    return;
                }
                if(isset($_POST["title"])){
                    $title = $func->TextClean($_POST["title"]);
                    $text = $_POST["ntext"];
                    if(strlen($title) >= 3){
                        $db->Query("UPDATE db_news SET title = '$title', news = '$text' WHERE id = '$idr'");
                        echo "<div class='alert alert-success'>{$lang['success_messages']['changesSaved']}</div>";
                    }else echo "<div class='alert alert-danger'>{$lang['news']['titleError']}</div>";
                    $db->Query("SELECT * FROM db_news WHERE id = '$idr' LIMIT 1");
                }
                $news = $db->FetchArray();
            ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label><?php echo $lang['common']['title'];?>:</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $news["title"]; ?>" />
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang['common']['content'];?>:</label>
                        <textarea name="ntext" class="form-control" rows="5"><?php echo $news["news"]; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo $lang['btn']['save'];?></button>
                </form>
            </div>
        </div>
    </div>
</section>
            <?PHP
                return;
                }
                $db->Query("SELECT * FROM db_news ORDER BY id DESC");
                if($db->NumRows() > 0){
            ?>
                    <table class="table table-striped">
                        <thead class="text-center">
                            <th># ID</th>
                            <th><?php echo $lang['common']['name'];?></th>
                            <th><?php echo $lang['common']['actions'];?></th>
                        </thead>
                        <tbody class="text-center">
            <?PHP
                        while($data = $db->FetchArray()){
            ?>
                            <tr>
                                <td><?php echo $data["id"]; ?></td>
                                <td><?php echo $data["title"]; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="del" value="<?php echo $data["id"]; ?>" />
                                        <a href="/admin/news/edit/<?php echo $data["id"]; ?>" class="btn btn-sm btn-info" data-toggle="tooltip" title="<?php echo $lang['btn']['edit'];?>"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="<?php echo $lang['btn']['delete'];?>"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
            <?PHP
                        }
            ?>
                        </tbody>
                    </table>
            <?PHP
                }else echo "<div class='alert alert-danger'>{$lang['error_messages']['noresults']}</div>";
            ?>
            </div>
        </div>
    </div>
</section>