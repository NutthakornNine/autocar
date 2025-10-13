<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';
$owner_id = $_SESSION['userid'];
$uploadDir = "../upload/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$fileImage = [];
if (!empty($_FILES['car_image']['name'][0])) {
    $count = count($_FILES['car_image']['name']);

    for ($i = 0; $i < $count; $i++) {
        $fileTmp  = $_FILES['car_image']['tmp_name'][$i];
        $fileName = $_FILES['car_image']['name'][$i];
        $fileType = $_FILES['car_image']['type'][$i];
        $fileSize = $_FILES['car_image']['size'][$i];

        // ตรวจสอบว่าเป็นรูปไหม
        $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($fileType, $allowed)) continue;

        // เปลี่ยนชื่อกันชนกัน
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;
        $dest = $uploadDir . $newName;

        // ย้ายไฟล์
        if (move_uploaded_file($fileTmp, $dest)) {
            $fileImage[] = $newName;
        }
    }

    // รวม id เป็น "1,2,3,4"
    $idString = implode(",", $fileImage);
    $sql = "
        UPDATE
            Cars
        SET
                car_type ='{$_POST['car_type']}',
                car_brand ='{$_POST['car_brand']}',
                car_model ='{$_POST['car_model']}',
                car_color ='{$_POST['car_color']}',
                license_plate ='{$_POST['license_plate']}',
                seats = {$_POST['seats']},
                fuelsystem ='{$_POST['fuelsystem']}',
                price_per_day ={$_POST['price_per_day']},
                car_status ={$_POST['car_status']},
                province_id ={$_POST['province']},
                car_image ='{$idString}'
        WHERE
            car_id = {$_POST['car_id']}
    ";
} else {
    $sql = "
        UPDATE
            Cars
        SET
                car_type ='{$_POST['car_type']}',
                car_brand ='{$_POST['car_brand']}',
                car_model ='{$_POST['car_model']}',
                car_color ='{$_POST['car_color']}',
                license_plate ='{$_POST['license_plate']}',
                seats = {$_POST['seats']},
                fuelsystem ='{$_POST['fuelsystem']}',
                price_per_day ={$_POST['price_per_day']},
                car_status ={$_POST['car_status']},
                province_id ={$_POST['province']}
        WHERE
            car_id = {$_POST['car_id']}
    ";
}
$query = $conn->query($sql);
if ($query) {
    echo 'success';
} else {
    echo 'error';
}