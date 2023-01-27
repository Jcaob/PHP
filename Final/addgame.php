<?php
/*
 * Author: Louie Zhu
 * Date: May 28, 2019
 * File: addbook.php
 * Description: This script displays a form to accept a new book's details.
 *
 */
$page_title = "PHP Online Bookstore Add Book";
require_once 'includes/header.php';
require 'includes/library.php';
if (!is_admin()) {
    $error = "Access to this page is permitted for administrators only.";
    header("Location: error.php?m=$error");
    exit;
}

?>

    <h2>Add New Game</h2>
    <form action="insertgame.php" method="post">
        <table cellspacing="0" cellpadding="3" style="border: 1px solid silver; padding:5px; margin-bottom: 10px">
            <tr>
                <td style="text-align: right; width: 100px">Title: </td>
                <td><input name="title" type="text" size="100" required /></td>
            </tr>

            <tr>
                <td style="text-align: right">Genre::</td>
                <td>
                    <select name="genre_id">
                        <option value="1">Open World</option>
                        <option value="2">Battle Royale</option>
                        <option value="3">Action-Open World</option>
                        <option value="4">Sandbox</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td style="text-align: right">Release date: </td>
                <td><input name="release_date" type="text" required /></td>
            </tr>
            <tr>
                <td style="text-align: right">Publisher:</td>
                <td><input name="publisher" type="text" required /></td>
            </tr>
            <tr>
                <td style="text-align: right">Price: </td>
                <td><input name="price" type="number" step="0.01" required /></td>
            </tr>
            <tr>
                <td style="text-align: right">Image: </td>
                <td><input name="image" type="text" size="100" required /></td>
            </tr>
            <tr>
                <td style="text-align: right; vertical-align: top">Description:</td>
                <td><textarea name="description" rows="6" cols="65"></textarea></td>
            </tr>
        </table>
        <div class="bookstore-button">
            <input type="submit" value="Add Game" />
            <input type="button" value="Cancel" onclick="window.location.href='listgames.php'" />
        </div>
    </form>

<?php
require_once 'includes/footer.php';