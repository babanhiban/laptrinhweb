<?php
require './database.php'; // Kết nối database

function generateRandomString($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createRandomUsers($conn, $count = 10) {
    $roles = ['user', 'user', 'user', 'user']; // Đa số user, tránh admin
    $created = 0;

    while ($created < $count) {
        $username = generateRandomString();
        $email = $username . '@example.com';
        $password = password_hash('123456', PASSWORD_DEFAULT);
        $role = $roles[array_rand($roles)];
        $create_at = date('Y-m-d H:i:s'); // Lấy thời gian hiện tại

        // Kiểm tra trùng username hoặc email
        $checkQuery = "SELECT * FROM users WHERE user_name = ? OR user_email = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $insertQuery = "INSERT INTO users (user_name, user_email, user_password, role, create_at) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);
            $stmt->bind_param("sssss", $username, $email, $password, $role, $create_at);

            if ($stmt->execute()) {
                echo "✅ User {$username} đã được tạo thành công!<br>";
                $created++;
            } else {
                echo "❌ Lỗi khi tạo user {$username}.<br>";
            }
        }

        $stmt->close();
    }
}

// Tạo 10 user ngẫu nhiên
createRandomUsers($conn, 10);

$conn->close();
?>
