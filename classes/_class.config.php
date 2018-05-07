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
        'symbol' => 'RUB',
        'symbol_position' => 'right',
        'decimals' => '4',
        'dec_point' => '.',
        'thousand_point' => '',
    ];

    public $VAL = 'Руб.'; // Currency Symbol
    
    // PAYEER
    public $AccountNumber = ''; // Payeer Account ID
    public $apiId = ''; // Payeer API ID
    public $apiKey = ''; // Payeer API Key
    public $shopID = ''; // Payeer Shop ID
    public $secretW = ''; // Payeer Secret Key

    // Settings for payment of a loan
    public $kredit_shopID = 'ShopID';
    public $kredit_secretW = 'SecretKEY';

    /*
     * Site Settings
     * @array
     *  key => value
     */
    public $settings = [
        'sitename' => 'FF Script', // Site name
        'description' => 'Fruit Farm SM Script', // Site description
        'keywords' => 'Earnings on plants, attachments, earn, farm, cash farm, make money on the farm', // Site keywords
        'coins' => 'SM Coins', // Name of the custom coin
        'product' => 'Kilometers', // Name of what is produced by the items (fruits, fuel, kilometers, eggs, etc)
    ];

    /*
     * Item Names
     * @array
     *  key => value
     *  Name of the items Eg.: Fuit names(lime, kiwi, etc), Car Names(camaro, mustang, etc)
     */
    public $items = [
        'item1' => 'Level 1', // Item name 1
        'item2' => 'Level 2', // Item name 2
        'item3' => 'Level 3', // Item name 3
        'item4' => 'Level 4', // Item name 4
        'item5' => 'Level 5', // Item name 5
        'item6' => 'Level 6', // Item name 6
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
