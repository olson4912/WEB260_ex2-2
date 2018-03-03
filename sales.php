<?php

//require config file
require('./includes/config.inc.php');

//set page title and include header:
$page_title = 'Sale Items';
include('./includes/header.html');

//require DB connection:
require(MYSQL);
//call select_sale_items function
$r = mysqli_query($dbc, 'CALL select_sale_items(true)');

//if you get sale products, display them
if (mysqli_num_rows($r) > 0){
  include('./views/list_sales.html');
} else {
  include('./views/noproducts.html');
}

//include footer:
include('./includes/footer.html');
?>
