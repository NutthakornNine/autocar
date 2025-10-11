<?php
    include '../controller/db.php';
    $password = base64_encode($_POST['password2']);
    $sql = "SELECT user_id FROM Users WHERE email = '{$_POST['email']}'";
    $query = $conn->query($sql);
    if ($query->num_rows > 0) {
        echo 'dup';
        exit;
    }
     //code...
    $sql = "
        INSERT INTO
            Users
        SET
            fullname = '{$_POST['fullname']}',
            lastname = '{$_POST['lastname']}',
            email = '{$_POST['email']}',
            phone = '{$_POST['phone']}',
            `password` = '$password',
            `address` = '{$_POST['address']}',
            `role` = '{$_POST['role']}',
            `status` = 1    
    ";
    $query = $conn->query($sql);
    if ($query) {
        echo 'success';
    } else {
        echo 'error';
    }
?>