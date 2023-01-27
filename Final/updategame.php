<?php



//Do not proceed if there are no post data
if (!$_POST) {
    $error = "Direct access to this script is not allowed.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve book id. Do not proceed if id was not found.
if (!filter_has_var(INPUT_POST, 'games_id')) {
    $error = "There was a problem retrieving game id.";
    header("Location: error.php?m=$error");
    die();
}

$id = filter_input(INPUT_POST, 'games_id', FILTER_SANITIZE_NUMBER_INT);

//include code from the database.php file
require_once('includes/database.php');


$title = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));

$release_date = $conn->real_escape_string(filter_input(INPUT_POST, 'release_date', FILTER_DEFAULT));
$publisher = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)));
$image = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));



//Define MySQL update statement
$sql = "UPDATE $tblGame SET title='$title',
 release_date='$release_date', price=$price,
 image='$image', description='$description', publisher='$publisher'
 WHERE games_id=$id";



//execute the query
$query = $conn->query($sql);

//Handle potential errors
if (!$query) {
    $error = "Update failed: $conn->error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//close the database connection
$conn->close();
header("Location: gamedetails.php?games_id=$id&m=update");

require 'includes/library.php';
if (!is_admin()) {
    $error = "Access to this page is permitted for administrators only.";
    header("Location: error.php?m=$error");
    exit;
}

