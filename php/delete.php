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
    $conn->query("DELETE FROM users WHERE user_id = $id");
}

$conn->close();
header("Location: list.php");
exit;
?>
