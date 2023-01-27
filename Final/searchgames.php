<?php

$page_title = "Search Games";

include('includes/header.php');
?>
<h2>Search Games by Title</h2>
<p>Enter one or more words in Games title.</p>
<form action="searchgameresults.php" method="get">
    <input type="text" name="q" size="40" required />&nbsp;&nbsp;
    <input type="submit" name="Submit" id="Submit" value="Search Games" />
</form>
<?php
include('includes/footer.php');