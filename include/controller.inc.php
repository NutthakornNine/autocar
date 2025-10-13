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
    function getReservedCar() {
        $conn = $GLOBALS['conn'];
        $user_id = $_SESSION['userid'];
        $sql = "
            select 
                t1.reserved_id,
                t1.car_id,
                CONCAT(t3.car_brand, ' ', t3.car_model) AS car_name,
                CONCAT(t3.car_type, ' ',' (สี) ', t3.car_color, ' (ป้ายทะเบียน) ', t3.license_plate) AS car_detail,
                t4.name_th AS province_name,
                t3.car_image,
                t1.start_date,
                t1.end_date,
                CASE 
                    WHEN FLOOR(TIMESTAMPDIFF(MINUTE, t1.date_time, NOW()) / 60) = 0 
                        THEN CAST(MOD(TIMESTAMPDIFF(MINUTE, t1.date_time, NOW()), 60) AS CHAR)
                    ELSE CONCAT(
                        FLOOR(TIMESTAMPDIFF(MINUTE, t1.date_time, NOW()) / 60),
                        ':',
                        LPAD(MOD(TIMESTAMPDIFF(MINUTE, t1.date_time, NOW()), 60), 2, '0')
                    )
                END AS reserved_date
            from 
                reserved t1
            left join Users t2 on t1.user_id = t2.user_id
            left join Cars t3 on t1.car_id = t3.car_id
            left join thai_provinces t4 on t3.province_id = t4.id
            where
                t1.user_id = {$user_id}
";
        $query = $conn->query($sql);
        return $query;
    }
    function getReservation() {
        $conn = $GLOBALS['conn'];
        $user_id = $_SESSION['userid'];
        $reserved_date = $_GET['reserved_name'] ?? '';
        $datetime = $_GET['datetime'] ?? '';

        $condition = [];

        if (!empty($_GET['reserved_name'])) {
            $condition[] = "CONCAT(t2.fullname, ' ', t2.lastname) LIKE '%{$reserved_date}%'";
        }
        if (!empty($_GET['datetime'])) {
            $strDate = explode(" - ", $datetime);
            $startDate = $strDate[0];
            $endDate = $strDate[1];
            $condition[] = "start_date <= '$startDate' AND end_date >= '$endDate'";
        }
        $where_sql = "where t3.owner_id = {$user_id}";
        if (count($condition) > 0) {
            $where_sql .= ' AND ' . implode(' AND ', $condition);
        }
        $sql = "
            select 
                t1.reserved_id,
                CONCAT(t2.fullname, ' ', t2.lastname) AS reserved_name,
                t2.email,
                CONCAT(t3.car_brand, ' ', t3.car_model) AS car_name,
                CONCAT('ทะเบียน ', t3.license_plate) AS license_plate,
                t1.start_date,
                t1.end_date
            from 
                reserved t1
            left join Users t2 on t1.user_id = t2.user_id
            left join Cars t3 on t1.car_id = t3.car_id
            left join thai_provinces t4 on t3.province_id = t4.id
            {$where_sql}
        ";
        $query = $conn->query($sql);
        return $query;
    }
