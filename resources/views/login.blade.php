<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 90%;
            margin: 0;
            background-color: #f7f7f7;
        }

        .center-wrapper {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
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
        <div class="login-card">
            <h3 class="text-center mb-1">Login</h3>
            <p class="fill-me">Please enter your credential</p>

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="/login">
                @csrf
                <div class="mb-3 ">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control bg-light" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button class="btn btn-dark w-100">Login</button>

            </form>

            <p class="fill-me"><a href='/signup'>Create Account</a></p>
        </div>
    </div>

</body>

</html>