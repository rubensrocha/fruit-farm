
<section class="no-padding-bottom">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo $lang['settings']['title']; ?></h4>
            </div>
            <div class="card-body">
                <?PHP
$db->Query("SELECT * FROM db_config WHERE id = '1'");
$data_c = $db->FetchArray();

# Обновление
if(isset($_POST["admin"])){
    $ser_per_wmr = intval($_POST["ser_per_wmr"]);
	$ser_per_wmz = intval($_POST["ser_per_wmz"]);
	$ser_per_wme = intval($_POST["ser_per_wme"]);
	$min_pay = intval($_POST["min_pay"]);
	$percent_swap = intval($_POST["percent_swap"]);
	$percent_sell = intval($_POST["percent_sell"]);
	$items_per_coin = intval($_POST["items_per_coin"]);
	$tomat_in_h = intval($_POST["a_in_h"]);
	$straw_in_h = intval($_POST["b_in_h"]);
	$pump_in_h = intval($_POST["c_in_h"]);
	$peas_in_h = intval($_POST["d_in_h"]);
	$pean_in_h = intval($_POST["e_in_h"]);
	$amount_tomat_t = intval($_POST["amount_a_t"]);
	$amount_straw_t = intval($_POST["amount_b_t"]);
	$amount_pump_t = intval($_POST["amount_c_t"]);
	$amount_peas_t = intval($_POST["amount_d_t"]);
	$amount_pean_t = intval($_POST["amount_e_t"]);
	$admin_lang = $_POST["defaultLang"];
	# Проверка на ошибки
	$errors = true;
	if($min_pay < 1){
		$errors = false; $showError = $lang['settings']['error_paymentMin'];
	}
	if($percent_swap < 1 OR $percent_swap > 99){
		$errors = false; $showError = $lang['settings']['error_percentExt'];
	}

    if($percent_sell < 1 OR $percent_sell > 99){
		$errors = false; $showError = $lang['settings']['error_percentOut'];
	}

    if($items_per_coin < 1 OR $items_per_coin > 50000){
		$errors = false; $showError = $lang['settings']['error_minfruits'];
	}

    if($tomat_in_h < 6 OR $straw_in_h < 6 OR $pump_in_h < 6 OR $peas_in_h < 6 OR $pean_in_h < 6){
		$errors = false; $showError = $lang['settings']['error_productionMin'];
	}

    if($amount_tomat_t < 1 OR $amount_straw_t < 1 OR $amount_pump_t < 1 OR $amount_peas_t < 1 OR $amount_pean_t < 1){
		$errors = false; $showError = $lang['settings']['error_itemprice'];
	}
	
	# Обновление
    if($errors){
	
		$db->Query("UPDATE db_config SET 
		ser_per_wmr = '$ser_per_wmr',
		ser_per_wmz = '$ser_per_wmz',
		ser_per_wme = '$ser_per_wme',
		min_pay = '$min_pay',
		percent_swap = '$percent_swap',
		percent_sell = '$percent_sell',
		items_per_coin = '$items_per_coin',
		a_in_h = '$tomat_in_h',
		b_in_h = '$straw_in_h',
		c_in_h = '$pump_in_h',
		d_in_h = '$peas_in_h',
		e_in_h = '$pean_in_h',
		amount_a_t = '$amount_tomat_t',
		amount_b_t = '$amount_straw_t',
		amount_c_t = '$amount_pump_t',
		amount_d_t = '$amount_peas_t',
		amount_e_t = '$amount_pean_t',
		default_lang = '$admin_lang'
		
		WHERE id = '1'");

        $showSuccess = $lang['success_messages']['changesSaved'];
		$db->Query("SELECT * FROM db_config WHERE id = '1'");
		$data_c = $db->FetchArray();
	}
}

?>
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
                    <h4>Conversions</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Cost 1 RUB (Silver)</label>
                                <input class="form-control" type="number" min="1" step="1" name="ser_per_wmr" value="<?=$data_c["ser_per_wmr"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Cost 1 USD (Silver)</label>
                                <input class="form-control" type="number" min="1" step="1" name="ser_per_wmz" value="<?=$data_c["ser_per_wmz"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Cost 1 EUR (Silver)</label>
                                <input class="form-control" type="number" min="1" step="1" name="ser_per_wme" value="<?=$data_c["ser_per_wme"]; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Minimum payment amount (Silver)</label>
                                <input class="form-control" type="number" min="1" step="1" name="min_pay" value="<?=$data_c["min_pay"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Add % when exchanging (1 to 99)</label>
                                <input class="form-control" type="number" min="1" step="1" name="percent_swap" value="<?=$data_c["percent_swap"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>% of silver per withdrawal on sale (from 1 to 99):</label>
                                <input class="form-control" type="number" min="1" step="1" name="percent_sell" value="<?=$data_c["percent_sell"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>How many fruits = 1 silver:</label>
                                <input class="form-control" type="number" min="1" step="1" name="items_per_coin" value="<?=$data_c["items_per_coin"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <hr />

                    <h4>Fertility per hour <small>(min 6)</small></h4>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Lyme</label>
                                <input class="form-control" type="number" min="1" step="1" name="a_in_h" value="<?=$data_c["a_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Cherry</label>
                                <input class="form-control" type="number" min="1" step="1" name="b_in_h" value="<?=$data_c["b_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Strawberry</label>
                                <input class="form-control" type="number" min="1" step="1" name="c_in_h" value="<?=$data_c["c_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Kiwi</label>
                                <input class="form-control" type="number" min="1" step="1" name="d_in_h" value="<?=$data_c["d_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Orange</label>
                                <input class="form-control" type="number" min="1" step="1" name="e_in_h" value="<?=$data_c["e_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>ITEM 6:</label>
                                <input class="form-control" type="number" min="1" step="1" name="f_in_h" value="<?=$data_c["f_in_h"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <hr />

                    <h4>The cost of wood is silver</h4>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Lime</label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_a_t" value="<?=$data_c["amount_a_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Cherry</label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_b_t" value="<?=$data_c["amount_b_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Strawberry</label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_c_t" value="<?=$data_c["amount_c_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Kiwi</label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_d_t" value="<?=$data_c["amount_d_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Orange</label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_e_t" value="<?=$data_c["amount_e_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>ITEM 6</label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_f_t" value="<?=$data_c["amount_f_t"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Language</label>
                        <select name="defaultLang" class="form-control">
                            <option value=""></option>
                            <?php foreach($config->languages as $k => $v){ ?>
                                <option value="<?php echo $k;?>" <?php echo $defaultSettings['default_lang']==$k? 'selected': ''?>><?php echo $v;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="admin" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>