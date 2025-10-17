<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';

if ($_POST['status'] == 0) {
    $is_status = 1;
} else {
    $is_status = 0;
}

$conn->query("UPDATE Users SET `status` = {$is_status} WHERE user_id = {$_POST['id']}");
echo 'success';