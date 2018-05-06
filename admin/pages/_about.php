<?PHP
$csrfCheck = $func->csrfVerify();
if(isset($_POST["tx"])  and $csrfCheck == TRUE){
    $validate = GUMP::is_valid($_POST, array(
        'tx' => 'required'
    ));

    if($validate === true) {
        $page_content = htmlentities($_POST["tx"]);
            $db->Query("UPDATE db_conabrul SET about = '".$db->RealEscape($page_content)."' WHERE id = '1'");
            $showSuccess = $lang['success_messages']['changesSaved'];
    }else{
        $showError = $lang['error_messages']['invalidData'];
    }
}
    $db->Query("SELECT * FROM db_conabrul WHERE id = '1'");
    $data = $db->FetchArray();
?>
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $lang['about']['title']; ?></h4>
            </div>
            <div class="card-body">
                <?php
                if($showError){
                    echo "<div class='alert alert-danger'>{$showError}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                }
                if($showSuccess){
                    echo "<div class='alert alert-success'>{$showSuccess}<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span> </button></div>";
                }
                ?>
                <form action="" method="post">
                    <?php $func->csrf(); ?>
                    <div class="form-group">
                        <label><?php echo $lang['about']['content']; ?></label>
                        <textarea name="tx" class="form-control" rows="10"><?php echo $data["about"]; ?></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit"> <?php echo $lang['btn']['save']; ?></button>
                </form>
            </div>
        </div>
    </div>
</section>