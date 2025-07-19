<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #f7f7f7;
        }

        .center-wrapper {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .signup-card {
            width: 100%;
            max-width: 600px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .fill-me {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <h2 class="text-center text-dark bg-light p-3"><span class="text-primary">☺</span>Postify</h2>
    <div class="center-wrapper">
        <div class="signup-card">
            <h3 class="text-center mb-1">Register</h3>
            <p class="fill-me">Register as user</p>

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif


            <form method="POST" action="/signup">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" class="form-control bg-light" placeholder="Enter your name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control bg-light" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control bg-light" placeholder="Enter password" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Re-enter Password</label>
                    <input name="repassword" type="password" class="form-control bg-light" placeholder="Re-enter password" required>
                </div>

                <button class="btn btn-dark w-100">Sign Up</button>
            </form>
            <p class="fill-me"><a href='/login'>Sign in</a></p>
        </div>
    </div>

</body>

</html>