<?php
require_once('init.php');
require('helpers.php');

check_admin();
$user = $_SESSION['user'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['clear_orders'] == '1') {
        $sql = 'DELETE FROM users_orders';
        $stmt = mysqli_prepare($conn, $sql);
        $res = mysqli_stmt_execute($stmt);
    } else if (isset($_POST['ordering'])) {
        $sql = "UPDATE properties SET value = ? WHERE name = 'ordering_active'";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $_POST['ordering']);
        $res = mysqli_stmt_execute($stmt);
    }

    if ($res) {
        header("Location: orders.php");
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($link)]);
    }
} else {
    $sql = 'SELECT dishes.name, COUNT(*) AS count FROM users_orders ' .
      'INNER JOIN dishes ON dishes.id = users_orders.dish_id ' .
      '' .
      'GROUP BY name ' .
      'ORDER BY name';
    $res = mysqli_query($conn, $sql);
    $dishes = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $sql = "SELECT value as ordering_active FROM properties WHERE name = 'ordering_active'";
    $res = mysqli_query($conn, $sql);
    $properties = mysqli_fetch_array($res, MYSQLI_ASSOC);

    $content = include_template("orders.php", [
      "user" => $user,
      "dishes" => $dishes,
      "properties" => $properties
    ]);
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
