<?php

$page_title = "GamerBase Home";

include('includes/header.php');
?>
<div id="mainbody" style="background-color:<?= $color ?>">
<h2>Welcome to GameBase</h2>
<p>On GameBase you are able to search for your favorite games, look through our gaming library, read game descriptions,
    and put your favorites in a shopping cart for purchase!
</p>
<p>Main website features:</p>
<ul>
    <li>Game Library</li>
    <li>Search for games stores in our library</li>
    <li>Login/logout</li>
    <li>Register/create new accounts</li>
</ul>

</p>

<p><i> GameBase Corporation specializes in the electronic sale of games, our library consists of award-winning games, new releases,
 and old fan favorite titles. We encourage you to browse our library and hope for you to visit again!   </i></p>
<br>
<p style="text-align: center"><strong>Disclaimer</strong></p>
<p>This website contains games that are intended for users +18. Please request parent consent before purchasing a game intended for older audiences if below the intended age limit.</p>
    <form action='index.php' method='get'>
        <input type='radio' name='color' value=''> Default
        <input type='radio' name='color' value='gray'> Darkmode
        <input type='submit' value=' Submit ' />
    </form>
</div>

<?php
include('includes/footer.php');