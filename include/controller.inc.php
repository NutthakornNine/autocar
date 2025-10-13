<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require 'controller/db.php';

    function getProvince() {
        $conn = $GLOBALS['conn'];
        $sql = "SELECT * FROM thai_provinces";
        $query = $conn->query($sql);
        return $query;
    }
    function getCarList() {
        $conn = $GLOBALS['conn'];
        $owner_id = $_SESSION['userid'];
        $sql = "
            SELECT 
                t1.*,
                CONCAT(t1.car_brand, ' ', t1.car_model) AS car_name,
                CONCAT(t1.car_type, ' ',' (สี) ', t1.car_color, ' (ป้ายทะเบียน) ', t1.license_plate) AS car_detail,
                t2.name_th AS province_name,
                CASE
                    WHEN t1.`car_status` = 1 THEN 'Active'
                ELSE 'Inactive'
                END AS `car_status_name`
            FROM 
                Cars t1
            LEFT JOIN thai_provinces t2 ON t1.province_id = t2.id
            WHERE 
                t1.owner_id = {$owner_id}";
        $query = $conn->query($sql);
        return $query;
    }
    function getCarListNoOwner() {
        $conn = $GLOBALS['conn'];
        $sql = "
            SELECT 
                t1.*,
                CONCAT(t1.car_brand, ' ', t1.car_model) AS car_name,
                CONCAT(t1.car_type, ' ',' (สี) ', t1.car_color, ' (ป้ายทะเบียน) ', t1.license_plate) AS car_detail,
                t2.name_th AS province_name,
                CASE 
                    WHEN FLOOR(TIMESTAMPDIFF(MINUTE, t1.create_at, NOW()) / 60) = 0 
                        THEN CAST(MOD(TIMESTAMPDIFF(MINUTE, t1.create_at, NOW()), 60) AS CHAR)
                    ELSE CONCAT(
                        FLOOR(TIMESTAMPDIFF(MINUTE, t1.create_at, NOW()) / 60),
                        ':',
                        LPAD(MOD(TIMESTAMPDIFF(MINUTE, t1.create_at, NOW()), 60), 2, '0')
                    )
                END AS add_date,
                CASE
                    WHEN t1.`car_status` = 1 THEN 'Active'
                ELSE 'Inactive'
                END AS `car_status_name`
            FROM 
                Cars t1
            LEFT JOIN thai_provinces t2 ON t1.province_id = t2.id";
        $query = $conn->query($sql);
        return $query;
    }
    function getCarListById() {
        $conn = $GLOBALS['conn'];
        $car_id = $_GET['car_id'];
        $sql = "
            SELECT 
                t1.*,
                CONCAT(t1.car_brand, ' ', t1.car_model) AS car_name,
                CONCAT(t1.car_type, ' ',' (สี) ', t1.car_color, ' (ป้ายทะเบียน) ', t1.license_plate) AS car_detail,
                t2.name_th AS province_name,
                CASE
                    WHEN t1.`car_status` = 1 THEN 'Active'
                ELSE 'Inactive'
                END AS `car_status_name`
            FROM 
                Cars t1
            LEFT JOIN thai_provinces t2 ON t1.province_id = t2.id
            WHERE 
                t1.car_id = {$car_id}";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }
