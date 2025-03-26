<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row mt-5 align-items-center">
            <div class="col-md-6 text-center">
                <img src="{{ asset('assets/attachment/tata-ipl-logo-png_seeklogo-531750.png') }}" alt="IPL Logo"
                    class="img-fluid" style="max-width: 70%; height: auto;">
            </div>
            <div class="col-md-6">
                {!! Form::open(['route' => 'user.login', 'method' => 'post', 'id' => 'loginForm']) !!}
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('userName', 'Name', ['class' => 'required']) !!}
                        {!! Form::text('userName', '', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your name',
                            'id' => 'userName',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        {!! Form::label('password', 'Password', ['class' => 'required']) !!}
                        {!! Form::password('password', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your password',
                            'id' => 'password',
                        ]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div style="margin-bottom: 20px;">
                        @if (session('error'))
                            <div class="d-block">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-outline-primary btn-sm">Submit</button>
                    <button type="reset" class="btn btn-outline-info btn-sm">Cancel</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
