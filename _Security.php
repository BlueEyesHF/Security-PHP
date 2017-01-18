<?php
session_start();
date_default_timezone_set("Asia/Tokyo");

class Security {
    
    function Load($Type){
        if ($Type == "XSS"){
            return new XSS;
        }else if ($Type == "CSRF"){
            return new CSRF;
        }else if ($Type == "Cookie"){
            return new Cookie;
        }else if ($Type == "Cookie"){
            return new Cookie;
        }
    }
    
}

class Cookie {
    
    Function Start(){
        setcookie('_Cookie', hash('sha512', $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
    }
    
    Function Check(){
        if (!isset($_COOKIE["_Cookie"]))
            return false;
        if ($_COOKIE["_Cookie"] != hash('sha512', $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']))
            return false;
        return true;
    }
}

class XSS {
    
    function Write($Texte){
        return htmlspecialchars($Texte);
    }
}

class CSRF {
    function Formulaire(){
        $Token = uniqid();
        $_SESSION['_CSRF'] = $Token;
        echo '<input type="hidden" name="_CSRF" value="'.hash('sha512', $Token.$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].date('jnyH')).'"><input type="hidden" name="_CSRF_Token" value="'.$Token.'">';
    }
    
    function Check(){
        
        if (!isset($_POST['_CSRF_Token']))
            return false;
        
        if ($_SESSION['_CSRF'] != $_POST['_CSRF_Token'])
            return false;
        
        $Protection_code = hash('sha512', $_SESSION['_CSRF'].$_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].date('jnyH'));
        if ($Protection_code != $_POST['_CSRF'])
            return false;
        
        return true;
        
    }
}

