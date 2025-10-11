<?php
    session_start();
    include '../controller/db.php';
    $password = base64_encode($_POST['password']);    
        $sql = "
            SELECT 
                    * 
            FROM
                 Users
            WHERE
               email = '{$_POST['email']}' AND password = '$password'
        ";
        $query = $conn->query($sql);
        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();
            $_SESSION['userid'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            echo 'success';
        } else {
            echo 'error';
        }
    
?>