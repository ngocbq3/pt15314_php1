<?php
//Khai báo các biến
//Tên server mysql
$host = 'localhost';
//username truy cập vào database
$username = 'root';
//password của root
$password = '';
//Tên database cần truy cập
$dbname = 'pt15314-php1';

try {
    $conn = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8", $username, $password);
    // echo "Kết nối dữ liệu thành công";
} catch (PDOException $e) {
    echo "Lỗi kết nối dữ liệu<br>" . $e->getMessage();
}
