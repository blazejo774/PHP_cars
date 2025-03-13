<?php

session_start();
require_once 'common.php';
require_once 'template.php';

if(isset($_SESSION["user"]))
{
    $content = "<h1>Search PAI Scale Models</h1>
        <div>
        <form style='border:0;'>
          <input type='text' id='search' placeholder='What are you looking for?'>
        </form>
        </div>
        <div id='searchres'>
        </div>";
}
else{
    $content = getLoginForm("","Login to get to the page!");
}
Render($content);
