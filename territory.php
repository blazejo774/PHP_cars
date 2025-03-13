<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$territory = $_GET["territory"];
$content = "<h1>Territory {$territory}</h1>\n";

$sql = "SELECT * FROM offices WHERE territory='{$territory}' ORDER BY city";
$query = new dbQuery($sql);

while (($office = $query->next()) != NULL) {
    $link = "<a href='office.php?officeCode={$office["officeCode"]}'>{$office["city"]}</a>";
    $content .= "<section class='top'>"
        . "<h2>$link ({$office["country"]})</h2>\n";

    $sqli = "SELECT * FROM employees WHERE officeCode={$office["officeCode"]} "
        . "ORDER BY lastName, firstName";
    $qryi = new dbQuery($sqli);
    
    while (($employee = $qryi->next()) != NULL) {
        $link = "<a href='./employee.php?employeeNumber={$employee["employeeNumber"]}'>{$employee["lastName"]}, {$employee["firstName"]}</a>";
        $content .= "<h4>$link ({$employee["jobTitle"]})</h4>";
    }
    $content .= "</section>";
}

Render($content);
