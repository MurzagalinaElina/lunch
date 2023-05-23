<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST;

    $sql = 'INSERT INTO categories (name, position) VALUES (?, ?)';
    $stmt = db_get_prepare_stmt($conn, $sql, $category);
    $res = mysqli_stmt_execute($stmt);

    if ($res) {
        $category_id = mysqli_insert_id($conn);
        header("Location: categories.php");
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($conn)]);
    }
} else {
    $content = include_template("category_new.php");
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
