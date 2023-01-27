<?php

/**
 * Author: Guy
 * Date: 11/30/2022
 * File: editgame.php
 * Description:
 */

$page_title = "Edit Game Details";
require_once ('includes/header.php');
require_once('includes/database.php');

//if game id cannot retrieved, terminate the script.
if (!filter_has_var(INPUT_GET, "games_id")) {
    $error = "Your request cannot be processed since there was a problem retrieving game id.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

//retrieve game id from a query string variable.
$id = filter_input(INPUT_GET, "games_id", FILTER_SANITIZE_NUMBER_INT);

//MySQL SELECT statement

$sql = "SELECT * 
      FROM $tblGame, $tblGenre 
      WHERE games.genre_id = genre.id
      AND games_id=$id";

//var_dump($sql);
//var_dump($id);
//die();
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
require 'includes/library.php';
if (!is_admin()) {
    $error = "Access to this page is permitted for administrators only.";
    header("Location: error.php?m=$error");
    exit;
}


?>
    <h2>Edit Book Details</h2>
    <form action="updategame.php" method="post">
        <div class="gamedetails">
            <div class="label">
                <div>Title:</div>
                <div>Publisher:</div>
                <div>Genre</div>
                <div>Price:</div>
                <div>Release Date:</div>
                <div>Description</div>
            </div>

            <div class="content">
                <div><input name="title" size="80" value="<?php echo $row['title'] ?>" required></div>
                <div><input name="publisher" value="<?php echo $row['publisher'] ?>" required></div>

                <div><input name="release_date" value="<?php echo $row['release_date'] ?>" required></div>
                <div><input name="price" type="number" step="0.01" value="<?php echo $row['price'] ?>" required></div>
                <div><input name="image" size="100" value="<?php echo $row['image'] ?>" required></div>
                <div><textarea name="description" rows="6" cols="65"><?php echo $row['description'] ?></textarea></div>
            </div>
        </div>
        <div class="gamestore-button">
            <input type="hidden" name="games_id" value="<?php echo $id ?>" />
            <input type="submit" value=" Update " />
            <input type="button" value="Cancel" onclick="window.location.href = 'gamedetails.php?games_id=<?= $id ?>'" />
        </div>
    </form>
<?php
// close the connection.
$conn->close();
require_once 'includes/footer.php';