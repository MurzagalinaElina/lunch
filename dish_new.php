<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_GET['category_id'];
    $dish = $_POST;
    $dish['is_active'] = $dish['is_active'] == 'on' ? 1 : 0;

    $sql = 'INSERT INTO dishes (name, is_active, category_id) VALUES (?, ?, ?)';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sis', $dish['name'], $dish['is_active'], $category_id);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        header("Location: dishes.php?category_id=" . $category_id);
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($link)]);
    }
} else {
    $content = include_template("dish_new.php");
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
