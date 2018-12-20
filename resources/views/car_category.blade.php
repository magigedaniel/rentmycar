<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>Rentmycar.co.ke | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Rentmycar.co.ke"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/bootstrap.css')}}" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="{{asset('css/style.css')}}" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="{{asset('css/icon-font.css')}}" type='text/css'/>
    <!-- //lined-icons -->
    <!-- Meters graphs -->
    <script src="{{asset('js/jquery-2.1.4.js')}}"></script>


</head>

<!-- /w3layouts-agile -->
<body class="sticky-header left-side-collapsed">
    
<section>
  
    <!--<div class="main-content" style="">-->
    <div class="container" style="">
        <div style="" class="border-all">
            <!-- header-starts -->
        @include('header')
        <!--notification menu end -->
            <!-- //header-ends -->
            <!-- /w3l-agileits -->
            <!-- //header-ends -->
            <div id="page-wrapper">
                <div class="inner-content">
                        <h2 style="text-align: center; font-weight: 900;">{{$category_name}} </h2>
                        <div class="row">
                            @foreach($video_in_category as $car)





                                <div class="col-md-3 content-grid last-grid">
                                    <a href="{!!'/rentCar?car='. $car->id.'&id='!!}">
                                        <img src="../../{!! $car->imageurl!!}"
                                             title="Click to Hire"></a>
                                    {{--<div class="inner-info"><a href="{!!'/rentCar?car='. $car->id.'&id=' !!}">
                                            <h5>{{$car->title}}</h5></a></div>--}}
                                    <div class="second">
                                        <div class="listings__title">{{$car->title}}</div>

                                        <div class="listings__location">Location: {{$car->location}}</div>

                                        <div class="listings__price">
                                            <span>KSh </span>{{$car-> price_per_day}} per day
                                        </div>
                                        <a href="{!!'/rentCar?car='. $car->id.'&id='!!}">
                                            <button type="button" class="btn btn-success" id="btn-car">Rent Me</button></a>
                                    </div>

                                </div>



                                @endforeach
                        </div>
                        {{$video_in_category->links()}}
                </div>


                <!--body wrapper start-->


            </div>
            <div class="clearfix"></div>
            <!--body wrapper end-->
            <!-- /w3l-agile -->

            @include('sponsor')
            <div class="clearfix"></div>
            @include('footer')
        </div>
    </div>
    <!--body wrapper end-->

    <!--footer section end-->
    <!-- /w3l-agile -->
    <!-- main content end-->
</section>

<script src="{{asset('js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('js/bootstrap.js')}}"></script>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
