<?php
session_start();
require './database.php'; // Kết nối database

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['rememberMe']);

    if (!empty($username) && !empty($password)) {
        $stmt = $conn->prepare("SELECT user_id, user_name, user_password FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];

                if ($remember) {
                    setcookie("username", $user['user_name'], time() + (86400 * 30), "/");
                    setcookie("user_id", $user['user_id'], time() + (86400 * 30), "/");
                }

                header("Location: list.php");
                exit();
            } else {
                $error = "⚠ Sai mật khẩu!";
            }
        } else {
            $error = "⚠ Tài khoản không tồn tại!";
        }

        $stmt->close();
    } else {
        $error = "⚠ Vui lòng nhập đầy đủ thông tin!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("dark-mode");
            document.getElementById("theme-icon").textContent = document.body.classList.contains("dark-mode") ? "☀️" : "🌙";
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: black;
            transition: background 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #1e3a8a;
            color: white;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            height: 56px;
            background: #007bff;
            color: white;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        #theme-icon {
            cursor: pointer;
            font-size: 24px;
        }
        .content {
            padding: 30px;
            text-align: center;
        }
        .login-box {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            transition: background 0.3s;
        }
        .dark-mode .login-box {
            background: #1e40af;
        }
        footer {
            text-align: center;
            padding: 10px;
            background: #007bff;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Home</a> |
            <a href="login.php">Đăng nhập</a> |
            <a href="register.php">Đăng ký</a>
        </nav>
        <span id="theme-icon" onclick="toggleDarkMode()">🌙</span>
    </header>
    
    <section class="content">
        <div class="login-box">
            <h3 class="mb-4">Màn hình đăng nhập</h3>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3 text-start">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" 
                        value="<?= isset($_COOKIE['username']) ? htmlspecialchars($_COOKIE['username']) : ''; ?>" required>
                </div>
                <div class="mb-3 text-start">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3 form-switch text-start">
                    <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe" 
                        <?= isset($_COOKIE['username']) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="rememberMe">Ghi nhớ đăng nhập</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
            </form>

            <a href="forgot_password.php" class="d-block mt-3">Quên mật khẩu?</a>
        </div>
    </section>
    
    <footer>
        <p>© 2025</p>
    </footer>
</body>
</html>
