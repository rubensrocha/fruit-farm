<?PHP
$_OPTIMIZATION["title"] = $lang['news']['title'];
?>
<section class="no-padding-bottom">
    <?PHP
    $db->Query("SELECT * FROM db_news ORDER BY id DESC LIMIT 10");
    if($db->NumRows() > 0){
        while($news = $db->FetchArray()){
    ?>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo $news["title"]; ?></h3>
                </div>
                    <div class="card-body">
                        <?php echo html_entity_decode($news["news"]); ?>
                    </div>
                    <div class="card-footer">
                        <i class="fa fa-calendar"></i> <?php echo date("d.m.Y",$news["date_add"]); ?>
                    </div>
                </div>
            </div>
    <?PHP
        }
    }else echo "<div class='text-center'>{$lang['news']['noNews']}</div>";
    ?>
</section>
