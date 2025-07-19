<!DOCTYPE html>
<html>

<head>
    <title>Post Detail-Admin</title>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5">

    <h1 style="font-family: 'Book Antiqua', Palatino, serif;" class="text-dark fw-bold">
        {{ $post->title }}
    </h1>
    <hr>
    @if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}"
        alt="Post Image"
        class="img-fluid w-100 rounded shadow mb-3"
        style="max-height: 500px; object-fit: cover;">
    @endif

    <strong>Published on:</strong> {{ $post->created_at->format('d M Y') }} |
    <span class="text-primary">written by: {{ $post->author }}</span>
    <hr>

    <div>{!! $post->content !!}</div>
    <p>
        <a href="{{ route('public.welcome') }}" class="btn btn-secondary mt-3">← Back to Blog List</a>
    </p>
</body>

</html>