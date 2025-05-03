<?php
$host = "localhost";  // Hoặc địa chỉ IP của server database
$user = "root";       // Tài khoản database
$pass = "";           // Mật khẩu database (nếu có thì điền vào)
$dbname = "bke_users"; // Tên database của bạn

// Kết nối MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$conn->set_charset("utf8"); // Đảm bảo sử dụng UTF-8
?>
