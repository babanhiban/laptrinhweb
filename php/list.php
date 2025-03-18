<?php
$servername = "localhost"; // Hoặc IP server của bạn
$username = "root"; // Tài khoản MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "bke_users"; // Tên database của bạn

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xác định trang hiện tại
$limit = 10; // Số user mỗi trang
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Truy vấn tổng số user
$total_sql = "SELECT COUNT(*) AS total FROM users";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_users = $total_row['total'];
$total_pages = ceil($total_users / $limit);

// Truy vấn lấy danh sách user theo trang
$sql = "SELECT user_id, user_name, user_email FROM users LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: black;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            background: #007bff;
            padding: 10px 20px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .user-list-container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 5px 10px;
            margin: 0 5px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background: #0056b3;
        }

        .btn {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-edit {
            background: #28a745;
        }

        .btn-view {
            background: #17a2b8;
        }

        .btn-delete {
            background: #dc3545;
        }

        .btn:hover {
            opacity: 0.8;
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
    <div class="navbar">
        <a href="./index.php">Home</a>
        <a href="./logout.php">Đăng xuất</a>
    </div>

    <div class="user-list-container">
        <h2>Danh sách người dùng</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $i = $offset + 1;
                    while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$i}</td>
                                    <td>{$row['user_name']}</td>
                                    <td>{$row['user_email']}</td>
                                <td>
                                    <a href='view.php?id={$row['user_id']}' class='btn btn-view'>View</a>
                                    <a href='update.php?id={$row['user_id']}' class='btn btn-edit'>Edit</a>
                                    <a href='delete.php?id={$row['user_id']}' class='btn btn-delete' onclick='return confirm(\"Xác nhận xóa user?\")'>Delete</a>
                                </td>
                                </tr>";
                         $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php echo ($i == $page) ? 'style="background: #0056b3;"' : ''; ?>><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>Lập trình web @01/2024</p>
    </footer>
</body>

</html>

<?php
$conn->close();
?>