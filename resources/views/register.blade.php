<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Register Page</title>
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
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 800px;
        }

        .left {
            color: white;
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
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; gap: 20px;">
            <div class="left" style="border-right: 2px solid #ccc; padding-right: 20px;">
                <img src="https://t3.ftcdn.net/jpg/09/07/12/92/360_F_907129237_yxn7bmaNL9X2ryCTRsym0wMbckHOWDiL.jpg"
                    alt="Registration Image" style="width: 300px;height: 500px;" class="text-start">
            </div>
            <div class="right">
                <div class="row">
                    <h4 class="card-title text-center">Registration Form</h4>
                </div>
                <hr>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        {!! Form::label('first_name', 'First Name', ['class' => 'required']) !!} <br>
                        {!! Form::text('first_name', '', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your First Name',
                            'id' => 'firstName',
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('last_name', 'Last Name', ['class' => 'required']) !!} <br>
                        {!! Form::text('last_name', '', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your Last Name',
                            'id' => 'lastName',
                        ]) !!}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        {!! Form::label('email', 'Email', ['class' => 'required']) !!} <br>
                        {!! Form::email('email', '', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your Email',
                            'id' => 'userEmail',
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('mobile', 'Mobile Number', ['class' => 'required']) !!} <br>
                        {!! Form::text('mobile', '', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your Mobile',
                            'id' => 'userMobile',
                        ]) !!}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        {!! Form::label('password', 'Password', ['class' => 'required']) !!} <br>
                        {!! Form::password('password', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your password',
                            'id' => 'password',
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'required']) !!} <br>
                        {!! Form::text('conform_password', '', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your Confirm Password',
                            'id' => 'conformPassword',
                        ]) !!}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        {!! Form::label('password', 'Password', ['class' => 'required']) !!} <br>
                        {!! Form::password('password', [
                            'class' => 'form-control form-control-sm required',
                            'placeholder' => 'Enter your password',
                            'id' => 'password',
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('gender', 'Gender', ['class' => 'required']) !!} <br>
                        {!! Form::radio('gender', 'male') !!} Male
                        {!! Form::radio('gender', 'female') !!} Female
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-sm-6">
                        {!! Form::label('attachment', 'User Attachment') !!}
                        {!! Form::file('attachment', null, [
                            'class' => 'form-control form-control-sm',
                            'id' => 'attachment',
                            'accept' => 'image/*',
                        ]) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('country', 'Country') !!} <br>
                        {!! Form::select('country', [], null, [
                            'class' => 'country',
                            'id' => 'country',
                            'placeholder' => 'Select your country',
                        ]) !!}
                        <div style="width: 20%" class=" ">
                            <a href="{{ route('user.show.country') }}" target="_blank"
                                class="btn btn-soft-success btn-sm btn-icon waves-effect waves-light"
                                id="erpAddClientbtn"><i class="ri-add-line align-middle"></i></a>

                            <a class="btn btn-soft-success btn-sm btn-icon waves-effect waves-light" data-project="CRM"
                                id="erpRefreshClientbtn"><i class="ri-refresh-line align-middle"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#country').select2();
            // getCountryData();
        });

        // function getCountryData() {
        //     $.ajax({
        //         url: 'https://pincodedirectory.co.in/admin/country',
        //         type: 'GET',
        //         dataType: 'json',
        //         success: function(response) {
        //             var countries = response.data;
        //             var options = '';
        //             countries.forEach(function(country) {
        //                 options += '<option value="' + country.id + '">' + country.name + '</option>';
        //             });
        //             $('#country').html(options);
        //         }
        //     });
        // }
    </script>
</body>

</html>
