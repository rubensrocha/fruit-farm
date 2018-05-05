<?php
/*
 * Script Fruit-Farm SM
 * Author: Smarty Scripts
 * Author Site: www.smartyscripts.com
 * Official Site: https://github.com/rubensrocha/fruit-farm
 */

class Isender
{
    
    var $Hosts = "";
    
    /*======================================================================*\
    Function:    __construct
    Descriiption: Конструктор класса
    \*======================================================================*/
    function __construct()
    {
        $this->Hosts = str_replace("www.", "", $_SERVER['HTTP_HOST']);
    }
    
    /*======================================================================*\
    Function:    SendRegKey
    Descriiption: Отправляет регистрационный ключ
    \*======================================================================*/
    function SendRegKey($mail, $key)
    {
        $text = "Your email has been requested a link to register with the system \"".$this->Hosts."\"<BR />";
        $text.= "If you did not request a link, simply ignore this message. <BR /><BR />";
        $text.= "Link for registration: <a href='http://".$this->Hosts."/signup/key/{$key}'>";
        $text.= "http://".$this->Hosts."/signup/key/{$key}</a>";
        $subject = "Registration in the system \"".$this->Hosts."\"";
        return $this->SendMail($mail, $subject, $text);
    }
    
    /*======================================================================*\
    Function:    RecoveryPassword
    Descriiption: Восстановление пароля
    \*======================================================================*/
    function RecoveryPassword($user, $hash, $mail)
    {
        $text = "Hello {$user}.<BR /><BR />";
        $text.= "You are receiving this email because we received a password reset request for your account.<BR /><BR />";
        $text.= "Reset Password: <a href='http://".$this->Hosts."/recovery/{$hash}'>http://".$this->Hosts."/recovery/{$hash}</a><BR /><BR />";
        $text.= "If you did not request a password reset, no further action is required.";
        $subject = "Reset Password in the system {$this->Hosts}";
        return $this->SendMail($mail, $subject, $text);
    }
    
    /*======================================================================*\
    Function:    SendAfterReg
    Descriiption: Отправляет данные после регистрации
    \*======================================================================*/
    function SendAfterReg($user, $mail, $pass)
    {
        $text = "Thank you for registering with the system in the system \"".$this->Hosts."\"<BR />";
        $text.= "Your login details: <BR />";
        $text.= "<b>Login:</b> {$user}<BR />";
        $text.= "<b>Password:</b> {$pass}<BR />";
        $text.= "Link to enter the office: <a href='http://".$this->Hosts."/'>http://".$this->Hosts."/</a>";
        $subject = "Completion of registration in the system \"".$this->Hosts."\"";
        return $this->SendMail($mail, $subject, $text);
    }
    
    /*======================================================================*\
    Function:    SetNewPassword
    Descriiption: Отправляет данные после смены пароля
    \*======================================================================*/
    function SetNewPassword($user, $pass, $mail)
    {
        $text = "Your password has been changed in your account settings<BR />";
        $text.= "Your new data to enter the user's personal area: <BR />";
        $text.= "<b>Login:</b> {$user}<BR />";
        $text.= "<b>New password:</b> {$pass}<BR />";
        $text.= "Link to enter the office: <a href='http://".$this->Hosts."/'>http://".$this->Hosts."/</a>";
        $subject = "Changing the password in the system \"".$this->Hosts."\"";
        return $this->SendMail($mail, $subject, $text);
    }
    
    
    /*======================================================================*\
    Function:    Headers
    Descriiption: Создание заголовков письма
    \*======================================================================*/
    function Headers()
    {
        $headers = "MIME-Version: 1.0\r\n";
        $headers.= "Content-type: text/html; charset=UTF-8\r\n";
        $headers.= "Date: ".date("m.d.Y (H:i:s)", time())."\r\n";
        $headers.= "From: support@".$this->Hosts." \r\n";
        return $headers;
    }

    /*======================================================================*\
    Function:    SendMail
    Descriiption: Отправитель
    \*======================================================================*/
    function SendMail($recipient, $subject, $message)
    {
        $message .= "<BR />----------------------------------------------------
		<BR />This is an automated message, please do not reply to it!";
        return (mail($recipient, $subject, $message, $this->Headers())) ? true : false;
    }
}
?>
