<?php

$page_title = " Game Search results";

require_once('includes/header.php');
require_once('includes/database.php');

//retrieve search term
if(!filter_has_var(INPUT_GET, "q")) {
    $error = "There was no search terms found.";
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}
$term = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);

//explode the search terms into an array
$terms = explode(" ", $term);

//select statement using pattern search. Multiple terms are concatnated in the loop.
$sql = "SELECT games_id, title, publisher, release_date, price, description, genre
 FROM $tblGame, $tblGenre
 WHERE $tblGame.games_id = $tblGenre.id AND ";
foreach ($terms as $t) {
    $sql .= "title LIKE '%$t%' AND ";
}
$sql = rtrim($sql, "AND "); //remove the extra "AND " at the end of the string

//execute the query
$query = $conn->query($sql);
//Handle selection errors
if (!$query) {
    $error = "Selection failed: " . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}
?>
    <h2>Game search results for: '<?= $term ?>'</h2>
<?php
if ($query->num_rows == 0) {
    echo "Your search '$term' did not match any books in our inventory";
    include('includes/footer.php');
    exit;
}
?>
	<div class="gamelist">
        <div class="row header">
            <div class="col1">Title</div>
            <div class="col2">Publisher</div>
            <div class="col3">Genre</div>
            <div class="col4">Price</div>
        </div>
        <?php while ($row = $query->fetch_assoc()) { ?>
            <div class="row">
                <div class="col1"><?= $row['title'] ?></div>
                <div class="col2"><?= $row['publisher'] ?></div>
                <div class="col3"><?= $row['genre'] ?></div>
                <div class="col4"><?= $row['price'] ?></div>
            </div>
        <?php } ?>
		<!-- insert a row into the table for each book -->
	</div>
<?php
include('includes/footer.php');
