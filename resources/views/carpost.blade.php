<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>RentMyCar.co.ke | {!! $car->title!!}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="RentMyCar.co.ke"/>
    <meta name="_token" content="{{csrf_token()}}"/>

    <meta property="og:url" content="https://rentmycar.co.ke/mypost?video={{$car->id}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Rent My car"/>
    <meta property="og:description" content="Rent my car"/>
    <meta property="og:image" content="https://Rentmycar.co.ke/{!! $car->imageurl!!}"/>

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
                    <iframe width="100%" height="150px" frameborder="0" allowfullscreen
                            src="{{$car->imageurl}}">
                    </iframe>
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
                                       href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Frentmycar.co.ke%2Fmypost%3Fvideo%3D{{$car->id}}&amp;src=sdkpreparse">
                                        <button type="button" class="btn btn-primary btn-sm"><span class="fa fa-share"> Share this car</span>
                                        </button>
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="response">
                    <h4> {!! $car->title!!} : <span>{!! $car->car_reg !!}</span></h4>
                    <input type="text" hidden value="{!! $car->car_reg !!}" id="car_reg" name="car_reg"/>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="media response-info">
                                <span class="carDescription">Transmission </span>
                                <div class="media-body response-text-right">
                                    {!! $car->Transmission !!}

                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="media response-info">
                                <span class="carDescription">Engine Capacity </span>
                                <div class="media-body response-text-right">
                                    {!! $car->car_cc !!} cc
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="media response-info">
                                <span class="carDescription">Price Per Day  </span>
                                <div class="media-body response-text-right">
                                    <input type="text" hidden id="price_per_day" value="{!! $car->price_per_day !!}">
                                    Ksh. {!! $car->price_per_day !!}

                                </div>

                            </div>
                        </div>

                    </div>


                    <div class="media response-info">
                        <span class="carDescription">Description :</span>
                        <div class="media-body response-text-right">
                            {!! $car->content!!}

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
        <div class="customer-details">
            <form id="form" name="form">

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="location">Enter Pick Up Location <span class="required">*</span></label>
                        <input type="text" class="form-control" id="location" name="location"
                               placeholder="i.e Nairobi,Junction Mall ngong road">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mpesaMobilePhone">M-pesa Mobile No  <span class="required">*</span></label>
                        <input type="text" class="form-control" id="mpesaMobilePhone" name="mpesaMobilePhone" required>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="startDate">Start Date <span class="required">*</span></label>
                        <input type="date" id="startDate" name="startDate"
                               value="{{date("Y-m-j")}}"
                               min="2018-11-31" max="2019-12-31">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="endDate">End Date <span class="required">*</span></label>
                        <input type="date" id="endDate" name="endDate"
                               value=""
                               min="2018-11-31" max="2019-12-31">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="NumberOfDay">Number of days :</label>
                        <input type="text" id="NumberOfDay" name="NumberOfDay"
                               value="" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="TotalAmount">Total Amount</label>
                        <input type="text" class="form-control" id="TotalAmount" name="TotalAmount" value=""
                               readonly>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="DepositAmount">Deposit Expected</label>
                        <input type="text" class="form-control" id="DepositAmount" name="DepositAmount" value="500"
                               readonly>
                    </div>
                </div>
                <div class="alert alert-success" style="display:none"></div><br/>
                <div class="alert-danger" style="display:none"></div><br/>
                <div class="row">
                    <div id="loading" style="display: none;"><img src="/images/loading.gif" alt="" />Wait...</div>
                    <button type="submit" class="btn btn-primary md-4" id="ajaxSubmit">Request Now</button>
                </div>
            </form>

        </div>
        <!--
        Script
        -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                crossorigin="anonymous">
        </script>
        <script >
            jQuery(document).ready(function () {

                //Change function of enddate
                jQuery("#endDate").change(function () {

                    var startDate = jQuery('#startDate').val();
                    var endDate = jQuery('#endDate').val();
                    var price_per_day=jQuery('#price_per_day').val();
                    var today = new Date();
                    y = today.getFullYear();
                    m = today.getMonth() + 1;
                    d = today.getDate();
                    var today_date=y + "-" + m + "-" + d;
//alert(price_per_day);
                    if(startDate<today_date){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').html('Start date cannot be less than today date');
                        return
                    }

                    if(startDate>endDate){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').html('Start date cannot be more than End date');
                        return;
                    }

                    var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
                    var firstDate = new Date(startDate);
                    var secondDate = new Date(endDate);

                    var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
                    //var num_of_day=endDate-startDate;
                    jQuery('#NumberOfDay').val(diffDays);
                    var total_cost=price_per_day *diffDays;
                    jQuery('#TotalAmount').val(total_cost);
                    // alert(total_cost);

                });

                jQuery('#ajaxSubmit').click(function (e) {
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    //re-HIDE field
                    jQuery('.alert-danger').hide();
                    jQuery('.alert').hide();
                    jQuery('#ajaxSubmit').hide();
                    jQuery('#loading').show();


                    //Js Field validation
                    var mpesaphone = jQuery('#mpesaMobilePhone').val();
                    var location = jQuery('#location').val();

                    if (mpesaphone == '') {
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').html('Fill all required field *');
                        jQuery('#ajaxSubmit').show();
                        jQuery('#loading').hide();
                        //alert('M-pesa Mobile Phone');
                        return
                    }


                    jQuery.ajax({
                        url: "{{ url('/car/order') }}",
                        method: 'post',
                        data: {
                            startDate: jQuery('#startDate').val(),
                            mpesaMobilePhone: jQuery('#mpesaMobilePhone').val(),
                            endDate: jQuery('#endDate').val(),
                            DepositAmount: jQuery('#DepositAmount').val(),
                            TotalAmount: jQuery('#TotalAmount').val(),
                            NumberOfDay: jQuery('#NumberOfDay').val(),
                            car_reg:jQuery('#car_reg').val()
                        },
                        success: function (result) {
                            if (result.success){
                                jQuery('.alert').show();
                                jQuery('.alert').html(result.success);
                                jQuery('#loading').hide();
                            }
                            else
                            {
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').html(result.error);
                                jQuery('#loading').hide();
                            }
                        }
                    });
                });
            });
        </script>

        <div class="clearfix">
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
