<?php

session_start();
require_once 'common.php';
require_once 'template.php';

if(isset($_SESSION["user"]))
{
    $content = "<h1>PAI Scale Models</h1>";

    $sql = "SELECT COUNT(*) AS number FROM products";
    $query = new dbQuery($sql);
    $row = $query->next();
    $number = $row["number"];
    $pages = (int)(($number-1)/10)+1;
    $page = $_GET["page"]?? 1;

    $content .= "<div class='pages'>";
    for($p=1; $p<=$pages; $p++)
    {
        if($p==$page){
         $content .= "<a href='products.php?page={$p}' class='current'>{$p}</a>";   
        }
        else{
            $content .= "<a href='products.php?page={$p}'>{$p}</a>";
        }
    }
    $content .= "</div>";

    $start = ($page-1)*10;
    $sql = "SELECT * FROM products LIMIT {$start}, 10";
    $query = new dbQuery($sql);

    while (($product = $query->next())  != NULL) {
        $link = "<a href='product.php?productCode={$product["productCode"]}'>{$product["productName"]}</a>";

        $content .= "<section class='thumb'>"
                . "<div>"
                . "<p>{$link}"
                . "</div>"
                . ""
                . "<div>"
                . "<img src='./images/{$product["productCode"]}.jpg'>"
                . "</div>"
                . "</section>";
    }
}
else{
    $content = getLoginForm("","Login to get to the page!");
}
Render($content);
