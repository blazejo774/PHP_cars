<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$content = "<h1>PAI Scale Models</h1>";

unset($_SESSION["user"]);

$content .= "<h2>Wylogowano pomyślnie!</h1>";

Render($content);
