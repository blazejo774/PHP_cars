<?php

session_start();
require_once 'common.php';
require_once 'template.php';

if(isset($_SESSION["user"]))
{
    $content = "<h1>Ranking</h1>";
    $content .= "<div class='pages'>";
    $content .= "<a href='ranking.php?page=top_sellers'>Top Sellers</a>";
    $content .= "<a href='ranking.php?page=2'>ABC</a>";
    $content .= "<a href='ranking.php?page=3'>ABC2</a>";
    $content .= "</div>";

    $page = $_GET["page"]?? 1;

    if($page == "top_sellers"){
        $content .= "<section>"
            . "<table>"
            . "<caption>Best sellers</caption>"
            . "<tr><th>Employee Number<th>Last Name<th>First Name<th>Total Amount";

        $sql = "SELECT employees.employeeNumber, employees.lastName, employees.firstName, customers.salesRepEmployeeNumber, ROUND(SUM(payments.amount),2) AS totalAmount FROM employees JOIN customers ON employees.employeeNumber = customers.salesRepEmployeeNumber JOIN payments USING(customerNumber) GROUP BY employeeNumber ORDER BY totalAmount DESC";
        $query = new dbQuery($sql);

        while (($ranking = $query->next())  != NULL) {
            $content .="<tr><td>{$ranking["employeeNumber"]}<td>{$ranking["lastName"]}<td>{$ranking["firstName"]}<td>{$ranking["totalAmount"]}";
        }

        $content .= "</table>"
                . "</section>";
    }
    elseif($page == "2"){
        $content .= "<h1>ABC2<h1>";
    }
    elseif($page == "3"){
        $content .= "<h1>ABC3<h1>";
    }
    else{
        $content .= "";
    }
}
else{
    $content = getLoginForm("","Login to get to the page!");
}
Render($content);
