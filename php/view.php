<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bke_users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$user = null;
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $result = $conn->query("SELECT user_name, user_email FROM users WHERE user_id = $id");
    $user = $result->fetch_assoc();
}

if (!$user) {
    echo "<p>Không tìm thấy user!</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: black;
            text-align: center;
            transition: background 0.3s, color 0.3s;
        }
        .dark-mode {
            background-color: #1e3a8a;
            color: white;
        }
        header, footer {
            background: #007bff;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav {
            display: flex;
            gap: 15px;
        }
        nav a {
            color: white;
            text-decoration: none;
        }
        .right-section {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        #toggle-bg {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: white;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }
        .info-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            max-width: 500px;
            width: 100%;
            text-align: left;
        }
        .dark-mode .info-box {
            background: #1e40af;
            color: white;
        }
        .info-box h3 {
            text-align: center;
        }
        .info-group {
            margin-bottom: 15px;
        }
        .info-group label {
            font-weight: bold;
        }
        .info-group span {
            margin-left: 10px;
            font-weight: bold;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            margin-top: 15px;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <a href="index.html">Home</a>
        </nav>
        <div class="right-section">
            <a href="./logout.php" style="color: white; text-decoration: none;">Đăng xuất</a>
            <button id="toggle-bg">🌙</button>
        </div>
    </header>
    
    <div class="container">
        <div class="info-box">
            <h3>Màn hình chi tiết</h3>
            <div class="info-group">
                <label>Username:</label>
                <span><?php echo htmlspecialchars($user['user_name']); ?></span>
            </div>
            <div class="info-group">
                <label>Email:</label>
                <span><?php echo htmlspecialchars($user['user_email']); ?></span>
            </div>
            <a href="update.php?id=<?php echo $id; ?>" class="btn">Chỉnh sửa</a>
        </div>
    </div>
    
    <footer>
        <p>Lập trình web @01/2024</p>
    </footer>

    <script>
        document.getElementById('toggle-bg').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            this.textContent = document.body.classList.contains('dark-mode') ? '☀️' : '🌙';
        });
    </script>
</body>
</html>

<?php $conn->close(); ?>
