<?php
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */

class Config
{
    /*
     * Database
     * @string
     */
    public $HostDB = 'localhost'; // DB host (localhost or remote host url)
    public $UserDB = 'root'; // DB username
    public $PassDB = ''; // DB password
    public $BaseDB = 'fruitfarm'; // DB Name

    /*
     * Site Settings
     * @string
     */
    public $scriptName = 'Fruit-Farm SM V1.0'; // Script Name and Version
    public $SYSTEM_START_TIME = 1357338458; // Project Start Date => use php time() function

    /*
     * Currency
     * @array
     *  key => value
     */
    public $currency = [
        'symbol' => 'Py6',
        'symbol_position' => 'right',
        'decimals' => '4',
        'dec_point' => '.',
        'thousand_point' => '',
    ];

    public $VAL = 'Руб.'; // Currency Symbol
    
    // PAYEER
    public $AccountNumber = 'P111111'; // Payeer Account ID
    public $apiId = '11111111'; // Payeer API ID
    public $apiKey = '11111111'; // Payeer API Key
    public $shopID = '11111111'; // Payeer Shop ID
    public $secretW = '11111111'; // Payeer Secret Key

    // Settings for payment of a loan
    public $kredit_shopID = 'ShopID';
    public $kredit_secretW = 'SecretKEY';

    /*
     * Site Settings
     * @array
     *  key => value
     */
    public $settings = [
        'sitename' => 'FF Script',
        'description' => 'Fruit Farm SM Script',
        'keywords' => 'Earnings on plants, attachments, earn, farm, cash farm, make money on the farm',
    ];

    /**
     * Languages availables
     * @array
     * code => Name
    */
    public $languages = [
        'en' => 'English',
        'pt' => 'Português',
        'ru' => 'Pусский',
    ];
}
?>
