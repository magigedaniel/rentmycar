<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
    <head>
        <title>RentMyCar.co.ke | Archives</title>
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
                    <div id="page-wrapper" style="padding: 2%;">
                        <div class="inner-content single">
                            <h2 style="text-align: center; font-weight: 900;">Previous Video Posts</h2>
                            <hr style="color: black; height: 2px">
                            <div class="post">
                                <!-- /.user-block -->
                                @php
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

                                @endphp
                                <div class="row "> 
                                @foreach($archive_videos as $archive_video)
                                        <div class="col-md-4">
                                            <!--<div class="caption">-->
                                                <h5 class="text-black text-sm" style="font-weight: 800; text-align: center">{{$archive_video->title}}</h5>
                                            <!--</div>-->
                                            <div class="thumbnail">
                                                <a href="{!!'/mypost?video='. $archive_video->id.'&id='.$ipaddress!!}" target="_blank">
                                                    <img id="image{{$archive_video->id}}" src="{!! $archive_video->imageurl!!}"  title="Click to Play" style="width:100%;" onmouseover="showVideo('{{$archive_video->id}}')">
<!--                                                    <iframe width="100%" height="345px" src="{{$archive_video->videoUrl}}?html5=1" allowfullscreen=""
                                                            frameborder="0" style="display: none" id="video{{$archive_video->id}}">
                                                    </iframe>-->
                                                    <!--<div class="caption">-->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <a href="{!!'/mypost?video='. $archive_video->id.'&id='.$ipaddress !!}" target="_blank">
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
                                {{$archive_videos->links()}}
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

        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"></script>
    </body>
<script>
function showVideo(video_id) {
    var video = document.getElementById(video_id);
    var image = document.getElementById(video_id);
    video.style.display = 'block';
    image.style.display = 'none';
}

function onYouTubePlayerAPIReady() {

}
    </script>
</html>



