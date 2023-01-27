<?php
/*
 * Author: Louie Zhu
 * Date: May 29, 2019
 * File: error.php 
 * Description: This script displays an error message.
 * 
 */

$page_title = "PHP Online Bookstore Error";
require_once 'includes/header.php';

$error='Default error.';
if (filter_has_var(INPUT_GET, "m")) {
	$error = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING);
}
?>
<h2>Error</h2>

<table style="width: 100%; border: none">
    <tr>
        <td style="vertical-align: middle; text-align: center; width:100px">
            <img src='www/img/error.png' style="width: 80px; border: none"/>
        </td>
        <td style="text-align: left; vertical-align: top;">
            <h3>Sorry, but an error has occurred.</h3>
            <div style="color: red">
                <?= $error ?>
            </div>
            <br>
        </td>
    </tr>
</table>
<br><br><br><br><br>
<?php
require_once 'includes/footer.php';
