<?php
$color = ''; //background color
if (isset($_GET['color'])) {
    $color = $_GET['color'];
    setcookie('color', $color);
} else if (isset($_COOKIE['color'])) {
    $color = $_COOKIE['color'];
}
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$count = 0;

//retrieve cart content
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    if ($cart) {
        $count = array_sum($cart);
    }
}

//set shopping cart image
$shoppingcart_img = (!$count) ? "shoppingcart_empty.gif" : "shoppingcart_full.gif";

//variables for a user’s login, name, and role
$login = '';
$name = '';
$role = 0;

//if the use has logged in, retrieve login, name, and role.
if (isset($_SESSION['login']) and isset($_SESSION['name']) and
    isset($_SESSION['role'])) {
    $login = $_SESSION['login'];
    $name = $_SESSION['name'];
    $role = $_SESSION['role'];
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link type="text/css" rel="stylesheet" href="www/css/gamestorestyle.css"/>
    <title><?php echo $page_title; ?></title>
</head>
<body>
<div id="wrapper">
    <div id="curdate">
        <?php
        date_default_timezone_set('America/New_York');
        echo date("l, F d, Y", time());

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $count = 0;

        //retrieve cart content
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            if ($cart) {
                $count = array_sum($cart);
            }
        }

        ?>
    </div>

    <!-- navigation bar -->
    <div id="navbar">
        <img src="www/img/cd.png"> <a href="index.php">Home</a> ||
        <img src="www/img/cd.png"> <a href="listgames.php">List Games</a> ||
        <img src="www/img/cd.png"> <a href="searchgames.php">Search</a> ||
        <?php
        if ($role == 1) {
            echo "<a href='addbook.php'>Add Book</a> || ";
        }
        if (empty($login))
            echo "<a href='loginform.php'>Login</a>";
        else {
            echo "<a href='logout.php'>Logout</a>";
            echo "<span style='color:red; margin-left:30px'>Welcome $name!</span>";
        }
        ?>
    </div>
    <!--shopping cart-->


    <!-- Logo image and banner text -->
    <div id="banner">
        <div class="logo">
            <img src="img/game.png" alt="GameBase">
        </div>
        <div class="banner-text">
            <div id="maintitle">GameBase</div>
            <div id="subtitle"> Top rated game presenter <br>Your insightful game decisions</div>
        </div>
        <div class="shoppingcart">
            <?php
            if (empty($login)) {
                echo "<a href='loginform.php'>";
                echo "<img src='www/img/img.png' style='border:none; width:50px'>";
                echo "<br>";
                echo "<span> $count item(s)</span>";
                echo "</a>";
            } else {
                echo "<a href='showcart.php'>";
                echo "<img src='www/img/img.png' style='border:none; width:50px'>";
                echo "<br>";
                echo "<span> $count item(s)</span>";
                echo "</a>";
            }
            ?>


        </div>

    </div>
    <!-- main content body starts -->
    <div id="mainbody" style="background-color:<?= $color ?>">