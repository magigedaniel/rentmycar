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
                        <h2 style="text-align: center; font-weight: 900;">{{$current_year.' '.$category_name}} Videos</h2>
                            <?php
                            $ipaddress = '';
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
                            //echo $ipaddress;
                            ?>
                        <div class="row">
                            @foreach($video_in_category as $video_archive1)
                            <div class="col-md-4">
                                            <!--<div class="caption">-->
                                                <h5 class="text-black text-sm" style="font-weight: 800; text-align: center">{{$video_archive1->title}}</h5>
                                            <!--</div>-->
                                            <div class="thumbnail">
                                                <a href="{!!'/mypost?video='. $video_archive1->id.'&id='.$ipaddress!!}" target="_blank">
                                                    <img id="image{{$video_archive1->id}}" src="{{asset("$video_archive1->imageurl")}}"  title="Click to Play" style="width:100%;" onmouseover="showVideo('{{$video_archive1->id}}')">
<!--                                                    <iframe width="100%" height="345px" src="{{$video_archive1->videoUrl}}?html5=1" allowfullscreen=""
                                                            frameborder="0" style="display: none" id="video{{$video_archive1->id}}">
                                                    </iframe>-->
                                                    <!--<div class="caption">-->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a href="{!!'/mypost?video='. $video_archive1->id.'&id='.$ipaddress !!}" target="_blank">
                                                                    <button type="button" class="btn btn-success btn-sm" style="width: 100%"><span class="fa fa-play-circle"> Click to play now</span></button>
                                                                </a>
                                                            </div>
                                                        </div> 
                                                    <!--</div>-->
                                                </a>
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
            <div>

                <div class="tittle-head">
                    <h3 class="tittle" style="text-align: center; margin-left: 35%;">Our Map Location</h3>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <div style="position: relative;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1677.0819840144175!2d36.801393712555836!3d-1.297289714971404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f109521a475dd%3A0xb5070814ceb91e88!2sDaystar+University%2C+Nairobi+Campus!5e0!3m2!1sen!2ske!4v1485554800953"
                            width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
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
