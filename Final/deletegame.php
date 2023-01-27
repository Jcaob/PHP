<?php

$page_title = "Confirm Game Deletion";
require_once('includes/header.php');
require_once('includes/database.php');

//if Game id cannot retrieved, terminate the script.
if (!filter_has_var(INPUT_GET, 'games_id')) {
    $error = "There was a problem retrieving game id.";
    header("Location: error.php?m=$error");
    die();
}

//retrieve game id from a query string variable.
$id = filter_input(INPUT_GET, 'games_id', FILTER_SANITIZE_NUMBER_INT);

//MySQL SELECT statement
$sql = "SELECT * FROM $tblGame, $tblGenre WHERE games.genre_id = genre.id AND games_id=$id";

//execute the query
$query = @$conn->query($sql);

//Handle errors
if (!$query) {
    $error = "Selection failed: " . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$row = $query->fetch_assoc();
if (!$row) {
    $error = "game not found";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}
?>

    <h2>game Details</h2>
    <div class="gamedetails">
        <div class="cover">
            <!-- display book image -->
            <img src="<?= $row['image'] ?>">
        </div>
        <div class="label">
            <!-- display book attributes  -->
            <div>Title:</div>
            <div>Publisher:</div>
            <div>Genre</div>
            <div>Release Date:</div>
            <div>Publisher:</div>
            <div>Price:</div>
            <div>Description</div>
        </div>

        <div class="content">
            <!-- display book details -->
            <div><?= $row['title'] ?></div>
            <div><?= $row['genre_id'] ?></div>
            <div><?= $row['release_date'] ?></div>
            <div><?= $row['publisher'] ?></div>
            <div>$<?= $row['price'] ?></div>
            <div><?= $row['description'] ?></div>
        </div>
    </div>
    <div class="bookstore-button">
        <input type="button" value="Delete"
               onclick="window.location.href = 'removegame.php?games_id=<?= $id ?>'">
        <input type="button" value="Cancel"
               onclick="window.location.href = 'gamedetails.php?games_id=<?= $id ?>'">
        <div style="color: red; display: inline-block;">Are you sure you want to delete this game?</div>
    </div>
<?php
require_once('includes/footer.php');

require 'includes/library.php';
if (!is_admin()) {
    $error = "Access to this page is permitted for administrators only.";
    header("Location: error.php?m=$error");
    exit;
}
