<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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

        th, td {
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

        .pagination nav {
            display: inline-block;
        }

        .btn {
            padding: 5px 10px;
            margin: 2px;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-edit { background: #28a745; }
        .btn-view { background: #17a2b8; }
        .btn-delete { background: #dc3545; }

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
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('logout') }}">Đăng xuất</a>
    </div>

    <div class="user-list-container">
        <h2>Danh sách người dùng</h2>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

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
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                        <td>{{ $user->user_name }}</td>
                        <td>{{ $user->user_email }}</td>
                        <td>
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-view">View</a>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Xác nhận xóa?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Không có dữ liệu</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>

    <footer>
        <p>Lập trình web @01/2024</p>
    </footer>
</body>
</html>
