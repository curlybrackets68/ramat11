<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f5f5f5;
        }

        .container {
            display: flex;
            width: 800px;
            height: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .left {
            flex: 1;
            background: linear-gradient(to bottom right, #007bff, #0056b3);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }

        .left h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .left p {
            font-size: 14px;
            opacity: 0.8;
        }

        .right {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .right h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            width: 100%;
            margin-bottom: 15px;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #0056b3;
        }

        .links {
            margin-top: 10px;
            font-size: 14px;
        }

        .links a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>WELCOME BACK</h1>
            <p>Nice to see you again. Please log in to continue.</p>
        </div>
        <div class="right">
            <h2>Login Account</h2>
            <form>
                <div class="input-group">
                    {!! Form::label('email', 'Email', ['class' => 'required']) !!}
                    {!! Form::email('email', '', [
                        'class' => 'form-control form-control-sm required',
                        'placeholder' => 'Enter your email',
                        'id' => 'email',
                    ]) !!}
                </div>
                <div class="input-group">
                    {!! Form::label('password', 'Password', ['class' => 'required']) !!}
                    {!! Form::password('password', [
                        'class' => 'form-control form-control-sm required',
                        'placeholder' => 'Enter your password',
                        'id' => 'password',
                    ]) !!}
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <div class="links">
                <a href="#">Forgot password?</a> |
                <a href="{{ route('user.show.register-page') }}">Create A New Registration</a>
            </div>
        </div>
    </div>
</body>

</html>
