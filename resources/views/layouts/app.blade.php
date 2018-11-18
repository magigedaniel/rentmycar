<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EASFF') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        body{
            background-color: black;
        }
        .navbar-default {
            background-color: #000000;
        }
        .navbar-default .navbar-nav>li>a {
            color: #3097D1;
            color: #3097D1;
            font-size: 20px;
            font-weight: bold;
        }
        .navbar-default .navbar-nav>li>a:hover {
            background-color: #3097D1;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
        }
        .navbar-default .navbar-brand {
            color: #3097D1;
            font-size: 20px;
            font-weight: bold;
        }
        .navbar-default .navbar-brand :hover {
            background-color: #3097D1;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
        }
        .panel-heading {
            color: #000000;
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
