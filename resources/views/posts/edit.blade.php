<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/ckeditor/build/ckeditor.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .edit-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 50px auto;
        }

        .current-image {
            max-width: 150px;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="edit-card">
        <h3 class="mb-4 text-center text-primary">Edit Post</h3>

        <form method="POST" action="{{ route('posts.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" id="editor" class="form-control" rows="10">{{ $post->content }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="current-image" alt="Current Image">
                @else
                <p>No image uploaded.</p>
                @endif
            </div>

            <div class="mb-4">
                <label class="form-label">Change Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-success w-100">Update Post</button>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'underline', 'fontColor', 'fontBackgroundColor',
                    'link', 'bulletedList', 'numberedList', '|', 'fontSize', 'undo', 'redo'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>

</body>

</html>