<?php


//Do not proceed if there are no post data
if (!$_POST) {
    $error = "Direct access to this script is not allowed.";
    header("Location: error.php?m=$error");
    die();
}

//if the script did not received post data, display an error message and then terminite the script immediately
if (!filter_has_var(INPUT_POST, 'title') ||
    !filter_has_var(INPUT_POST, 'genre_id') ||
    !filter_has_var(INPUT_POST, 'publisher') ||
    !filter_has_var(INPUT_POST, 'price') ||
    !filter_has_var(INPUT_POST, 'image') ||
    !filter_has_var(INPUT_POST, 'description')) {

    echo "There were problems retrieving game details. New game cannot be added.";
    header("Location: error.php?m=$error");
    die();
}

//include code from database.php file
require_once('includes/database.php');

/* Retrieve book details.
 * For security purpose, call the built-in function real_escape_string to
 * escape special characters in a string for use in SQL statement.
 */
$title = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
$genre_id = $conn->real_escape_string(filter_input(INPUT_POST, 'genre_id', FILTER_DEFAULT));
$release_date = $conn->real_escape_string(filter_input(INPUT_POST, 'release_date', FILTER_DEFAULT));
$publisher = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'publisher', FILTER_SANITIZE_STRING)));
$price = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)));
$image = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING)));
$description = $conn->real_escape_string(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));

//add your code below

//Define MySQL insert statement
$sql = "INSERT INTO $tblGame VALUES (NULL, '$title',
'$publisher', '$release_date', $price, '$description', '$genre_id', '$image')";

//execute the query
$query = @$conn->query($sql);
//Handle potential errors
if (!$query) {
    $error = "Insertion failed: $conn->error.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//determine the book id
$id = $conn->insert_id;

//close the database connection
$conn->close();
header("Location: gamedetails.php?games_id=$id&m=insert");
//require 'includes/library.php';
//if (!is_admin()) {
//    $error = "Access to this page is permitted for administrators only.";
//    header("Location: error.php?m=$error");
//    exit;
//}