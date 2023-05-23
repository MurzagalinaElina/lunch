<?php
require_once('init.php');
require('helpers.php');

check_auth();
$user = $_SESSION['user'];

$category_id = $_GET['category_id'];

$sql = "SELECT * FROM categories WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $category_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$category = mysqli_fetch_array($res, MYSQLI_ASSOC);

$sql = "SELECT * FROM dishes WHERE category_id = ? ORDER BY name";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $category_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$dishes = mysqli_fetch_all($res, MYSQLI_ASSOC);

$content = include_template("dishes.php", [
  "user" => $user,
  "category" => $category,
  "dishes" => $dishes,
]);

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
