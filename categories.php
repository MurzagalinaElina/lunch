<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];

$sql = "SELECT * FROM categories ORDER BY position";
$res = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($res, MYSQLI_ASSOC);

$content = include_template("categories.php", [
  "user" => $user,
  "categories" => $categories
]);

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
