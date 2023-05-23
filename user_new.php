<?php
require_once('init.php');
require('helpers.php');

check_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST;

    $sql = 'INSERT INTO users (username, password) VALUES (?, ?)';
    $password = password_hash($user['password'], PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $user['username'], $password);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        $user_id = mysqli_insert_id($conn);
        header("Location: users.php");
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($conn)]);
    }
} else {
    $content = include_template("user_new.php");
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
