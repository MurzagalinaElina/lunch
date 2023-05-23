<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];

$sql = "SELECT * FROM users ORDER BY username";
$res = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($res, MYSQLI_ASSOC);

$content = include_template("users.php", [
  "users" => $users
]);

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
