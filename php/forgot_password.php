<?php
session_start();
require './database.php';

$error = $success = "";
$status = false;
$resetLink = "";

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

            $resetLink = "http://laptrinhweb.local/php/reset_password.php?token=" . $token;

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

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
        }

        input[type="email"]:focus {
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
        <h3>Quên mật khẩu</h3>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
    <p class="success"><?= htmlspecialchars($success) ?></p>
    <p>Chuyển hướng đến trang đặt lại mật khẩu trong <span id="countdown">5</span> giây...</p>
    <script>
        let seconds = 5;
        const countdown = document.getElementById('countdown');

        const interval = setInterval(() => {
            seconds--;
            countdown.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(interval);
                window.location.href = "<?= $resetLink ?>";
            }
        }, 1000); // Giảm mỗi giây
    </script>
<?php endif; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Nhập email đã đăng ký" required>
            <button type="submit">Gửi yêu cầu</button>
        </form>
        <a href="login.php">Quay lại đăng nhập</a>
    </div>
</body>

</html>