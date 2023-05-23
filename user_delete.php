<?php
require_once('init.php');
require('helpers.php');

check_admin();

$session_user = $_SESSION['user'];
$user_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($res, MYSQLI_ASSOC);

    if ($user['username'] == $session_user['username']) {
        $content = include_template('error.php', ['error' => 'Нельзя удалить себя']);
    } else {
        $sql = 'DELETE FROM users WHERE id = ?';
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $user_id);
        $res = mysqli_stmt_execute($stmt);

        if ($res) {
            header("Location: users.php");
            exit();
        } else {
            $content = include_template('error.php', ['error' => mysqli_error($link)]);
        }
    }
} else {
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $content = include_template("user_delete.php", ["user" => $user]);
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
