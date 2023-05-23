<?php
session_start();

$db_cfg = require_once 'config/db.php';
$db_cfg = array_values($db_cfg);

$conn = mysqli_connect(...$db_cfg);
mysqli_set_charset($conn, "utf8");

$content = '';
