<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "product";
    $conn = new mysqli($servername, $username, $password, $database) or die("Kết nối thất bại: " . $conn->connect_error);
    mysqli_set_charset($conn, 'utf8');

    /*
     * sanpham: id, ten, nhanhang, giaban, image
     * thong-tin-hang-sua: id, ten-hang-sua, dia-chi, dien-thoai, email
     * khach-hang: id, ten-khach-hang, gioi-tinh, dia-chi, dien-thoai, email
     */
?>