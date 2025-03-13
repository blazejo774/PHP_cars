<?php

session_start();
require_once 'common.php';
require_once 'template.php';

if(isset($_SESSION["user"]))
{
    $content = "<h1>Offices</h1>\n";

    $sql = "SELECT * FROM offices ORDER BY city";
    $query = new dbQuery($sql);

    while (($office = $query->next()) != NULL) {

        $link = "<a href='office.php?officeCode={$office["officeCode"]}'>{$office["city"]}</a>";

        $content .= "<section class='top'>\n"
            . "  <h2>$link ({$office["country"]})</h2>\n"
            . "  <p>{$office["addressLine1"]} {$office["addressLine2"]}, {$office["country"]}\n"
            . "  <p>tel.: {$office["phone"]}\n"
            . "</section>\n"
            . "";
    }
}
else{
    $content = getLoginForm("","Login to get to the page!");
}
Render($content);
