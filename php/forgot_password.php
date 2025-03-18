<?php
session_start();
require './database.php';

$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (!empty($email)) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $token = bin2hex(random_bytes(32));  // Tạo token ngẫu nhiên
            $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE user_email = ?");
            $stmt->bind_param("ss", $token, $email);
            $stmt->execute();

            $resetLink = "http://yourdomain.com/reset_password.php?token=" . $token;

            // Gửi email đặt lại mật khẩu (giả lập)
            // mail($email, "Đặt lại mật khẩu", "Nhấn vào link sau để đặt lại mật khẩu: " . $resetLink);

            $success = "🔗 Đã gửi email đặt lại mật khẩu. Vui lòng kiểm tra hộp thư!";
        } else {
            $error = "⚠ Email không tồn tại trong hệ thống!";
        }

        $stmt->close();
    } else {
        $error = "⚠ Vui lòng nhập email!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
</head>
<body>
    <h3>Quên mật khẩu</h3>
    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="email" name="email" placeholder="Nhập email đã đăng ký" required>
        <button type="submit">Gửi yêu cầu</button>
    </form>
    <a href="login.php">Quay lại đăng nhập</a>
</body>
</html>
