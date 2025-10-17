<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';
$sql = "
    DELETE FROM
        reserved
    WHERE reserved_id = {$_POST['reserved_id']}
";

$query = $conn->query($sql);
if ($query) {
    $conn->query("UPDATE Cars SET car_status = 1 WHERE car_id = {$_POST['car_id']}");
    echo 'success';
} else {
    echo 'error';
}