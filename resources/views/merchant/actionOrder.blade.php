<!DOCTYPE HTML>
<html>
<head>
    <title>Rentmycar.co.ke | Order Action</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Rentmycar.co.ke"/>
    <meta name="_token" content="{{csrf_token()}}"/>
    <!-- Bootstrap Core CSS -->
    <link href="../../../css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- Custom CSS -->
    <link href="../../../css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Graph CSS -->
    <link href="../../../css/font-awesome.css" rel="stylesheet">

    <!-- jQuery -->
    <!-- lined-icons -->
    <link rel="stylesheet" href="../../../css/icon-font.css" type='text/css'/>
    <!-- //lined-icons -->
    <!-- Meters graphs -->
    <script src="../../../js/jquery-2.1.4.js"></script>


</head>
<body class="sticky-header left-side-collapsed">

<section>
    <div class="container" style="">
        <div style="" class="border-all">
            <!-- header-starts -->
        @include('header')
        <!--notification menu end -->
            <!-- //header-ends -->
            <!-- /w3l-agileits -->
            <!-- //header-ends -->
            <div id="page-wrapper" style="padding-top: 0">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                    @include('merchant.merchant_dashboard_header')

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    </div><!-- /.container-fluid -->
                </nav>
                <div class="inner-content">
                    <form id="myForm">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="Amount">Customer Name</label>
                                <input type="email" class="form-control" id="Amount" readonly
                                       value="{{$customer->fname.' '.$customer->lname}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="MpesaPhone">Mobile No</label>
                                <input type="text" class="form-control" id="MpesaPhone" name="MpesaPhone" required
                                       readonly value="{{$user_all_order->phone_used}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="Amount">Total Amount (KES)</label>
                                <input type="email" class="form-control" id="Amount" readonly
                                       value="{{$user_all_order->total_amount}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Amount">Date from :</label>
                                <input type="email" class="form-control" id="Amount" readonly
                                       value="{{$user_all_order->booking_date_from}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="MpesaPhone">Date To:</label>
                                <input type="text" class="form-control" id="MpesaPhone" name="MpesaPhone" required
                                       readonly value="{{$user_all_order->booking_date_to}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="MpesaPhone">Number Of Days</label>
                                <input type="text" class="form-control" id="MpesaPhone" name="MpesaPhone" readonly
                                       required
                                       value="{{$user_all_order->number_of_days_ordered}}">
                            </div>
                            <input type="text" hidden value="{{$user_all_order->id}}" id="id" name="id">
                        </div>

                        <div id="loading" style="display: none;"><img src="/images/loading.gif" alt=""/>Wait...</div>
                        <div class="alert alert-success" style="display:none"></div>
                        <div class="alert alert-danger" style="display:none"></div>
                        @if($user_all_order->merchant_approval_status=='Pending')

                            <button class="btn btn-success" id="ajaxAccept">Accept Offer</button>
                            <button class="btn btn-danger" id="ajaxReject" style="float:right;">Reject Offer
                            </button>

                        @endif
                    </form>


                    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                            crossorigin="anonymous">
                    </script>
                    <script>
                        jQuery(document).ready(function () {
                            //Accept merchant
                            jQuery('#ajaxAccept').click(function (e) {
                                e.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                jQuery('.alert-danger').hide();
                                jQuery('#ajaxAccept').hide();
                                jQuery('#ajaxReject').hide();
                                jQuery('#loading').show();
                                jQuery.ajax({
                                    url: "{{ url('/merchantDashboard/action/{id}') }}",
                                    method: 'post',
                                    data: {
                                        status: 'accept',
                                        id: jQuery('#id').val()
                                    },
                                    success: function (result) {
                                        if (result.success) {
                                            jQuery('.alert-success').show();
                                            jQuery('.alert-success').html(result.success);
                                            jQuery('#loading').hide();
                                        }
                                        else {
                                            jQuery('.alert-danger').show();
                                            jQuery('.alert-danger').html(result.error);
                                            jQuery('#ajaxAccept').show();
                                            jQuery('#ajaxReject').show();
                                            jQuery('#loading').hide();
                                        }
                                    }
                                });
                            });

                            //Reject data
                            jQuery('#ajaxReject').click(function (e) {
                                e.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                jQuery('.alert-danger').hide();
                                jQuery('#ajaxAccept').hide();
                                jQuery('#ajaxReject').hide();
                                jQuery('#loading').show();
                                jQuery.ajax({
                                    url: "{{ url('/merchantDashboard/action/{id}') }}",
                                    method: 'post',
                                    data: {
                                        status: 'reject',
                                        id: jQuery('#id').val()
                                    },
                                    success: function (result) {
                                        if (result.success) {
                                            jQuery('.alert-success').show();
                                            jQuery('.alert-success').html(result.success);
                                            jQuery('#loading').hide();
                                        }
                                        else {
                                            jQuery('.alert-danger').show();
                                            jQuery('.alert-danger').html(result.error);
                                            jQuery('#ajaxAccept').hide();
                                            jQuery('#ajaxReject').hide();
                                            jQuery('#loading').hide();
                                        }
                                    }
                                });
                            });
                        });
                    </script>
                    <br/>
                </div>
            </div>
            <!--body wrapper start-->

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
<!-- Bootstrap Core JavaScript -->
<script src="../../../js/bootstrap.js"></script>

</body>
</html>
