<?php

session_start();
require_once 'common.php';
require_once 'template.php';

if(isset($_SESSION["user"]))
{
    $content = "<h1>Employees</h1>\n";

    $sql = "SELECT * FROM employees ORDER BY lastName, firstName";
    $query = new dbQuery($sql);

    $content .= "<section class='top'>\n";
    while (($employee = $query->next()) != NULL) {
        $link = "<a href='./employee.php?employeeNumber={$employee["employeeNumber"]}'>{$employee["lastName"]}, {$employee["firstName"]}</a>";
        $content .= "<h4>$link ({$employee["jobTitle"]})</h4>";
    }
    $content .= "</section>\n";
}
else{
    $content = getLoginForm("","Login to get to the page!");
}
Render($content);
