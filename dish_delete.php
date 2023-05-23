<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];

$category_id = $_GET['category_id'];
$dish_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sql = 'DELETE FROM dishes WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $dish_id);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        header("Location: dishes.php?category_id=" . $category_id);
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($link)]);
    }
} else {
    $sql = "SELECT * FROM dishes WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $dish_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $dish = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $content = include_template("dish_delete.php", [
        'category_id' => $category_id,
        'dish' => $dish
    ]);
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
