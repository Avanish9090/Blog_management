<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .admin-card {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-group a {
            min-width: 120px;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="admin-card">
            <div class="admin-header mb-4">
                <div>
                    <h2 class="text-primary">Welcome, Admin</h2>
                    <p class="text-muted mb-0">Logged in as: <strong>{{ session('user') }}</strong></p>
                </div>
                <a href="/logout" class="btn btn-outline-danger">Logout</a>
            </div>

            <hr>

            <h5 class="mb-3">Dashboard Actions</h5>
            <div class="btn-group d-flex flex-wrap gap-2">
                <a href="/posts" class="btn btn-primary">All Posts</a>
                <a href="{{ route('admin.users') }}" class="btn btn-success">Manage Users</a>
            </div>
        </div>
    </div>

</body>

</html>