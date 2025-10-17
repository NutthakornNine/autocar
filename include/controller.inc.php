<?php

use PSpell\Config;

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
                CONCAT('(',t1.car_type,')', ' ',' (สี ', t1.car_color,')', ' ',' (ป้ายทะเบียน ', t1.license_plate,')',' ','(จำนวน',t1.seats ,'ที่นั่ง)') AS car_detail,
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
        $province = $_GET['province'] ?? '';
        $minprice = $_GET['minprice'] ?? '';
        $maxprice = $_GET['maxprice'] ?? '';
        $car_type = $_GET['car_type'] ?? '';
        $seats = $_GET['seats'] ?? '';
        
        $conditions = [];

        if (!empty($_GET['car_brand'])) {
            $car_brand = strtolower($_GET['car_brand'][0]);
            $conditions[]  = "t1.car_brand LIKE '%{$car_brand}%'";
        }
        if (!empty($_GET['fuelsystem'])) {
            $car_brand = "'" . implode("','", $_GET['fuelsystem']) . "'";
            $conditions[]  = "t1.fuelsystem IN ({$car_brand})";
        }
        if (!empty($_GET['car_color'])) {
            $car_color = $_GET['car_color'][0];
            $result_color = str_replace("สี", "", $car_color);
            $conditions[]  = "t1.car_color LIKE '%{$result_color}%'";
        }

        if (!empty($_GET['province'])) {
            $conditions[] = "t1.province_id = {$province}";
        }
        if (!empty($_GET['minprice']) && !empty($_GET['maxprice'])) {
            $conditions[] = "t1.price_per_day BETWEEN $minprice AND $maxprice";
        }
        if (!empty($_GET['car_type'])) {
            $strCarTpe = strtolower($car_type);
            $conditions[] = "LOWER(t1.car_type) = '{$strCarTpe}'";
        }
        if (!empty($_GET['seats'])) {
            $conditions[] = "t1.seats = '{$seats}'";
        }
        $where_sql = "where t1.car_status = 1";
        if (count($conditions) > 0) {
            $where_sql .= ' AND ' . implode(' AND ', $conditions);
        }
        $sql = "
            SELECT 
                t1.*,
                CONCAT(t1.car_brand, ' ', t1.car_model) AS car_name,
                CONCAT('(',t1.car_type,')', ' ',' (สี ', t1.car_color,')', ' ',' (ป้ายทะเบียน ', t1.license_plate,')',' ','(จำนวน',t1.seats ,'ที่นั่ง)') AS car_detail,
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
            LEFT JOIN thai_provinces t2 ON t1.province_id = t2.id
            {$where_sql}
        ";
        // echo $sql;
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
                CONCAT('(',t1.car_type,')', ' ',' (สี ', t1.car_color,')', ' ',' (ป้ายทะเบียน ', t1.license_plate,')',' ','(จำนวน',t1.seats ,'ที่นั่ง)') AS car_detail,
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
        $startDate = new DateTime($_GET['start_date']);
        $endDate = new DateTime($_GET['end_date']);
        // หาผลต่างระหว่างวันที่
        $diff = $startDate->diff($endDate);
        $reserved_total_day = $diff->days;
        $row['total_day'] = $reserved_total_day;
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
                t1.user_id = {$user_id} AND t1.is_return = 0
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
            $condition[] = "DATE(start_date) BETWEEN '$startDate' AND '$endDate'";
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
                t1.end_date,
                t3.car_id,
                t1.is_return
            from 
                reserved t1
            left join Users t2 on t1.user_id = t2.user_id
            left join Cars t3 on t1.car_id = t3.car_id
            left join thai_provinces t4 on t3.province_id = t4.id
            {$where_sql}
            order by t1.date_time desc
        ";
        $query = $conn->query($sql);
        return $query;
    }

    function getUsers() {
        $conn = $GLOBALS['conn'];
        $name = $_GET['name'] ?? '';
        $role = $_GET['role'] ?? '';
        $status = $_GET['status'] ?? '';

        $conditions = [];

        if (!empty($_GET['name'])) {
            $conditions[] = "CONCAT(fullname, ' ', lastname, ' ', email) LIKE '%{$name}%'";
        }
        if (!empty($_GET['role'])) {
            if ($role == 'admin') {
                $conditions[] = "`role` = 0";
            } else {
                $conditions[] = "`role` = {$role}";
            }
        }
        if (!empty($_GET['status'])) {
            if ($status == 'disable') {
                $conditions[] = "`status` = 0";
            } else {
                $conditions[] = "`status` = {$status}";
            }
        }
        $where_sql = "where 1 = 1";
        if (count($conditions) > 0) {
            $where_sql .= ' AND ' . implode(' AND ', $conditions);
        }
        $sql = "
            SELECT
                *
            FROM Users
            {$where_sql}
        ";
        $query = $conn->query($sql);
        return $query;
    }

    function getCarsAdmin() {
        $conn = $GLOBALS['conn'];
        $cars = $_GET['cars'] ?? '';
        $province_id = $_GET['province_id'] ?? '';
        $status = $_GET['car_status'] ?? '';

        $conditions = [];

        if (!empty($cars)) {
            $conditions[] = "CONCAT(car_brand, ' ', car_model, ' ', license_plate) LIKE '%{$cars}%'";
        }
        if (!empty($province_id)) {
            $conditions[] = "`province_id` = {$province_id}";
        }
        if (!empty($status)) {
            if ($status == 'none') {
                $conditions[] = "`car_status` = 0";
            } else {
                $conditions[] = "`car_status` = {$status}";
            }
        }
        $where_sql = "where 1 = 1";
        if (count($conditions) > 0) {
            $where_sql .= ' AND ' . implode(' AND ', $conditions);
        }
        $sql = "
            SELECT
                *,
                CONCAT(car_brand, ' ', car_model) AS car_name
            FROM Cars t1
            left join Users t2 on t1.owner_id = t2.user_id
            left join thai_provinces t3 on t1.province_id = t3.id
            {$where_sql}
        ";
        $query = $conn->query($sql);
        return $query;
    }

    function getPayAmount() {
        $conn = $GLOBALS['conn'];
        $sql = "
            select SUM(DATEDIFF(t1.end_date, t1.start_date) * t2.price_per_day) AS total 
            from reserved t1 left join Cars t2 on t1.car_id = t2.car_id;";
        $result = $conn->query($sql)->fetch_assoc();
        return number_format($result['total']);
    }
    function getPayAmountByMonth() {
        $month = date("m");
        $conn = $GLOBALS['conn'];
        $sql = "
            select SUM(DATEDIFF(t1.end_date, t1.start_date) * t2.price_per_day) AS total 
            from reserved t1 left join Cars t2 on t1.car_id = t2.car_id
            where MONTH(t1.start_date) = '$month'";
        $result = $conn->query($sql)->fetch_assoc();
        return number_format($result['total']);
    }
    function getCountReserved() {
        $month = date("m");
        $conn = $GLOBALS['conn'];
        $sql = "
            select COUNT(*) AS total 
            from reserved t1 left join Cars t2 on t1.car_id = t2.car_id
        ";
        $result = $conn->query($sql)->fetch_assoc();
        return number_format($result['total']);
    }
    function getSumTotal() {
        $month = date("m");
        $conn = $GLOBALS['conn'];
        if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
            $where_sql = "WHERE DATE(t1.date_time) BETWEEN '{$_GET['start_date']}' AND '{$_GET['end_date']}'";
        }
        $sql = "
            select SUM(DATEDIFF(t1.end_date, t1.start_date) * t2.price_per_day) AS total 
            from reserved t1 left join Cars t2 on t1.car_id = t2.car_id
            {$where_sql}
        ";
        $result = $conn->query($sql)->fetch_assoc();
        return number_format($result['total']);
    }
    function getSumTotalTable() {
        $month = date("m");
        $conn = $GLOBALS['conn'];
        if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
            $where_sql = "WHERE DATE(t1.date_time) BETWEEN '{$_GET['start_date']}' AND '{$_GET['end_date']}'";
        }
        $sql = "
            select CONCAT('ORDER-', t1.reserved_id) AS reserved_id, 
            concat(t3.fullname, ' ', t3.lastname) AS reserved_name,
            CONCAT(t2.car_brand, ' ', t2.car_model) AS car_name,
            t1.date_time,
            (DATEDIFF(t1.end_date, t1.start_date) * t2.price_per_day) AS total,
            t1.is_return
            from reserved t1 
            left join Cars t2 on t1.car_id = t2.car_id
            left join Users t3 on t1.user_id = t3.user_id
            {$where_sql}
        ";
        $result = $conn->query($sql);
        return $result;
    }
    function getIfReservedExists() {
        $conn = $GLOBALS['conn'];
        $car_id = $_GET['car_id'];
        $user_id = $_SESSION['userid'];
        $sql = "
            SELECT
                reserved_id
            FROM
                reserved
            WHERE
                user_id = {$user_id}
                AND car_id = {$car_id}
                AND is_return = 0
        ";
        $query = $conn->query($sql);
        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }