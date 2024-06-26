<?php

session_start();
require_once 'common.php';
require_once 'template.php';

$content = <<<EOM

          <h1>Styles</h1>
        
          <section>
            <h1>Header h1</h1>
            <h2>Header h2 <a href="">link</a></h2>
            <h3>Header h3</h3>
            <h4>Header h4</h4>
            <p>Paragraph <a href="">link</a></p>
          </section>
        
          <section>
            <div class='pages'>
              <a href=''>1</a><a href=''>2</a><a class='current' href=''>3</a><a href=''>4</a>
            </div>
          </section>
        
          <section class='thumb'>
            <div>
              <h2>1936 Mercedes-Benz 500K</h2>
              <p>Vendor: Studio M Art Models
              <p>Line: Vintage Cars
            </div>
            <div>
              <img src='./images/S18_1367.jpg'>
            </div>
          </section>
        
          <section>
            <h2>1936 Mercedes-Benz 500K</h2>
            <p>Vendor: Studio M Art Models
            <p>Line: Vintage Cars
            <p class='figure'><img src='./images/S18_1367.jpg'></p>
          </section>
        
          <section>
            <table>
              <caption>Best sellers</caption>
              <tr><th>Name<th>Line<th>Scale
              <tr><td>1936 Mercedes Benz 500k Roadster<td>Vintage Cars<td>1:24
              <tr><td>1954 Greyhound Scenicruiser<td>Trucks and Buses<td>1:32
              <tr><td>1969 Harley Davidson Ultimate Chopper<td>Motorcycles<td>1:10
              <tr><td>1970 Dodge Coronet<td>Classic Cars<td>1:24
            </table>;
          </section>
        
          <section>
            <form action="" method="POST" class="narrow">
              <h1>Login</h1>
              <input type="text" name="login" id="login" placeholder="Your login" value="" autocomplete="off" required>
              <input type="password" name="pass" id="pass" placeholder="Your password" autocomplete="off" required>
              <input type="submit" value="Log in">
            </form>\n
          </section>
    EOM;
        
$scale = getScaleSelect();
$line = getLineSelect();
$vendor = getVendorSelect();

$content .= <<<EOM

          <section>
            <form action="" method="POST">
              <h1>Add product</h1>
              <label for="name">Name</label>
              <input type="text" name="name" id="name" placeholder="Product name" value="" autocomplete="off" required>
              <label for="scale">Scale</label>
              {$scale}
              <label for="line">Line</label>
              {$line}
              <label for="vendor">Vendor</label>
              {$vendor}
              <label for="desc">Description</label>
              <textarea name="desc" id="desc" placeholder="Product description" autocomplete="off" required></textarea>
              <input type="submit" value="Save">
            </form>
          </section>

    EOM;

Render($content);
