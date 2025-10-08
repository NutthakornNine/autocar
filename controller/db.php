<?php
$conn = new mysqli("localhost", "root", "", "aurocar");
$conn->set_charset("utf8mb4");


$sql = "select";
$query = mysqli_query($connm, $sql);
$row = mysqli_fetch_assoc($query);

$sql = "select";
$query = $conn->query($sql)->num_rows;
$query = $conn->query($sql)->fetch_assoc();
