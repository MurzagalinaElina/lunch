<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];

$dish_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_GET['category_id'];
    $dish = $_POST;
    $dish['is_active'] = $dish['is_active'] == 'on' ? 1 : 0;

    $sql = 'UPDATE dishes SET name = ?, is_active = ? WHERE id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $dish['name'], $dish['is_active'], $dish_id);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        header("Location: dishes.php?category_id=" . $category_id);
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($conn)]);
    }
} else {
    $sql = "SELECT * FROM dishes WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $dish_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $dish = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $content = include_template("dish_edit.php", [
      'dish' => $dish
    ]);
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
