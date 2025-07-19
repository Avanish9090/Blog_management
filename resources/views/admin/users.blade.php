<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Users - Admin</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .nav-link {
            color: #000;
            font-weight: 500;
        }

        .nav-link.active {
            color: #0d6efd;
        }

        h2 {
            font-weight: 600;
        }

        .table th {
            background-color: #f9f9f9;
        }

        .post-count {
            color: #0d6efd;
            font-weight: 500;
        }

        .delete-btn {
            color: red;
            background: none;
            border: none;
            padding: 0;
        }

        .delete-btn:hover {
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="text-primary">☺&nbsp;</span><span>Postify</span>
            </a>

            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="/posts">Posts</a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link active" href="{{ route('admin.users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">All Users</h2>

        @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Users</th>
                        <th>Author</th>
                        <th>Post Count</th>
                        <th>Added on</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usersData as $user)
                    <tr>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td class="post-count text-primary">{{ $user['post_count'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($user['latest_post_date'])->format('Y-m-d') ?? '—' }}</td>
                        <td class="text-end">
                            <form action="{{ route('admin.user.delete', $user['id']) }}" method="POST" onsubmit="return confirm('Delete user and all their posts?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>