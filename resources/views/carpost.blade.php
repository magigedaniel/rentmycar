<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>RentMyCar.co.ke | {!! $video->title!!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="RentMyCar.co.ke"/>


    <meta property="og:url" content="https://rentmycar.co.ke/mypost?video={{$video->id}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Rent My car"/>
    <meta property="og:description" content="Rent my car"/>
    <meta property="og:image" content="https://Rentmycar.co.ke/{!! $video->imageurl!!}"/>


    <script type="applicatdion/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
            }, false);
            function hideURLbar() {
            window.scrollTo(0, 1);
            }
    </script>
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

<style>
    div#page-wrapper {
        padding: 0 10% 0 10%;
    }
</style>
<!-- /w3layouts-agile -->
<body class="sticky-header left-side-collapsed">
<section>
    <!-- left side start-->
@include('sidebar')
<!-- /w3layouts-agile -->
    <!-- app-->
    <!-- //app-->
    <!-- /w3l-agile -->
    <!-- signup -->
@include('modals')
<!-- //signup -->
    <!-- /w3l-agile -->
    <!-- left side end-->
    <!-- main content start-->
    <div class="container">
        <!-- header-starts -->
    @include('header')

    <!--notification menu end -->
        <!-- //header-ends -->
        <!-- /w3l-agileits -->
        <!-- //header-ends -->

        <div id="page-wrapper" style="">
            <div class="inner-content single">
                <!--/music-right-->

                <div class="single_left"><!--/video-main-->
                <!--                            <iframe width="100%" height="345px" src="{{$video->videoUrl}}?html5=1" allowfullscreen=""
                                    frameborder="0">
                            </iframe>-->
                    <iframe width="100%" height="150px" frameborder="0" allowfullscreen
                            src="{{$video->videoUrl}}?autoplay=1">
                    </iframe>
                    <div><a href="">Book this Machine</a></div>
                    <div class="alert alert-info fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Car Category: {{$video->category}}
                    </div>
                    <!-- script for play-list -->

                    <!-- //script for play-list -->
                    <!--//video-main-->
                    <!-- /agileinfo -->
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" target="_blank">
                                <!--<button type="button" class="btn btn-primary btn-sm"><span class="fa fa-share"> Share</span></button>-->
                                <div class="fb-share-button"
                                     data-href="https://rentmycar.co.ke/mypost?video={{url()->full()}}"
                                     data-layout="button_count" data-size="small" data-mobile-iframe="true">
                                    <a class="fb-xfbml-parse-ignore" target="_blank"
                                       href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Frentmycar.co.ke%2Fmypost%3Fvideo%3D{{$video->id}}&amp;src=sdkpreparse">
                                        <button type="button" class="btn btn-primary btn-sm"><span class="fa fa-share"> Share</span>
                                        </button>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="response">
                    <h4>{!! $video->title!!}</h4>
                    <div class="media response-info">
                        <div class="media-body response-text-right">
                            {!! $video->content!!}

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>

                <!-- /agileits -->
                <!--//music-right-->
            </div>
            <!--body wrapper start-->


        </div>

        <div class="clearfix">

            <!--body wrapper end-->
            <!-- /w3l-agile -->
        </div>
        <div class="clearfix">
            <div>
                <form>

                    <div class="form-group">
                        <label for="inputAddress">Full Name</label>
                        <input type="text" class="form-control" id="FullName" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="startDate">Start Date</label>
                            <input type="date" id="startDate" name="startDate"
                                   value=""
                                   min="2018-11-31" max="2019-12-31">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endDate">End Date</label>
                            <input type="date" id="endDate" name="endDate"
                                   value="today"
                                   min="2018-11-31" max="2019-12-31">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address 2</label>
                        <input type="text" class="form-control" id="inputAddress2"
                               placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck">
                            <label class="form-check-label" for="gridCheck">
                                Check me out
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Request Now</button>
                </form>
            </div>
        <br/>
                    <!--body wrapper end-->
                @include('footer')
                <!--footer section end-->
                    <!-- /w3l-agile -->
                    <!-- main content end-->
</section>

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>
</body>
</html>
