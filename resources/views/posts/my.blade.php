@php
use App\Models\User;
$user = User::where('email', session('user'))->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Posts</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fc;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.3rem;
        }

        .user-name {
            font-weight: 500;
            color: #0d6efd;
            margin-right: 1rem;
        }

        .table thead th {
            background-color: #f9f9f9;
            font-weight: 600;
        }

        .action-link {
            margin-right: 10px;
        }

        .action-link.edit {
            color: #0d6efd;
            text-decoration: none;
        }

        .action-link.delete {
            color: red;
            text-decoration: none;
            background: none;
            border: none;
        }

        .action-link.delete:hover,
        .action-link.edit:hover {
            text-decoration: underline;
        }

        .main-box {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="text-primary fw-bold fs-3">☺</span><span>Postify </span>
                <span class="text-primary fw-semibold ms-2">
                    Hi,{{ $user->name ?? 'Guest' }}

                </span>
            </a>

            <div class="ms-auto d-flex align-items-center ">
                <a href="/welcome" class="btn btn-outline-danger btn-sm me-2">Home</a>
                <a href="/logout" class="btn btn-outline-danger btn-sm">Logout</a>

            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="main-box">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">My Posts</h2>
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->created_at->format('Y-m-d') }}</td>
                            <td class="text-end">
                                <a href="{{ route('posts.edit', $post->id) }}" class="action-link edit">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this post?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-link delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($posts->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center text-muted">No posts found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>