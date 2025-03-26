<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body
    style="background-image: url('{{ asset('assets/attachment/bg-img.jpg') }}'); height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow" style="width: 400px;">
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/attachment/tata-ipl-logo-png_seeklogo-531750.png') }}" alt="IPL Logo"
                        class="img-fluid" style="max-width: 70%; height: auto;">
                </div>
                {!! Form::open(['route' => 'user.login', 'method' => 'post', 'id' => 'loginForm']) !!}
                <div class="form-group">
                    {!! Form::label('userName', 'Name', ['class' => 'required']) !!}
                    {!! Form::text('userName', '', [
                        'class' => 'form-control form-control-sm required',
                        'placeholder' => 'Enter your name',
                        'id' => 'userName',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password', ['class' => 'required']) !!}
                    {!! Form::password('password', [
                        'class' => 'form-control form-control-sm required',
                        'placeholder' => 'Enter your password',
                        'id' => 'password',
                    ]) !!}
                </div>
                @if (session('error'))
                    <div class="text-danger mb-2">
                        {{ session('error') }}
                    </div>
                @endif
                <div>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                    <button type="reset" class="btn btn-outline-info btn-sm">Cancel</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</body>
</html>
