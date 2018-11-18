<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
    <head>
        <title>RentMyCar.co.ke  | Contact</title>
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
        <style>
            .red{
                color:red;
            }
            .form-area
            {
                background-color: #FAFAFA;
                padding: 10px 40px 60px;
                margin: 10px 0px 60px;
                border: 1px solid GREY;
            }
        </style>
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
                    <div id="page-wrapper">
                        <div class="inner-content">
                        <p ><h2 style="text-align: center;"><em>We would love to hear from you!</em></h2></p>
                            <div class="container">
                                <div class="col-md-10">
                                    <div class="form-area">  
                                        <form role="form" action="/contact/email" method="post">
                                            <br style="clear:both">
                                            <h2 style="margin-bottom: 30px; text-align: center;">Contact Form</h2>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" type="textarea" id="message" placeholder="Message" maxlength="500" rows="10" name="message"></textarea>
                                                <span class="help-block"><p id="characterLeft" class="help-block ">You have reached the limit</p></span>                    
                                            </div>

                                            <button type="button" id="submit" name="submit" class="btn btn-primary pull-right">Submit Form</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.js"></script>
        <script>
        $(document).ready(function(){ 
    $('#characterLeft').text('500 characters left');
    $('#message').keydown(function () {
        var max = 500;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('You have reached the limit');
            $('#characterLeft').addClass('red');
            $('#btnSubmit').addClass('disabled');            
        } 
        else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
            $('#btnSubmit').removeClass('disabled');
            $('#characterLeft').removeClass('red');            
        }
    });    
});
    </script>
    </body>
</html>
