<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';
$uploadDir = "../upload/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$fileImage = "";

if (!empty($_FILES['slip']['name'])) {
    $fileTmp  = $_FILES['slip']['tmp_name'];
    $fileName = $_FILES['slip']['name'];
    $fileType = $_FILES['slip']['type'];
    $fileSize = $_FILES['slip']['size'];

    // ตรวจสอบว่าเป็นรูปไหม
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (in_array($fileType, $allowed)) {
        // เปลี่ยนชื่อกันชนกัน
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;
        $dest = $uploadDir . $newName;

        // ย้ายไฟล์
        if (move_uploaded_file($fileTmp, $dest)) {
            $fileImage = $newName;
        }
    }
}
$sql = "
    INSERT INTO
        reserved
    SET
            user_id ={$_POST['user_id']},
            car_id ={$_POST['car_id']},
            slip ='$fileImage',
            start_date ='{$_POST['start_date']}',
            end_date ='{$_POST['end_date']}',
            pay_type ='{$_POST['pay_type']}',
            pay = 1,
            status = 1
";
$query = $conn->query($sql);
if ($query) {
    $conn->query("UPDATE Cars SET car_status = 0 WHERE car_id = {$_POST['car_id']}");
    echo 'success';
} else {
    echo 'error';
}