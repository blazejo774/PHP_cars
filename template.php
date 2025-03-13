<?php

require_once 'common.php';

//-----------------------------------------------------------------------------
// Menu item & subitem
//-----------------------------------------------------------------------------

function getMenuItem($href, $text, $class = "") {
    $cl = ($class == "") ? "" : " class='$class'";
    $mt = "          <li><a href='$href' $cl>$text</a>\n";
    return $mt;
}

//-----------------------------------------------------------------------------
// Menu 
//-----------------------------------------------------------------------------

function getSideMenu() {
    if(isset($_SESSION["user"]))
    {
    // offices & employees
    $mnu = "<li><p>Stuff\n"
        . getMenuItem("offices.php", "Offices")
        . getMenuItem("employees.php", "Employees");
    
    // products
    $mnu .= "<li><p>Products\n"
        . getMenuItem("products.php", "Products")
        . getMenuItem("search.php", "Search")
        . getMenuItem("ranking.php", "Ranking");
    }
    else
    {
    // offices & employees
    $mnu = "";
    }
    // work
    $mnu .= "<li><p>Work\n"
        . getMenuItem("styles.php", "Styles");

    return $mnu;
}

function getMainMenu() {
    // home
    $mnu = getMenuItem("./", "Start");
    
    if(!isset($_SESSION["user"]))
    {
        // login
        $mnu .= getMenuItem("login.php", "Login");
        $mnu .= getMenuItem("register.php", "Register");
    }
    else
    {
        //logout & New Product
        $mnu .= getMenuItem("logout.php", "Logout")
             . getMenuItem("profile.php", "Profile");
        if($_SESSION["role"] == "root" || $_SESSION["role"] == "admin")
        {
            $mnu .= getMenuItem("newproduct.php", "New Product");
        }
    }
    
    return $mnu;
}

//-----------------------------------------------------------------------------
// Login form
//-----------------------------------------------------------------------------

$loginFormTemplate = <<<EOM
  <form action="" method="POST" class="narrow">
    <h1>Login</h1>
    ===error===
    <!-- <label for="login">Login</label> -->
    <input type="text" name="login" id="login" placeholder="Your login" value="===login===" autocomplete="off" required>
    <!-- <label for="pass">Password</label> -->
    <input type="password" name="pass" id="pass" placeholder="Your password" autocomplete="off" required>
    <input type="submit" value="Log in">
  </form>\n
EOM;

function getLoginForm($login = "", $error="") {
    global $loginFormTemplate;

    $errorTr = $error==""? "" : "<label style='color:red'>$error</label>";
    $form = str_replace(
        array("===login===", "===error==="),
        array($login, $errorTr),
        $loginFormTemplate);

    return $form;
}

//-----------------------------------------------------------------------------
// Register form
//-----------------------------------------------------------------------------

$registerFormTemplate = <<<EOM
    
    <form action="" method="POST">
        <h1>Sign Up</h1>
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" autocomplete="off" required>
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" autocomplete="off" required>
        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" autocomplete="off" required>
        <label for="extension">Extension:</label>
        <input type="text" name="extension" id="extension" placeholder="x1111" autocomplete="off" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" autocomplete="off" required>
        <label for="officeCode">Office Code:</label>
        <input type="number" step="1" min="1" max="7" name="officeCode" id="officeCode" value="1" autocomplete="off" required>
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" autocomplete="off" required>
        <label for="pass2">Password Again:</label>
        <input type="password" name="pass2" id="pass2" autocomplete="off" required>
        <input type="submit" id="submit2" onclick='handleAcc()' value="Sign Up">
    </form>
EOM;

function getRegisterForm($login = "", $error="") {
    global $registerFormTemplate;

    $errorTr = $error==""? "" : "<label style='color:red'>$error</label>";
    $form = str_replace(
        array("===login===", "===error==="),
        array($login, $errorTr),
        $registerFormTemplate);

    return $form;
}

//-----------------------------------------------------------------------------
// Selects
//-----------------------------------------------------------------------------

