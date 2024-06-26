<?php

session_start();
require_once 'common.php';
require_once 'template.php';

if (isset($_POST["login"])) {
    //formularz wypełniony
    
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $sql = "SELECT * FROM `employees` WHERE login = '{$login}' AND pass = '{$pass}'";
    $query = new dbQuery($sql);
    $user = $query->next();
    
    if($user == null)
    {
        $content = getLoginForm($login, "Wrong login or password, try again!");
    }
    else{
        $_SESSION["user"] = $user;
        $content = "<h1> Witaj {$user["firstName"]}!</h1>";
        $_SESSION["name"] = $user["firstName"]." ".$user["lastName"]." Role: ".$user["role"];
        $_SESSION["employeeNumber"] = $user["employeeNumber"];
        $_SESSION["role"] = $user["role"];
    }
}
else {
    //
    $content = getLoginForm();
}

Render($content);
