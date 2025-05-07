<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "product";
    $conn = new mysqli($servername, $username, $password, $database) or die("Kết nối thất bại: " . $conn->connect_error);
    mysqli_set_charset($conn, 'utf8');
?>