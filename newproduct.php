<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$content = "<h1>Products</h1>";

if(isset($_SESSION["user"]) || $_SESSION["role"] == "root" || $_SESSION["role"] == "admin")
{
    $scale = getScaleSelect();
    $line = getLineSelect();
    $vendor = getVendorSelect();
    
    $product = "";
    
    if (isset($_GET['product']) && $_GET['product'] == 'added')
    {
    $product = "<p color='red'>New product added successfully!</p>";
    }
    
    $content .= "{$product}";
    
    $content .= <<<EOM

          <section>
            <form action="./add_product.php" method="POST">
              <h1>Add product</h1>
              <label for="productCode">Code</label>
              <input type="text" name="productCode" id="productCode" placeholder="Product Code" value="" autocomplete="off" required>
              <label for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="Product name" value="" autocomplete="off" required>
              <label for="line">Line</label>
              {$line}
              <label for="scale">Scale</label>
              {$scale}
              <label for="vendor">Vendor</label>
              {$vendor}
              <label for="desc">Description</label>
              <textarea name="desc" id="desc" placeholder="Product description" autocomplete="off" required></textarea>
              <label for="buyPrice">Buy Price</label>
              <input type="number" step="0.01" min="0.1" name="buyPrice" id="buyPrice" placeholder="Price" value="" autocomplete="off" required>
              <label for="MSRP">MSRP</label>
              <input type="number" step="0.01" min="0.1" name="MSRP" id="MSRP" placeholder="Cost" value="" autocomplete="off" required>
              <input type="submit" name="submit" value="Save">
            </form>
          </section>

    EOM;
}
else{
    $content = getLoginForm("","Login to get to the page!");
}

Render($content);
