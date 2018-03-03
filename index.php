<?php

//require config file
require('./includes/config.inc.php');

//include header:
$page_title = 'Coffee - Wouldn\'t You Love a Cup Right Now?';
include('./includes/header.html');

//require DB connection:
require(MYSQL);

//call select_sale_items function
$r = mysql_query($dbc, "CALL select_sale_items(false)");

//include home page view:
include('./views/home.html');

//include footer:
include('./includes/footer.html');
?>
