<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$employeeNumber = filter_input(INPUT_GET, "employeeNumber", FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM employees "
    . "JOIN offices USING (officeCode) "
    . "WHERE employeeNumber={$employeeNumber}";
$query = new dbQuery($sql);
$employee = $query->next();

if ($employee == NULL) {
    header("Location: ./employees.php");
    die();
}

$linkOffice = "<a href='office.php?officeCode={$employee["officeCode"]}'>{$employee["city"]}</a>";
$linkTerritory = "<a href='territory.php?territory={$employee["territory"]}'>{$employee["territory"]}</a>";

$content ="<h1>{$employee["lastName"]}, {$employee["firstName"]}</h1>"
    . "<h4>{$employee["jobTitle"]}</h4>"
    . "<section class='top'>"
    . "<p>ID: {$employee["employeeNumber"]}"
    . "<p>Email: {$employee["email"]}"
    . "<p>Office: {$linkOffice}"
    . "<p>Territory: {$linkTerritory}"
    . "</section>";

Render($content);
