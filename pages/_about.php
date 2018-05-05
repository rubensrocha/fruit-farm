<?PHP
$_OPTIMIZATION["title"] = $lang['about']['title'];
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?PHP
                $db->Query("SELECT about FROM db_conabrul WHERE id = '1'");
                $xt = $db->FetchRow();
                echo html_entity_decode($xt);
                ?>
            </div>
        </div>
    </div>
</section>