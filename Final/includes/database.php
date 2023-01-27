<?php

/**
 * Author: Jacob Catalan
 * Date: 11/1/2022
 * File: database.php
 * Description:
 */

$host = "localhost";
$login = "phpuser"; //use different account if necessary
$password = "phpuser"; //use the correct password for the account
$database = "gamewebsite_db"; //database name
$tblGame = "games";
$tblGenre = "genre";


//Connect to the mysql server
$conn = @new mysqli($host, $login, $password, $database);

//Handle connection errors
if ($conn->connect_errno) {
    $error = $conn->connect_error;
    header("Location: error.php?m=$error");
    die();
}
