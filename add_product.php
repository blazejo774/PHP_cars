<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$content = "<h1>PAI Scale Models</h1>";

$conn = new mysqli("localhost", "boso", "kernel21", "boso");

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}
// Funkcja do wykonywania zapytań SQL
function executeQuery($sql) {
    global $conn;
    $result = $conn->query($sql);
    if ($result === true) {
        return true;
    } elseif ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

if($_POST['submit'] == "Save")
{    
     $productCode = $_POST['productCode'];
     $name = $_POST['name'];
     $line = $_POST['line'];
     $scale = $_POST['scale'];
     $vendor = $_POST['vendor'];
     $desc = $_POST['desc'];
     $buyPrice = $_POST['buyPrice'];
     $MSRP = $_POST['MSRP'];

     $sql = "INSERT INTO products (productCode,productName,productLine,productScale,productVendor,productDescription,quantityInStock,buyPrice,MSRP)
     VALUES ('$productCode','$name','$line','$scale','$vendor', '$desc','0','$buyPrice','$MSRP')";
          
     executeQuery($sql);
     
     header('Location: ./newproduct.php?product=added');
}
else
{}

$conn->close();

Render($content);
