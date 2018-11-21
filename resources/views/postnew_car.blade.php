<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
    <head>
        <title>RentMyCar.co.ke | New Post</title>
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
    <body class="sticky-header left-side-collapsed" onload="initMap()">
        <section>
            <!-- left side start-->
            @include('sidebar')

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

                <div id="page-wrapper" style="padding-top: 2%">
                    <!--body wrapper start-->
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/postvideo') }}" files ="true"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="cartitle" class="col-md-4 control-label">Car Title</label>
                            <div class="col-md-6">
                                <input id="cartitle" type="text" class="form-control" name="cartitle" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Transmission" class="col-md-4 control-label">Transmission</label>
                            <div class="col-md-6">
                                <select id="Transmission" type="text" class="form-control" name="Transmission" required autofocus>
                                    <option value="Automatic">Automatic</option>
                                    <option value="Manual">Manual</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Transmission" class="col-md-4 control-label">Car CC</label>
                            <div class="col-md-6">
                                <select  id="car_cc" class="form-control" name="car_cc" required autofocus>
                                    @foreach($car_cc as $cc)
                                        <option value="{{$cc->name}}">{{$cc->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="col-md-4 control-label">Car Category</label>
                            <div class="col-md-6">
                                <select  id="category" class="form-control" name="category" required autofocus>
                                    @foreach($car_categories as $car_category)
                                        <option value="{{$car_category->name}}">{{$car_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="PricePerDay" class="col-md-4 control-label">Price Per Day (KES)</label>
                            <div class="col-md-6">
                                <input id="PricePerDay" type="number" class="form-control" name="PricePerDay" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vimage" class="col-md-4 control-label">Attach Front Image</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control" name="vimage" id="vimage" required accept="image/png,image/gif,image/jpeg,image/jpg">
                                <span style="font-size: 11px; color:lightblue;"> (image size for proper display use 257 by 257 pixel)</span><br/>
                                <span style="font-size: 12px; color:red;"> (Please use image with extension .jpg, .jpeg, .png and .gif to avoid errors)</span>
                            </div>
                        </div>
                        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>


                        <div class="form-group">
                            <label for="car_content" class="col-md-4 control-label">Car Description </label>
                            <div class="col-md-6">
                                <textarea id="car_content" class="form-control" name="car_content"  autofocus rows="8"></textarea>
                            </div>
                        </div>
                        <script>
        CKEDITOR.env.isCompatible = true;
        CKEDITOR.replace('car_content');
//                                config.removeDialogTabs = 'flash:advanced;image:Link';
                        </script>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="clearfix"></div>
                <!--body wrapper end-->
                <!-- /w3l-agile -->
            </div>
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
