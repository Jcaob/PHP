<?php
$page_title = "Games That we Sell!";
require 'includes/header.php';
require 'includes/database.php';

//SELECT statement to retrieve book id, title, author, price, and category id from
//the books table.
$sql = "SELECT games_id, title, publisher, release_date, price, description, genre_id, genre
 FROM $tblGame, $tblGenre
  WHERE $tblGame.genre_id = $tblGenre.id";


$query = $conn->query($sql);

if (!$query) {
    $error = "Selection failed: " . $conn->error;
    $conn->close();
    header("Location: error.php?m=$error");
    die();
}
?>

    <h2>Games that we sell!</h2>
    <div class="gamelist">
        <div class="row header">
            <div class="col1">Title</div>
            <div class="col2">Publisher</div>
            <div class="col3">Release Date</div>
            <div class="col4">Price</div>


        </div>
        <?php while ($row = $query->fetch_assoc()) { ?>
            <div class="row">
                <div class="col1"><a href="gamedetails.php?games_id=<?= $row['games_id'] ?>"><?= $row['title'] ?></a></div>
                <div class="col2"><?= $row['publisher'] ?></div>
                <div class="col3"><?= $row['release_date'] ?></div>
                <div class="col4"><?= $row['price'] ?></div>


            </div>
        <?php } ?>
	</div>

<?php
require 'includes/footer.php';