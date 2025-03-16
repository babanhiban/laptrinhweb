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
  
  // Xử lý khi submit form
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $conn->query("UPDATE users SET user_name = '$name', user_email = '$email' WHERE user_id = $id");
      header("Location: view.php?id=$id");
      exit;
  }
  ?>
  
  <!DOCTYPE html>
  <html lang="vi">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cập nhật thông tin</title>
      <link rel="stylesheet" href="style.css">
      <style>
          body {
              font-family: Arial, sans-serif;
              background-color: #f8f9fa;
              color: black;
              text-align: center;
              transition: background 0.3s, color 0.3s;
              display: flex;
              flex-direction: column;
              min-height: 100vh;
          }
          .dark-mode {
              background-color: #0a192f;
              color: white;
          }
          header {
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
              flex-direction: column;
              align-items: center;
              margin-top: 20px;
              flex-grow: 1;
          }
          .info-box {
              background: white;
              padding: 40px;
              border-radius: 15px;
              box-shadow: 0px 0px 15px gray;
              max-width: 600px;
              width: 100%;
              text-align: left;
          }
          .dark-mode .info-box {
              background: #1e3a8a;
              color: white;
          }
          .info-box h3 {
              text-align: center;
          }
          .info-group {
              margin-bottom: 20px;
          }
          .info-group label {
              font-weight: bold;
          }
          .info-group input {
              width: 100%;
              padding: 10px;
              border-radius: 5px;
              border: 1px solid #ccc;
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
              cursor: pointer;
          }
          .btn:hover {
              background: #0056b3;
          }
          footer {
              background: #007bff;
              color: white;
              padding: 10px;
              text-align: center;
              margin-top: auto;
          }
      </style>
  </head>
  <body>
      <header>
          <nav>
              <a href="index.html">Home</a>
          </nav>
          <div class="right-section">
              <a href="logout.html" style="color: white; text-decoration: none;">Đăng xuất</a>
              <button id="toggle-bg">🌙</button>
          </div>
      </header>
  
      <div class="container">
          <div class="info-box">
              <h3>Chỉnh sửa User</h3>
              <form method="POST">
                  <div class="info-group">
                      <label>Username:</label>
                      <input type="text" name="name" value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
                  </div>
                  <div class="info-group">
                      <label>Email:</label>
                      <input type="email" name="email" value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
                  </div>
                  <button type="submit" class="btn">Cập nhật</button>
              </form>
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