function getReportsToSelect($current="") {
  $select = "<select name='reportsTo' id='reportsTo'>";
  
  $sql = "SELECT reportsTo FROM employees GROUP BY reportsTo";
  $query = new dbQuery($sql);
  while (($employees = $query->next()) != NULL) {
    $scale = $employees["reportsTo"];
    $selected = $scale == $current ? "selected " : "";
    $select .= "<option value='{$scale}' $selected>{$scale}</option>";
  }
  $select .= "</select>";
  return $select;
}

function getjobTitleSelect($current="") {
  $select = "<select name='jobTitle' id='jobTitle'>";
  
  $sql = "SELECT jobTitle FROM employees GROUP BY jobTitle";
  $query = new dbQuery($sql);
  while (($employees = $query->next()) != NULL) {
    $scale = $employees["jobTitle"];
    $selected = $scale == $current ? "selected " : "";
    $select .= "<option value='{$scale}' $selected>{$scale}</option>";
  }
  $select .= "</select>";
  return $select;
}

function getScaleSelect($current="") {
  $select = "<select name='scale' id='scale'>";
  
  $sql = "SELECT productScale FROM products GROUP BY productScale";
  $query = new dbQuery($sql);
  while (($product = $query->next()) != NULL) {
    $scale = $product["productScale"];
    $selected = $scale == $current ? "selected " : "";
    $select .= "<option value='{$scale}' $selected>{$scale}</option>";
  }
  $select .= "</select>";
  return $select;
}

function getLineSelect($current="") {
  $select = "<select name='line' id='line'>";
  
  $sql = "SELECT productLine FROM products GROUP BY productLine";
  $query = new dbQuery($sql);
  while (($product = $query->next()) != NULL) {
    $line = $product["productLine"];
    $selected = $line == $current ? "selected " : "";
    $select .= "<option value='{$line}' $selected>{$line}</option>";
  }
  $select .= "</select>";
  return $select;
}

function getVendorSelect($current="") {
  $select = "<select name='vendor' id='vendor'>";
  
  $sql = "SELECT productVendor FROM products GROUP BY productVendor";
  $query = new dbQuery($sql);
  while (($product = $query->next()) != NULL) {
    $vendor = $product["productVendor"];
    $selected = $vendor == $current ? "selected " : "";
    $select .= "<option value='{$vendor}' $selected>{$vendor}</option>";
  }
  $select .= "</select>";
  return $select;
}

//-----------------------------------------------------------------------------
// Page template
//-----------------------------------------------------------------------------

$pageTemplate = <<<EOM
<?php   
<!DOCTYPE html>
<html>
  <head>
    <title>PAI Scale Models</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./media/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,400;0,600;1,100;1,400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="./js/search.js" crossorigin="anonymous"></script>
    <script src="./js/editMode.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <h2 style="margin-bottom:0px;">PAI Scale Models</h2>
      <p style="margin-top:0px; font-size: 10pt;">Błażej Osowski</p> 
      <p style="margin-top:0px; font-size: 11pt;">===UserInfo===</p>
    </header>
    <nav>
      <ul>
        <!-- Main menu -->
        ===MainMenu===
        <!-- Main menu -->
      </ul>
    </nav>

    <div class="grid-container">

      <aside>
        <ul>
          <!-- Side menu -->
          ===SideMenu===
          <!-- Side menu -->
        </ul>
      </aside>

      <main>
        <!-- Contents -->
        ===LOG_INFO===
        ===Contents===
        <!-- Contents -->
      </main>
    </div>
  </body>
</html>
EOM;

function Render($pageContent) {
    
    global $pageTemplate;
    
    if(isset($_SESSION["user"])){
        $user = $_SESSION["name"];
    }
    else{
        $user ="";
    }
    $page = str_replace(
        array("===MainMenu===", "===SideMenu===", "===Contents===", "===UserInfo===", "===LOG_INFO==="),
        array(getMainMenu(), getSideMenu(), $pageContent, $user),
        
        $pageTemplate);

    echo $page;
}