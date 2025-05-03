<?php
$servername = "localhost"; // Hoặc IP server
$username = "root"; // Tài khoản MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "bke_users"; // Tên database của bạn

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn lấy danh sách user
$sql = "SELECT user_id, user_name, user_email FROM users"; // Đổi tên bảng nếu cần
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

// Trả về dữ liệu JSON
echo json_encode($users);

$conn->close();
?>
