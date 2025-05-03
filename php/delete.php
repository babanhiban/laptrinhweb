<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bke_users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Kiểm tra xem user có phải admin mặc định không
    $result = $conn->query("SELECT role FROM users WHERE user_id = $id");
    $row = $result->fetch_assoc();

    if ($row && $row['role'] === 'admin') {
        echo "⚠️ Không thể xóa tài khoản Admin mặc định!";
    } else {
        $conn->query("DELETE FROM users WHERE user_id = $id");
    }
}

$conn->close();
header("Location: list.php");
exit;
?>
