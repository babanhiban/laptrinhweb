<?php
session_start();
require './database.php';

$error = $success = "";
$token = $_GET['token'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = trim($_POST['new_password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if ($newPassword === $confirmPassword && !empty($token)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET user_password = ?, reset_token = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $hashedPassword, $token);

        if ($stmt->execute()) {
            $success = "✅ Mật khẩu đã được đặt lại thành công!";
        } else {
            $error = "❌ Đặt lại mật khẩu thất bại!";
        }

        $stmt->close();
    } else {
        $error = "⚠ Mật khẩu không khớp hoặc token không hợp lệ!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            width: 400px;
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        h3 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
        }

        input[type="password"]:focus {
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        p {
            margin-top: 10px;
            font-weight: bold;
        }

        p.error {
            color: #dc3545;
        }

        p.success {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Đặt lại mật khẩu</h3>
        <?php if (isset($error) && $error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (isset($success) && $success): ?>
            <p class="success"><?= htmlspecialchars($success) ?></p>
            <p>Chuyển hướng về trang đăng nhập trong <span id="countdown">5</span> giây...</p>
            <script>
                let countdown = 5;
                const countdownElement = document.getElementById("countdown");

                const interval = setInterval(() => {
                    countdown--;
                    countdownElement.textContent = countdown;

                    if (countdown === 0) {
                        clearInterval(interval);
                        window.location.href = "login.php";
                    }
                }, 1000);
            </script>
        <?php else: ?>
            <form method="POST">
                <input type="password" name="new_password" placeholder="Mật khẩu mới" required>
                <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                <button type="submit">Đặt lại mật khẩu</button>
            </form>
        <?php endif; ?>
        <a href="login.php">Quay lại đăng nhập</a>
    </div>
</body>
</html>
