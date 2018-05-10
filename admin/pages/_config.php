
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
	$production_item1 = intval($_POST["a_in_h"]);
	$production_item2 = intval($_POST["b_in_h"]);
	$production_item3 = intval($_POST["c_in_h"]);
	$production_item4 = intval($_POST["d_in_h"]);
	$production_item5 = intval($_POST["e_in_h"]);
	$production_item6 = intval($_POST["f_in_h"]);
	$cost_item1 = intval($_POST["amount_a_t"]);
	$cost_item2 = intval($_POST["amount_b_t"]);
	$cost_item3 = intval($_POST["amount_c_t"]);
	$cost_item4 = intval($_POST["amount_d_t"]);
	$cost_item5 = intval($_POST["amount_e_t"]);
    $cost_item6 = intval($_POST["amount_f_t"]);
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

    if($production_item1 < 6 OR $production_item2 < 6 OR $production_item3 < 6 OR $production_item4 < 6 OR $production_item5 < 6 OR $production_item6 < 6){
		$errors = false; $showError = $lang['settings']['error_productionMin'];
	}

    if($cost_item1 < 1 OR $cost_item2 < 1 OR $cost_item3 < 1 OR $cost_item4 < 1 OR $cost_item5 < 1 OR $cost_item6 < 1){
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
		a_in_h = '$production_item1',
		b_in_h = '$production_item2',
		c_in_h = '$production_item3',
		d_in_h = '$production_item4',
		e_in_h = '$production_item5',
		f_in_h = '$production_item6',
		amount_a_t = '$cost_item1',
		amount_b_t = '$cost_item2',
		amount_c_t = '$cost_item3',
		amount_d_t = '$cost_item4',
		amount_e_t = '$cost_item5',
		amount_f_t = '$cost_item6',
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
                    <h4><?php echo $lang['settings']['_conversions']; ?></h4>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['common']['cost']; ?> 1 RUB (<?php echo $config->settings['coins']; ?>)</label>
                                <input class="form-control" type="number" min="1" step="1" name="ser_per_wmr" value="<?=$data_c["ser_per_wmr"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['common']['cost']; ?> 1 USD (<?php echo $config->settings['coins']; ?>)</label>
                                <input class="form-control" type="number" min="1" step="1" name="ser_per_wmz" value="<?=$data_c["ser_per_wmz"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $lang['common']['cost']; ?> 1 EUR (<?php echo $config->settings['coins']; ?>)</label>
                                <input class="form-control" type="number" min="1" step="1" name="ser_per_wme" value="<?=$data_c["ser_per_wme"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label><?php echo $config->settings['product']; ?> = 1 <?php echo $config->settings['coins']; ?>:</label>
                                <input class="form-control" type="number" min="1" step="1" name="items_per_coin" value="<?=$data_c["items_per_coin"]; ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $lang['settings']['min_payout']; ?> (<?php echo $config->settings['coins']; ?>) (<?php echo $lang['common']['min']; ?> 1)</label>
                                <input class="form-control" type="number" min="1" step="1" name="min_pay" value="<?=$data_c["min_pay"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $lang['settings']['swapBonus']; ?> (1 - 99)</label>
                                <input class="form-control" type="number" min="1" step="1" name="percent_swap" value="<?=$data_c["percent_swap"]; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label><?php echo $lang['settings']['sellPercent']; ?> (1 - 99):</label>
                                <input class="form-control" type="number" min="1" step="1" name="percent_sell" value="<?=$data_c["percent_sell"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <hr />

                    <h4><?php echo $lang['settings']['_productions']; ?> <small>(<?php echo $lang['common']['min']; ?> 1 / <?php echo $lang['common']['perHour']; ?>)</small></h4>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item1']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="a_in_h" value="<?=$data_c["a_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item2']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="b_in_h" value="<?=$data_c["b_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item3']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="c_in_h" value="<?=$data_c["c_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item4']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="d_in_h" value="<?=$data_c["d_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item5']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="e_in_h" value="<?=$data_c["e_in_h"]; ?>" />
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item6']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="f_in_h" value="<?=$data_c["f_in_h"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <hr />

                    <h4><?php echo $lang['settings']['_itemprices']; ?> <small>(<?php echo $lang['common']['min']; ?> 1)</small></h4>

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item1']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_a_t" value="<?=$data_c["amount_a_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item2']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_b_t" value="<?=$data_c["amount_b_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item3']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_c_t" value="<?=$data_c["amount_c_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item4']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_d_t" value="<?=$data_c["amount_d_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item5']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_e_t" value="<?=$data_c["amount_e_t"]; ?>" />
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label><?php echo $config->items['item6']; ?></label>
                                <input class="form-control" type="number" min="1" step="1" name="amount_f_t" value="<?=$data_c["amount_f_t"]; ?>" />
                            </div>
                        </div>
                    </div>
                    <hr />

                    <h4><?php echo $lang['settings']['_general']; ?></h4>
                    <div class="form-group">
                        <label><?php echo $lang['settings']['adminLang']; ?></label>
                        <select name="defaultLang" class="form-control">
                            <option value=""></option>
                            <?php foreach($config->languages as $k => $v){ ?>
                                <option value="<?php echo $k;?>" <?php echo $defaultSettings['default_lang']==$k? 'selected': ''?>><?php echo $v;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="admin" class="btn btn-primary"><?php echo $lang['btn']['save']; ?></button>
                </form>
            </div>
        </div>
    </div>
</section>