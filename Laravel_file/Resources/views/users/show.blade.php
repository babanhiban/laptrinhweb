<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết người dùng</title>
</head>
<body>
    <h2>Thông tin người dùng</h2>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Tên:</strong> {{ $user->user_name }}</p>
    <p><strong>Email:</strong> {{ $user->user_email }}</p>

    <a href="{{ route('users.index') }}">Quay lại danh sách</a>
</body>
</html>
