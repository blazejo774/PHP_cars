<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$sql = "SELECT * FROM `employees` WHERE employeeNumber='{$_SESSION["employeeNumber"]}'";
$query = new dbQuery($sql);
$user = $query->next();
   
$content = "<!-- Modal HTML -->
    <div id='alert' class='modal'>
        <div class='modal-content'>
            <span class='close' onclick='closeModal()'>&times;</span>
            <p id='modal-content-text'></p>
            <button class='modal-button' onclick='closeModal()'>OK</button>
        </div>
    </div>";
    
$content .= "<div id='viewMode' style='display: block;'>"
        . "<h1>{$user["firstName"]} {$user["lastName"]}</h1>"
        . "<p><img src='./images/profile.png' width='20%' height='22%'></p>"
        . "<h4>Extension: </h4> {$user["extension"]}"
        . "<h4>E-mail:</h4> {$user["email"]}"
        . "<h4>Office Code:</h4> {$user["officeCode"]}"
        . "<h4>Reports To: </h4> {$user["reportsTo"]}"
        . "<h4>Job Title: </h4> {$user["jobTitle"]}"
        . "<div><button onclick='toggleEditMode()'>Edytuj</button></div></div>";

$jobTitle = getjobTitleSelect($user["jobTitle"]);
$reportsTo = getReportsToSelect($user['reportsTo']);
$content .= "<div id='editMode' style='display: none;'>
        <form method='post'>
                <h4>First Name: </h4><input type='text' name='firstName' value='{$user['firstName']}'/>
                <h4>Last Name: </h4><input type='text' name='lastName' value='{$user['lastName']}' />
                <h4>Extension: </h4> <input type='text' name='extension' value='{$user['extension']}' />
                <h4>E-mail:</h4> <input type='email' name='email' value='{$user['email']}' />
                <h4>Office Code:</h4> <input type='number' step='1' min='1' max='7' name='officeCode' id='officeCode' value='{$user['officeCode']}' autocomplete='off' required />
                <h4>Reports To: </h4> $reportsTo
                <h4>Job Title: </h4> $jobTitle
                <button type='submit' name='save' onclick='handleSave()'>Save</button>
                <button type='button' onclick='handleCancel()'>Cancel</button>
        </form>
    </div>";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["save"])) {
        
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $extension = $_POST["extension"];
        $email = $_POST["email"];
        $officeCode = $_POST["officeCode"];
        $reportsTo = $_POST["reportsTo"];
        $jobTitle = $_POST["jobTitle"];

        $user["firstName"] = $firstName;
        $user["lastName"] = $lastName;
        $user["extension"] = $extension;
        $user["email"] = $email;
        $user["officeCode"] = $officeCode;
        $user["reportsTo"] = $reportsTo;
        $user["jobTitle"] = $jobTitle;
        
        $sql = "UPDATE `employees` SET lastName='$lastName',firstName='$firstName',extension='$extension',email='$email',officeCode='$officeCode',reportsTo='$reportsTo',jobTitle='$jobTitle' WHERE employeeNumber='{$_SESSION["employeeNumber"]}'";
        $query = new dbQuery($sql);
        sleep(2.5);
        header("Location:./profile.php");
    }
Render($content);
