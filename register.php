<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$content = "";

if (isset($_POST['login'])) {
    //formularz wypełniony
     $login = $_POST['login'];
     $firstName = $_POST['firstName'];
     $lastName = $_POST['lastName'];
     $extension = $_POST['extension'];
     $email = $_POST['email'];
     $officeCode = $_POST['officeCode'];
     $pass = $_POST['pass'];
     $pass2 = $_POST['pass2'];
     
     $sql = "SELECT * FROM employees WHERE login='$login'";
     $query = new dbQuery($sql);
     $sum = $query->next();
     if($sum !== null)
     {
         $content .= "<p>Jest już taki login";
         $content .= getRegisterForm();
     }
     elseif ($pass !== $pass2 )
     {
         $content .= "<p>Hasła się nie zagdzają";
         $content .= getRegisterForm();
     }
     else{
         $content .= "<p>Konto stworzone";
         $content .= getRegisterForm();
         $sql = "INSERT INTO employees (lastName,firstName,extension,email,officeCode,login,pass)
                 VALUES ('$lastName','$firstName','$extension','$email','$officeCode','$login','$pass')";
         $query = new dbQuery($sql);
         $query->next();
     }
}
else
{
    $content .= getRegisterForm();
}

Render($content);