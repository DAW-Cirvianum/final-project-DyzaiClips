<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Users</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #f4f4f4; }
        .btn { padding: 5px 10px; cursor: pointer; }
        .btn-role { background: #3498db; color: white; border: none; }
        .btn-delete { background: #e74c3c; color: white; border: none; }
        .success { color: green; margin-bottom: 10px; }
    </style>
</head>
<body>

<h1>Admin Panel - Users</h1>

@if(session('success'))
    <p class="success">{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('admin.users.role', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-role" type="submit">
                            Toggle Role
                        </button>
                    </form>

                    <form action="{{ route('admin.users.delete', $user) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-delete" type="submit">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
