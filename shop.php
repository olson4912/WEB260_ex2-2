<?php
//include config file
require('./includes/config.inc.php');

//validate the product type:
if (isset($_GET['type']) && ($_GET['type'] === 'goodies')) {
	$page_title = 'Our Goodies, by Category';
	$type = 'goodies';
} else {
	$page_title = 'Our Coffee Products';
	$type = 'coffee';
}

//include header and DB connection:
include('./includes/header.html');
require(MYSQL);

//Call stored procedures;
$r = mysqli_query($dbc, "CALL select_categories('$type')");
//for debugging:
//if (!$r) echo mysqli_error($dbc);

//if records were returned, include the view file:
if (mysqli_num_rows($r) > 0) {
	include('./views/list_categories.html');
} else {
	include('./views/error.html');
}
//complete the page
include('./includes/footer.html');

 ?>
