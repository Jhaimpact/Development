<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name') }}-@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('') }}/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/2e8378281c.js" crossorigin="anonymous"></script>
    <link href="{{ url('') }}/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url('') }}/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }}</div>
                    @if ($errors->any())
                    <ul class="text-danger mt-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                     @endif
                        <div class="card-body text-center">
                            @isset($url)
                            <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                            @else
                            <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @endisset
                                @csrf
                                <input type="email" name="email" class="form-control mt-2" placeholder="Please Enter Your Email">
                                <input type="password" name="password" class="form-control mt-2" placeholder="Please Enter Your Password">
                                <input type="submit" class="btn btn-primary mt-2" placeholder="Submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>