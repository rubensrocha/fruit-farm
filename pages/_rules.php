<?PHP
$_OPTIMIZATION["title"] = $lang['rules']['title'];
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <?PHP
                    $db->Query("SELECT rules FROM db_conabrul WHERE id = '1'");
                    $xt = $db->FetchRow();
                echo html_entity_decode($xt);
                ?>
            </div>
        </div>
    </div>
</section>
