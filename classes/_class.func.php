<?php
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */

class Func
{
    public $UserIP = "Undefined"; // IP пользователя
    public $UserCode = "Undefined"; // Код от IP
    public $TableID = -1; // ID таблицы
    public $UserAgent = "Undefined"; // Браузер пользователя

    /*======================================================================*\
    Function:    __construct
    Output:        Нет
    Descriiption: Выполняется при создании экземпляра класса
    \*======================================================================*/
    public function __construct()
    {
        $this->UserIP = $this->GetUserIp();
        $this->UserCode = $this->IpCode();
        $this->UserAgent = $this->UserAgent();
    }

    /*======================================================================*\
    Function:    __destruct
    Output:        Нет
    Descriiption: Уничтожение объекта
    \*======================================================================*/
    public function __destruct()
    {
    }


    /*======================================================================*\
    Function:    IsMail
    Output:        True / False
    Input:        Email
    Descriiption: Проверяет правильность ввода email адреса
    \*======================================================================*//*
    public function IsMail($mail){
    if(is_array($mail) && empty($mail) && strlen($mail) > 255 && strpos($mail,'@') > 64) return false;
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)) ? false : strtolower($mail);
    }*/

    /*======================================================================*\
    Function:    IsPassword
    Output:        True / False
    Input:        Строка пароля, Маска, Длина ("10, 25") && ("10")
    Descriiption: Проверяет правильность ввода пароля
    \*======================================================================*//*
    public function IsPassword($password, $mask = "^[a-zA-Z0-9]", $len = "{4,20}"){
    return (is_array($password)) ? false : (ereg("{$mask}{$len}$", $password)) ? $password : false;

    }*/

    /*======================================================================*\
    Function:    IsLogin
    Output:        True / False
    Input:        Строка логина, Маска, Длина ("10, 25") && ("10")
    Descriiption: Проверяет правильность ввода логина
    \*======================================================================*//*
    public function IsLogin($login, $mask = "^[a-zA-Z0-9]", $len = "{4,10}"){
    return (is_array($login)) ? false : (ereg("{$mask}{$len}$", $login)) ? $login : false;
    }*/

