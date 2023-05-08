<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SPK') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('form-login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('form-login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('form-login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('form-login/css/style.css') }}">

    <title>Login #8</title>
</head>

<body>



    <div class="content">
        <div class="container card my-4" style="border-radius: 50px;max-width: 652px; border: 0;">
            <div class="row p-5 shadow" style="border-radius: 50px">
                <div class="col-md-12 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3 style="font-family: 'Encode Sans';">Sign In</h3>
                            </div>
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group first">

                                    <label for="username">
                                        <span class="icon-user mr-3"></span>
                                        Username</label>
                                    <input type="text" class="form-control" id="username" name="username">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">
                                        <span class="icon-lock mr-3"></span>
                                        Password</label>
                                    <input type="password" class="form-control" id="password" name="password">

                                </div>


                                <div class="col-md-9" style="margin-left: -15px;">
                                    <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
    </div>


    <script src="{{ asset('form-login/js/jquery-3.3.1.min.js ') }}"></script>
    <script src="{{ asset('form-login/js/popper.min.js ') }}"></script>
    <script src="{{ asset('form-login/js/bootstrap.min.js ') }}"></script>
    <script src="{{ asset('form-login/js/main.js ') }}"></script>
</body>

</html>