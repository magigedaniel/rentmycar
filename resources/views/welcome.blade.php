<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RentMyCar.co.ke | Home</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    {{--Vegas addition to laravel--}}

    <script src="http://code.jquery.com/jquery.min.js"></script>


    <link rel="stylesheet" href="{{ asset ("/bower_components/vegas/dist/vegas.min.css")}}">
    <script src="{{ asset ("/bower_components/vegas/dist/vegas.min.js")}}"></script>

    {{--<script src="http://code.jquery.com/jquery.min.js"></script>--}}
    {{--<link rel="stylesheet" href="{{ asset ("/vegas/vegas.min.css")}}">--}}
    {{--<script src="{{ asset ("/vegas/vegas.min.js")}}"></script>--}}

    <!-- Styles -->
    <style>
        html, body {


            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
            {{--background: url("{{ asset ("/img/church3.jpg")}}") no-repeat center center fixed;--}}

             -webkit-background-size: contain;
            -moz-background-size: contain;
            -o-background-size: contain;
            background-size: contain;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }


        .links > a {
            color: #000000;
            padding: 0 25px;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>


<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        </div>
    @endif
</div>
</body>


</html>
<script>

    $("#example, body").vegas({
        slides: [
            {src: "{!!  asset ("/img/church3.jpg") !!}"},
            {src: "{!!  asset ("/img/church3.jpg") !!}"}
        ],
        animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
    });
</script>