    /*======================================================================*\
    Function:    GetUserIp
    Output:        UserIp
    Descriiption: Определяет IP пользователя
    \*======================================================================*/
    public function GetUserIp()
    {
        if ($this->UserIP == "Undefined") {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) and !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown");
                $entries = preg_split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
                reset($entries);
                while (list(, $entry) = each($entries)) {
                    $entry = trim($entry);
                    if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)) {
                        $private_ip = array(
                        '/^0\./',
                        '/^127\.0\.0\.1/',
                        '/^192\.168\..*/',
                        '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                        '/^10\..*/');
                        $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
                        if ($client_ip != $found_ip) {
                            $client_ip = $found_ip;
                            break;
                        }
                    }
                }
                $this->UserIP = $client_ip;
                return $client_ip;
            } else {
                return (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ? $_ENV['REMOTE_ADDR'] : "unknown");
            }
        } else {
            return $this->UserIP;
        }
    }

    /*======================================================================*\
    Function:    SellItems
    Descriiption: Выводит сумму и остаток
    \*======================================================================*/
    public function SellItems($all_items, $for_one_coin)
    {
        if ($all_items <= 0 or $for_one_coin <= 0) {
            return 0;
        }
        return sprintf("%.2f", ($all_items / $for_one_coin));
    }

    /*======================================================================*\
    Function:    IpToLong
    Descriiption: Преобразует IP в целочисленное
    \*======================================================================*/
    public function IpToInt($ip)
    {
        $ip = ip2long($ip);
        ($ip < 0) ? $ip+=4294967296 : true;
        return $ip;
    }

    /*======================================================================*\
    Function:    IpToLong
    Descriiption: Преобразует целочисленное в IP
    \*======================================================================*/
    public function IntToIP($int)
    {
        return long2ip($int);
    }

    /*======================================================================*\
    Function:    IsWM
    Output:        True / False
    Input:        Реквизит, TYPE: 0 - WMID, 1 - WMR, 2 - WMZ, 3 - WME, 4 - WMU
    Descriiption: Проверяет правильность ввода пароля
    \*======================================================================*/
    public function IsWM($data, $type = 0)
    {
        $FirstChar = array( 1 => "R",
          2 => "Z",
          3 => "E",
          4 => "U");

        if (strlen($data) < 12 && strlen($data) > 12 && $type < 0 && $type > count($FirstChar)) {
            return false;
        }
        if ($type == 0) {
            return (is_array($data)) ? false : (ereg("^[0-9]{12}$", $data) ? $data : false);
        }
        if (substr(strtoupper($data), 0, 1) != $FirstChar[$type] or !ereg("^[0-9]{12}", substr($data, 1))) {
            return false;
        }
        return $data;
    }

    /*======================================================================*\
    Function:    IpCode
    Output:        String, Example 255025502550255
    Input:        -
    Descriiption: Возвращает IP с замененными знаками "." на "0"
    \*======================================================================*/
    public function IpCode()
    {
        $arr_mask = explode(".", $this->GetUserIp());
        return $arr_mask[0].".".$arr_mask[1].".".$arr_mask[2].".0";
    }

    /*======================================================================*\
    Function:    GetTime
    Descriiption: Возвращаер дату
    \*======================================================================*/
    public function GetTime($tis = 0, $unix = true, $template = "d.m.Y H:i:s")
    {
        if ($tis == 0) {
            return ($unix) ? time() : date($template, time());
        } else {
            return date($template, $unix);
        }
    }

    /*======================================================================*\
    Function:    UserAgent
    Descriiption: Возвращает браузер пользователя
    \*======================================================================*/
    public function UserAgent()
    {
        return $this->TextClean($_SERVER['HTTP_USER_AGENT']);
    }

    /*======================================================================*\
    Function:    TextClean
    Descriiption: Очистка текста
    \*======================================================================*/
    public function TextClean($text)
    {
        $array_find = array("`", "<", ">", "^", '"', "~", "\\");
        $array_replace = array("&#96;", "&lt;", "&gt;", "&circ;", "&quot;", "&tilde;", "");
        return str_replace($array_find, $array_replace, $text);
    }

    /*======================================================================*\
    Function:    ShowError
    Descriiption: Выводит список ошибок строкой
    \*======================================================================*/
    public function ShowError($errorArray = array(), $title = "Correct the following errors")
    {
        if (count($errorArray) > 0) {
            $string_a = "<div class='Error'><div class='ErrorTitle'>".$title."</div><ul>";
            foreach ($errorArray as $number => $value) {
                $string_a .= "<li>".($number+1)." - ".$value."</li>";
            }
            $string_a .= "</ul></div><BR />";
            return $string_a;
        } else {
            return "Unknown error :(";
        }
    }

    /*======================================================================*\
    Function:    ComissionWm
    Descriiption: Возвращает комиссию WM
    \*======================================================================*/
    public function ComissionWm($sum, $com_payee, $com_payysys)
    {
        $a = ceil(ceil($sum * $com_payee * 100) / 10000*100) / 100;
        $b = ceil(ceil($sum * str_replace("%", "", $com_payysys) * 100) / 10000*100) / 100;
        return $a+$b;
    }

    /*======================================================================*\
    Function:    md5Password
    Descriiption: Возвращает md5_пароля
    \*======================================================================*/
    public function md5Password($pass)
    {
        $pass = strtolower($pass);
        return md5("shark_md5"."-".$pass);
    }

    public function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /*======================================================================*\
    Function:    ControlCode
    Descriiption: Возвращает контрольное число
    \*======================================================================*/
    public function ControlCode($time = 0)
    {
        return ($time > 0) ? date("Ymd", $time) : date("Ymd");
    }

    /*======================================================================*\
    Function:    SumCalc
    Descriiption: Возвращает сумму овощей
    \*======================================================================*/
    public function SumCalc($per_h, $sum_tree, $last_sbor)
    {
        if ($last_sbor > 0) {
            if ($sum_tree > 0 and $per_h > 0) {
                $last_sbor = ($last_sbor < time()) ? (time() - $last_sbor) : 0;
                $per_sec = $per_h / 3600;
                return round(($per_sec * $sum_tree) * $last_sbor);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    /*
    * Generate CSRF input
    */
    public function csrf()
    {
        if (@!$_SESSION) {
            session_start();
        }
        $_SESSION['csrf'] = crc32(time()) . md5(time()) . strtoupper(sha1(time())) . strtoupper(md5(time())) . sha1(time());
        echo('<input type="hidden" name="@secury" value="'.$_SESSION['csrf'].'">');
    }

    /*
     * Verify CSRF input
     */
    public function csrfVerify()
    {
        if (@!$_SESSION) {
            session_start();
        }
        $value = filter_input(INPUT_POST, '@secury', FILTER_SANITIZE_STRING);
        if ($value == @$_SESSION['csrf']) {
            unset($_SESSION['csrf']);
            return 'true';
        } else {
            unset($_SESSION['csrf']);
            return 'false';
        }
    }

    public function activeMenu($page, $subpage=null, $class='active')
    {
        if ($page) {
            $url = $_GET['menu'];
            if ($_GET['sel']) {
                $sub = $_GET['sel'];
            } else {
                $sub = null;
            }
            if ($subpage) {
                if ($url == $page && $sub == $subpage) {
                    echo 'class="'.$class.'"';
                }
            } else {
                if ($url == $page && $sub == null) {
                    echo 'class="'.$class.'"';
                }
            }
        }
    }

    public function url($target=null)
    {
        if ($_SERVER['HTTPS'] == "on") {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $base = $protocol.$_SERVER['HTTP_HOST'];
        if ($target) {
            echo $base.'/'.$target;
        } else {
            echo $base;
        }
    }

    public function urlAdmin($target=null)
    {
        if ($_SERVER['HTTPS'] == "on") {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        $base = $protocol.$_SERVER['HTTP_HOST'].'/admin';
        if ($target) {
            echo $base.'/'.$target;
        } else {
            echo $base;
        }
    }

    public function priceFormat($value)
    {
        $config = new Config;
        $code = $config->currency['symbol'];
        $place = $config->currency['symbol_position'];
        $decimals = $config->currency['decimals'];
        $dec_point = $config->currency['dec_point'];
        $thousand_point = $config->currency['thousand_point'];
        if ($place=='left') {
            return $code.' '.number_format($value, $decimals, $dec_point, $thousand_point);
        } else {
            return number_format($value, $decimals, $dec_point, $thousand_point).' '.$code;
        }
    }

    public function price($value)
    {
        $config = new Config;
        $decimals = $config->currency['decimals'];
        $dec_point = $config->currency['dec_point'];
        $thousand_point = $config->currency['thousand_point'];

        return number_format($value, $decimals, $dec_point, $thousand_point);
    }
}
