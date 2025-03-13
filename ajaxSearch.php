<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$what = $_GET["what"];

$sql = "SELECT * FROM products WHERE productName LIKE '%{$what}%'";
$query = new dbQuery($sql);

$content = "";
while (($product = $query->next()) != NULL) {
    $link = "<a href='product.php?productCode={$product["productCode"]}'>{$product["productName"]}";
    $content .= "<h2>{$link}</h2>\n"
            . "<section class='thumb'>\n"
            . "<div>\n"
            . "<p>{$product["productScale"]}, {$product["productLine"]}\n"
            . "</div>\n"
            . "<div>\n"
            . "<img src='./images/{$product["productCode"]}.jpg'>\n"
            . "</div>\n"
            . "</section>\n"
            . "";
}

echo $content;
