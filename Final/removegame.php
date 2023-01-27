<?php


$page_title = "Delete game";
require_once 'includes/header.php';
require_once('includes/database.php');

//if book id cannot retrieved, terminate the script.
if (!filter_has_var(INPUT_GET, 'games_id')) {
    $error = "There was a problem retrieving game id.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve book id from a query string variable.
$id = filter_input(INPUT_GET, 'games_id', FILTER_SANITIZE_NUMBER_INT);

//add your code here

//Define MySQL delete statement
$sql = "DELETE FROM $tblGame WHERE games_id=$id";

//execute the query and handle errors
$query = @$conn->query($sql);
if (!$query) {
    $error = "Deletion failed: $conn->error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

echo "<p>The Game has been successfully deleted from the database.</p>";
$conn->close();
require_once 'includes/footer.php';

require 'includes/library.php';
if (!is_admin()) {
    $error = "Access to this page is permitted for administrators only.";
    header("Location: error.php?m=$error");
    exit;
}
