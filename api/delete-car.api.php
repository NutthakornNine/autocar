<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';
$sql = "
    DELETE FROM
        Cars
    WHERE car_id = {$_POST['car_id']}
";

$query = $conn->query($sql);
if ($query) {
    echo 'success';
} else {
    echo 'error';
}