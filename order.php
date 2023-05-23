<?php
require_once('init.php');
require('helpers.php');

check_auth();
$user = $_SESSION['user'];

$user_id = $user['id'];

$sql = "SELECT value as ordering_active FROM properties WHERE name = 'ordering_active'";
$res = mysqli_query($conn, $sql);
$properties = mysqli_fetch_array($res, MYSQLI_ASSOC);
if ($properties['ordering_active'] != '1') {
    $content = include_template('error.php', ['error' => 'Запись не активна']);
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = 'DELETE FROM users_orders WHERE user_id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    $res = mysqli_stmt_execute($stmt);

    foreach ($_POST['dishes'] as $dish_id) {
        if ($dish_id != '') {
            $sql = 'INSERT INTO users_orders (dish_id, user_id) VALUES (?, ?)';
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'si', $dish_id, $user_id);
            $res = mysqli_stmt_execute($stmt);
        }
    }

    if ($res) {
        header("Location: order.php");
        exit();
    } else {
        $content = include_template('error.php', ['error' => mysqli_error($conn)]);
    }
} else {
    $sql = "SELECT * FROM categories ORDER BY position";
    $res = mysqli_query($conn, $sql);
    $categories = mysqli_fetch_all($res, MYSQLI_ASSOC);

    $sql = 'SELECT id, name, category_id, ' .
      'EXISTS(SELECT * FROM users_orders WHERE users_orders.dish_id = dishes.id AND user_id = ?) AS selected ' .
      'FROM dishes ' .
      'WHERE is_active = 1';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $dishes = mysqli_fetch_all($res, MYSQLI_ASSOC);

    for ($i = 0; $i < count($categories); $i++) {
        $categories[$i]['dishes'] = [];
        for ($j = 0; $j < count($dishes); $j++) {
            if ($dishes[$j]['category_id'] == $categories[$i]['id']) {
                $categories[$i]['dishes'][] = $dishes[$j];
            }
        }
    }

    $content = include_template("order.php", [
      'categories' => $categories,
      'dishes' => $dishes
    ]);
}

print include_template('layout.php', [
	'user' => $user,
	'content' => $content
]);
