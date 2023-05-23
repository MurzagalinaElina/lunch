<?php
require_once('init.php');
require('helpers.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	  $form = $_POST;

	  $required = ['username', 'password'];
	  $errors = [];
	  foreach ($required as $field) {
	      if (empty($form[$field])) {
	          $errors[$field] = 'Это поле надо заполнить';
        }
    }

	  $username = mysqli_real_escape_string($conn, $form['username']);
	  $sql = "SELECT * FROM users WHERE username = '$username'";
	  $res = mysqli_query($conn, $sql);

	  $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
	  $is_admin = $username == 'admin';

    if ($username == 'admin') {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
	  }

	  if (!count($errors) and $user) {
		    if (password_verify($form['password'], $user['password'])) {
			      $_SESSION['user'] = ['id' => $user['id'], 'username' => $user['username'], 'is_admin' => $is_admin];
		    } else {
			      $errors['password'] = 'Неверный пароль';
		    }
	  } else {
		    $errors['username'] = 'Такой пользователь не найден';
	  }

    if (count($errors)) {
    	  $page_content = include_template('auth.php', ['form' => $form, 'errors' => $errors]);
    } else {
        if ($is_admin) {
    	      header("Location: /categories.php");
    	  } else {
    	      header("Location: /categories.php");
    	  }
    	  exit();
    }
} else {
    if (isset($_SESSION['user'])) {
        header("Location: /index.php");
        exit();
    } else {
        $page_content = include_template('auth.php');
    }
}

print include_template('layout.php', [
	'content'    => $page_content
]);
