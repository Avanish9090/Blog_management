@php
use App\Models\User;
$user = User::where('email', session('user'))->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Post</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/ckeditor/build/ckeditor.js"></script>


    <style>
        body {
            background-color: #f5f7fc;
        }

        .container-box {
            max-width: 800px;
            background: white;
            padding: 2rem;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .editor-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-light bg-white border-bottom">
        <div class="container d-flex justify-content-between">
            <div class="logo text-primary">
                <span class="text-primary fw-bold fs-3">☺</span>
                <span class="text-dark fw-semibold">Postify</span>
            </div>
            <span class="user-name text-primary fw-semibold">
                Hi,{{ $user->name ?? 'Guest' }}
            </span>
        </div>
    </nav>


    <div class="container-box">
        <h4 class="mb-4 text-center text-primary">Create New Post</h4>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Post Title</label>
                <input type="text" name="title" placeholder="Enter post title..." class="form-control bg-light" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Image</label>
                <input type="file" name="image" class="form-control bg-light">
            </div>

            <div class="mb-4">
                <label class="form-label">Post Content</label>
                <textarea name="content" id="editor" class="form-control mb-2"></textarea>
            </div>

            <div class="text-end">
                <button class="btn btn-primary px-4">Create</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            ClassicEditor.create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ url("/upload-image") }}'
                }
            }).then(editor => {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                    return new UploadAdapter(loader);
                };
            });

            class UploadAdapter {
                constructor(loader) {
                    this.loader = loader;
                }

                upload() {
                    return this.loader.file.then(file => {
                        return new Promise((resolve, reject) => {
                            const data = new FormData();
                            data.append('upload', file);

                            fetch('{{ url("/upload-image") }}', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: data
                                })
                                .then(response => response.json())
                                .then(result => {
                                    if (result.url) {
                                        resolve({
                                            default: result.url
                                        });
                                    } else {
                                        reject(result.error || 'Upload failed');
                                    }
                                })
                                .catch(error => {
                                    reject(error.message);
                                });
                        });
                    });
                }

                abort() {}
            }
        });
    </script>

</body>

</html>