<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';

$conn->query("DELETE FROM Users WHERE user_id = {$_POST['user_id']}");
echo 'success';