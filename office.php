<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$officeCode = (int) $_GET["officeCode"];
$sql = "SELECT * FROM offices WHERE officeCode={$officeCode}";
$query = new dbQuery($sql);
$office = $query->next();

if ($office == NULL) {
    header("Location: ./offices.php");
    die();
}

$content =  "<h1>{$office["city"]}</h1>\n"
    . "<section class='top'>\n"
    . "  <h4>Territory: <a href='territory.php?territory={$office["territory"]}'>{$office["territory"]}</a></h4>\n"
    . "  <h4>Country: {$office["country"]}</h4>\n"
    . "  <p>Address: {$office["addressLine1"]} {$office["addressLine2"]}\n"
    . "  <p>Phone: {$office["phone"]}\n"
    . "</section>\n";

$sql2 = "SELECT * FROM employees WHERE employees.officeCode={$officeCode} "
    . "ORDER BY lastName";
$qry2 = new dbQuery($sql2);

$content .= "<section class='top'>\n"
    . "<h2>Employees</h2>\n";
while (($employee = $qry2->next()) != NULL) {
    $link = "<a href='./employee.php?employeeNumber={$employee["employeeNumber"]}'>{$employee["lastName"]}, {$employee["firstName"]}</a>";
    $content .= "<h4>$link ({$employee["jobTitle"]})</h4>";
}
$content .= "</section>\n";

Render($content);
