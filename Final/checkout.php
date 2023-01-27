<?php

/**
 * Author: your name
 * Date: 11/29/2022
 * File: checkout.php
 * Description:
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//empty the shopping cart
$_SESSION['cart'] = array();
//set page title
$page_title = "Checkout";
//display the header


require_once ('includes/header.php');

?>
<h2>Checkout</h2>
<p>Thank you for shopping with us. Your business is greatly appreciated. You will
    be notified once your items are shipped.
</p>

<?php
include ('includes/footer.php');
?>
