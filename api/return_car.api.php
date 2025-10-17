<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';

$conn->query("UPDATE Cars SET car_status = 1 WHERE car_id = {$_POST['car_id']}");
$conn->query("UPDATE reserved SET is_return = 1 WHERE reserved_id = {$_POST['reserved_id']}");
echo 'success';