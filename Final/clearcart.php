<?php





if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//empty the shopping cart
$_SESSION['cart'] = array();
//set page title
$page_title = "Clear Cart";
//display the header


require_once ('includes/header.php');

?>
<h2>Cleared</h2>
<p>Your shopping cart has been cleared! no Games have been bought.
</p>
<div class="bookstore-button">
    <input type="button" value="Return to Cart" onclick="window.location.href = 'showcart.php'"/>
    <input type="button" value="Return to Games List" onclick="window.location.href = 'listgames.php'"/>
</div>

<?php
include ('includes/footer.php');
?>
