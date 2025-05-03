<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa người dùng</title>
</head>
<body>
    <h2>Chỉnh sửa người dùng</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="user_name">Tên:</label>
        <input type="text" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}" required><br><br>

        <label for="user_email">Email:</label>
        <input type="email" id="user_email" name="user_email" value="{{ old('user_email', $user->user_email) }}" required><br><br>

        <button type="submit">Cập nhật</button>
    </form>

    <a href="{{ route('users.index') }}">Quay lại danh sách</a>
</body>
</html>
