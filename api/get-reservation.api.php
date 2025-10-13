<?php
error_reporting(E_ALL);
if (session_status() === PHP_SESSION_NONE) {session_start();}
include '../controller/db.php';
$conn = $GLOBALS['conn'];
$reserved_id = $_POST['reserved_id'];
$sql = "
    select 
        t1.reserved_id,
        CONCAT(t2.fullname, ' ', t2.lastname) AS reserved_name,
        t2.email,
        CONCAT(t3.car_brand, ' ', t3.car_model) AS car_name,
        CONCAT('ทะเบียน ', t3.license_plate) AS license_plate,
        t1.start_date,
        t1.end_date,
        t2.phone,
        t3.price_per_day,
        t1.slip
    from 
        reserved t1
    left join Users t2 on t1.user_id = t2.user_id
    left join Cars t3 on t1.car_id = t3.car_id
    left join thai_provinces t4 on t3.province_id = t4.id
    where
        t1.reserved_id = {$reserved_id}
";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
$startDate = new DateTime($row['start_date']);
$endDate = new DateTime($row['end_date']);
// หาผลต่างระหว่างวันที่
$diff = $startDate->diff($endDate);
$reserved_total_day = $diff->days;
echo json_encode([
        'data' => $row,
        'amount' => floatval($row['price_per_day'] * $reserved_total_day),
        'day' => $reserved_total_day
]);