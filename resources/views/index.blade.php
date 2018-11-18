<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>RentMyCar.co.ke | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="RentMyCar.co.ke"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.css" type='text/css'/>
    <!-- //lined-icons -->
    <!-- Meters graphs -->
    <script src="js/jquery-2.1.4.js"></script>


</head>

<!-- /w3layouts-agile -->
<body class="sticky-header left-side-collapsed">

<section>
    <!-- left side start-->
{{--@include('sidebar')--}}
<!-- /w3layouts-agile -->
    <!-- app-->
{{--<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">--}}
{{--<div class="modal-dialog facebook" role="document">--}}
{{--<div class="modal-content">--}}
{{----}}
{{--<div class="modal-body">--}}
{{--<div class="app-grids">--}}
{{--<div class="app">--}}
{{--<div class="col-md-5 app-left mpl">--}}
{{--<h3>DayStarFilm mobile app on your smartphone!</h3>--}}
{{--<p>Download and Avail Special Songs Videos and Audios.</p>--}}
{{--<div class="app-devices">--}}
{{--<h5>Gets the app from</h5>--}}
{{--<a href="#"><img src="images/1.png" alt=""></a>--}}
{{--<a href="#"><img src="images/2.png" alt=""></a>--}}
{{--<div class="clearfix"></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-md-7 app-image">--}}
{{--<img src="images/apps.png" alt="">--}}
{{--</div>--}}
{{--<div class="clearfix"></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
<!-- //app-->
    <!-- /w3l-agile -->
    <!-- signup -->

    <!-- //signup -->
    <!-- /w3l-agile -->
    <!-- left side end-->
    <!-- main content start-->
    <!--<div class="main-content" style="">-->
    <div class="container" style="">
        <div style="" class="border-all">
            <!-- header-starts -->
        @include('header')
        <!--notification menu end -->
            <!-- //header-ends -->
            <!-- /w3l-agileits -->
            <!-- //header-ends -->
            <div id="page-wrapper" style="padding-top: 0">
                <div class="inner-content">
                    <div class="">
                        <!--banner-section-->
                        <div class="banner-section">
                            <div class="banner">
                                <div class="callbacks_container">
                                    <ul class="rslides callbacks callbacks1" id="slider4">
                                        @foreach($front_images as $front_image)
                                            <li>
                                                <div class="modal-body row">
                                                    <div class="col-md-6">

                                                        <div class="banner-img">
                                                            <img src="{{$front_image->image_url}}"
                                                                 class="img-responsive" alt=""
                                                                 style="max-height: 250px;max-width: 100%;">
                                                        </div>
                                                        {{--                                            <div class="banner-info">
                                                                                                    <a class="trend" href="">Featured</a>
                                                                                                    <h3>Let Your Home</h3>
                                                                                                    <p>Album by <span>Rock star</span></p>
                                                                                                    </div>--}}

                                                    </div>
                                                    <div class="col-md-6">
                                                        {!!html_entity_decode($front_image->description)!!}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>


                                </div>
                                <!--banner-->
                                <script src="js/responsiveslides.min.js"></script>
                                <script>
                                    // You can also use "$(window).load(function() {"
                                    $(function () {
                                        // Slideshow 4
                                        $("#slider4").responsiveSlides({
                                            auto: true,
                                            pager: true,
                                            nav: true,
                                            speed: 500,
                                            namespace: "callbacks",
                                            before: function () {
                                                $('.events').append("<li>before event fired.</li>");
                                            },
                                            after: function () {
                                                $('.events').append("<li>after event fired.</li>");
                                            }
                                        });

                                    });
                                </script>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!--//End-banner-->
                        <!--albums-->
                        <!-- pop-up-box -->
                        <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all">
                        <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
                        <script>
                            $(document).ready(function () {
                                $('.popup-with-zoom-anim').magnificPopup({
                                    type: 'inline',
                                    fixedContentPos: false,
                                    fixedBgPos: true,
                                    overflowY: 'auto',
                                    closeBtnInside: true,
                                    preloader: false,
                                    midClick: true,
                                    removalDelay: 300,
                                    mainClass: 'my-mfp-zoom-in'
                                });
                            });
                        </script>


                        <!--//pop-up-box -->

                        <hr style="color: black; height: 3px">
                        <div style="">

                            <?php
                            /* $ipaddress = '';
                             if (isset($_SERVER['HTTP_CLIENT_IP']))
                                 $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                             else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                                 $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                             else if(isset($_SERVER['HTTP_X_FORWARDED']))
                                 $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                             else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
                                 $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
                             else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                                 $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                             else if(isset($_SERVER['HTTP_FORWARDED']))
                                 $ipaddress = $_SERVER['HTTP_FORWARDED'];
                             else if(isset($_SERVER['REMOTE_ADDR']))
                                 $ipaddress = $_SERVER['REMOTE_ADDR'];
                             else
                                 $ipaddress = 'UNKNOWN';
                             //echo $ipaddress;*/
                            ?>
                            @foreach($videos as $category_name => $video_in_category)
                                <h4 style="text-align: center">{{$category_name}}</h4>
                                @foreach($video_in_category as $vides)
                                    <div class="col-md-3 content-grid last-grid">
                                        <a href="{!!'/mypost?video='. $vides->id.'&id='!!}"><img
                                                    src="{!! $vides->imageurl!!}"
                                                    title="Click for more"></a>
                                        <div class="inner-info"><a href="{!!'/mypost?video='. $vides->id.'&id=' !!}">
                                                <h5>{{$vides->title}}</h5></a></div>
                                    </div>
                                @endforeach
                                <a href="videos/category/{{$category_name}}">
                                    <button type="button" class="btn btn-success btn-sm pull-right"
                                            style="margin-top: 10px"><span class="fa fa-plus-circle"> Click to view more <span
                                                    style="color: black">{{$category_name}}
                                    </button>
                                </a>
                                <div class="clearfix"></div>
                            @endforeach
                            <div class="clearfix"></div>
                        </div>
                        <!--//End-albums-->
                        <!--//discover-view-->
                        <!--//discover-view-->
                    </div>
                    <!--//music-left-->
                    <!--/music-right-->

                    <!--//music-right-->
                    <!-- /w3l-agile-its -->
                </div>


                <!--body wrapper start-->


            </div>
            <div class="clearfix"></div>
            <!--body wrapper end-->
            <!-- /w3l-agile -->

            @include('sponsor')
            {{--@include('map')--}}
            <div class="clearfix"></div>
            @include('footer')
        </div>
    </div>
    <!--body wrapper end-->

    <!--footer section end-->
    <!-- /w3l-agile -->
    <!-- main content end-->
</section>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>
<div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>
