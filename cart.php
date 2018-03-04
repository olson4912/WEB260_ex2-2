<?php
require('./includes/config.inc.php');

//check for or create a user identifier:
if (isset($_COOKIE['SESSION']) && (strlen($_COOKIE['SESSION']) === 32)) {
	$uid = $_COOKIE['SESSION'];
} else {
	$uid = openssl_random_pseudo_bytes(16);
	$uid = bin2hex($uid);
}

//send the cookie:
setcookie('SESSION', $uid, time()+(60*60*24*30), '/', 'wcet3.waketech.edu/caolson/WEB260/ex2-2/');

//set page title and include header:
$page_title = 'Coffee - Your Shopping Cart';
include('./includes/header.html');

//require DB connection and functions file:
require(MYSQL);
include('./includes/product_functions.inc.php');

//if there is a SKU value in the URL, break it down into parts:
if (isset($_GET['sku'])) {
	list($type, $pid) = parse_sku($_GET['sku']);
}

//check for a product to be added to the cart:
if (isset($pid, $type, $_GET['action']) && ($_GET['action'] === 'add') ) {
	$r = mysqli_query($dbc, "CALL add_to_cart('$uid', '$type', $pid, 1)");
} elseif (isset($type, $pid, $_GET['action']) && ($_GET['action'] === 'remove') ) {
  //if there is an item to remove from cart
	$r = mysqli_query($dbc, "CALL remove_from_cart('$uid', '$type', $pid)");
} elseif (isset($type, $pid, $_GET['action'], $_GET['qty']) && ($_GET['action'] === 'move') ) {
  //if there is a product to be moved into cart from wish list
	$qty = (filter_var($_GET['qty'], FILTER_VALIDATE_INT, array('min_range' => 1)) !== false) ? $_GET['qty'] : 1;
	$r = mysqli_query($dbc, "CALL add_to_cart('$uid', '$type', $pid, $qty)");
	$r = mysqli_query($dbc, "CALL remove_from_wish_list('$uid', '$type', $pid)");
} elseif (isset($_POST['quantity'])) { //check for form submission
	//loop through each item:
	foreach ($_POST['quantity'] as $sku => $qty) {
		list($type, $pid) = parse_sku($sku);
		if (isset($type, $pid)) {
			$qty = (filter_var($qty, FILTER_VALIDATE_INT, array('min_range' => 0)) !== false) ? $qty : 1;
			$r = mysqli_query($dbc, "CALL update_cart('$uid', '$type', $pid, $qty)");
		}
	}

}//End of main IF.

//retrieve the cart's contents:
$r = mysqli_query($dbc, "CALL get_shopping_cart_contents('$uid')");

//include the appropriate view
if (mysqli_num_rows($r) > 0) {
	include('./views/cart.html');
} else {
	include('./views/emptycart.html');
}

//complete the page:
include('./includes/footer.html');

?>
