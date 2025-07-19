<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome - Blog List</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .welcome-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .post-card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .post-image {
            width: 120px;
            height: auto;
            object-fit: cover;
            border-radius: 6px;
        }
    </style>
</head>

<body class="container mt-5">

    <div class="welcome-header mb-4">
        <h2 class="text-dark"><span class="text-primary">☺</span>Postify</h2>
        <div>
            <a href="/login" class="btn btn-outline-primary me-2">Login</a>
            <a href="/signup" class="btn btn-primary">Signup</a>
        </div>
    </div>

    @foreach($posts as $post)
    <div class="post-card mb-4">
        <div class="d-flex justify-content-between align-items-start flex-wrap">
            <div class="flex-grow-1 me-3">
                <h2 style="font-family: 'Book Antiqua', Palatino, serif;" class="text-dark fw-bold">
                    {{ $post->title }}
                </h2>
                <p class="text-muted mb-0">
                    {{ $post->created_at->format('d M Y') }} ,
                    <span class="text-primary">{{ $post->user->name ?? 'Unknown' }}</span>
                </p>
            </div>

            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="image" class="post-image">
            @endif
        </div>
    </div>
    @endforeach

</body>

</html>