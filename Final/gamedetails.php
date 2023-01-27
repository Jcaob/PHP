<?php

$page_title = "Game Details";
require_once('includes/header.php');
require_once('includes/database.php');

if(!filter_has_var(INPUT_GET, 'games_id')){
    $error = "Your request cannot be processed since there was a problem retrieving Game id";
    $conn ->close();
    header("Location:error.php?m=$error");
    die();
}

//retrieve game id from a query string variable.
$id = filter_input(INPUT_GET, "games_id", FILTER_SANITIZE_NUMBER_INT);

//select statement
$sql = "SELECT *
 FROM $tblGame, $tblGenre
 WHERE games_id=$id";

//execute the query
$query = $conn->query($sql);
//Handle errors
if (!$query) {
    $error = "Selection failed: " . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

$row = $query->fetch_assoc();
if (!$row) {
    $error = "Game not found";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}

?>

    <h2>Game Details</h2>
    <div class="gamedetails">

        <div class="label">
            <!-- display game attributes  -->
            <div>Title:</div>
            <div>Publisher:</div>
            <div>Genre</div>
            <div>Price:</div>
            <div>Release Date:</div>
            <div>Description</div>
        </div>
        <div class="content">
			<!-- display book details -->
            <div><?= $row['title'] ?></div>
            <div><?= $row['publisher'] ?></div>
            <div><?= $row['genre'] ?></div>
            <div><?= $row['price'] ?></div>
            <div><?= $row['release_date'] ?></div>
            <div><?= $row['description'] ?></div>

            <div>
                <a href="addtocart.php?games_id=<?= $id ?>">
                    <img src="www/img/addtocart_button.png" />
                </a>
            </div>

        </div>
    </div>
<?php
$confirm = "";
if(isset($_GET['m'])) {
    if ($_GET['m'] == "insert") {
        $confirm = "You have successfully added the new Game.";
    }
}
?>
    <div class="gamestore-button">
        <div style="color: red; display: inline-block;"><?= $confirm ?></div>
        <input type="button"
               onclick="window.location.href='editgame.php?games_id=<?= $id ?>'"
               value="Edit">
        <input type="button"
               onclick="window.location.href='listgames.php'"
               value="Cancel">
        <input type="button" value="Delete"
               onclick="window.location.href='deletegame.php?games_id=<?= $id ?>'">
    </div>

<?php
require_once('includes/footer.php');


