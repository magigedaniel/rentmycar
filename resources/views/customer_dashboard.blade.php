<!DOCTYPE HTML>
<html>
<head>
    <title>Rentmycar.co.ke | My Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Rentmycar.co.ke"/>
    <meta name="_token" content="{{csrf_token()}}"/>
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
                    @include('customer_dashboard_header')

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    </div><!-- /.container-fluid -->
                </nav>
                <div class="inner-content">
                    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                            crossorigin="anonymous">
                    </script>
                    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                    </script>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>Car Reg No</th>
                            <th>Date From</th>
                            <th>Date To</th>
                            <th>Merchant Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user_all_order as $order_details)
                            <tr>
                                <td>{!! $order_details->car_ordered_reg!!}</td>
                                <td>{!! $order_details->booking_date_from!!}</td>
                                <td>{!! $order_details->booking_date_to!!}</td>
                                <td>{!! $order_details->number_of_days_ordered!!}</td>
                                <td>{!! $order_details->merchant_approval_status!!}</td>
                                <td>
                                    @if($order_details->merchant_approval_status=='Approved')
                                        <a href="/memberDashboard/deposit/pay/{{$order_details->id}}">
                                            <button class="btn btn-info btn-sm" style="margin-left: 2px"><span
                                                        class="fa fa-trash">
                                                    @if($order_details->deposit_payment_status=='Paid')
                                                        Pay Balance
                                                        @else
                                                        Pay Deposit
                                                    @endif

                                                </span></button>
                                        </a>
                                    @else
                                        <a href="/memberDashboard/deposit/pay/{{$order_details->id}}">
                                            <button class="btn btn-info btn-sm" style="margin-left: 2px"><span
                                                        class="fa fa-trash">Details</span></button>
                                        </a>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
            </div>


            <script>
                jQuery(document).ready(function () {

                    jQuery('#buttonPayDeposit').click(function (e) {
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
                                car_reg: jQuery('#car_reg').val()
                            },
                            success: function (result) {
                                if (result.success) {
                                    jQuery('.alert').show();
                                    jQuery('.alert').html(result.success);
                                    jQuery('#loading').hide();
                                }
                                else {
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').html(result.error);
                                    jQuery('#loading').hide();
                                }
                            }
                        });
                    });
                });
            </script>

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

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

</body>
</html>
