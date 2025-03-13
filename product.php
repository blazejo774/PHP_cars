<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$productCode = $_GET["productCode"];

$sql = "SELECT * FROM products WHERE  productCode='{$productCode}'";
$query = new dbQuery($sql);

$product = $query->next();

$content = "<h1> {$product["productName"]}</h1>"
        . "<section>"
        . "<p>{$product["productDescription"]}"
        . "<h4>Product Vendor:</h4> {$product["productVendor"]}"
        . "<h4>Cost :</h4> $ {$product["MSRP"]}"
        . "<h4>Line: </h4>{$product["productLine"]}"
        . "<h4>Scale: </h4> {$product["productScale"]}"
        . "<p class='figure'><img src='./images/{$product["productCode"]}.jpg'></p>"
        . "</section>";

Render($content);
