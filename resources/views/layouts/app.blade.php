<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    
    <title>Pamiętnik programisty</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('/css/timeline.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/dropdown_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/print.css') }}">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>

<body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Pamietnik
                </a>
            </div>

            <div class="navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <!-- Add navigation links here -->
                </ul>


                <!-- Move login functionality to the right side of the navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @auth
                    <!-- Display user-related information and logout link if the user is logged in -->
                    <li>
                        <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @else
                    <!-- Display login form if the user is not logged in -->
                    <li>
                        <form class="navbar-form" action="/login" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" name="loginName" placeholder="Username/Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="loginPassword" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
    @endif

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Include jscolor color picker library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.4.5/jscolor.min.js"></script>

</body>

</html>