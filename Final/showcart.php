<?php

$page_title = "Shopping Cart";
require_once('includes/header.php');
require_once('includes/database.php');

if (!isset($_SESSION['cart']) || !$_SESSION['cart']) {
    echo "Your shopping cart is empty.<br><br>";
    include('includes/footer.php');
    exit();
}

//proceed since the cart is not empty
$cart = $_SESSION['cart'];

//select statement
$sql = "SELECT games_id, title, price FROM games WHERE 0";
foreach (array_keys($cart) as $id) {
    $sql .= " OR games_id=$id";
}

//execute the query
$query = $conn->query($sql);



    ?>
    <h2> My Shopping Cart</h2>
    <!--  display shoxpping cart content -->
    <div class="gamelist">
    <div class="row header">
        <div class="col1">Title</div>
        <div class="col2">Price</div>
        <div class="col3">Quantity</div>
        <div class="col4">Subtotal</div>
    </div>

    <?php

    while ($row = $query->fetch_assoc()) {
        $id = $row['games_id'];
        $title = $row['title'];
        $price = $row['price'];
        $qty = $cart[$id];
        $subtotal = $qty * $price;

        ?>

    <div class="row">
        <div class="col1"><a href='gamedetails.php?id=<?= $id ?>'><?=
                $title ?></a></div>
        <div class="col2">$<?= $price ?></div>
        <div class="col3"><?= $qty ?></div>
        <div class="col4">$<?php printf("%.2f", $subtotal); ?></div>
    </div>
<?php } ?>

    </div>

    <div class="bookstore-button">
        <input type="button" value="Checkout" onclick="window.location.href = 'checkout.php'"/>
        <input type="button" value="Return to List" onclick="window.location.href = 'listgames.php'"/>
        <input type="button" value="Clear" onclick="window.location.href = 'clearcart.php'"/>
        <input type="button" value="Cancel" onclick="window.location.href = 'listgames.php'"/>
    </div>
    <br><br>

    <!-- page footer for copyright information -->
<?php
include('includes/footer.php');
