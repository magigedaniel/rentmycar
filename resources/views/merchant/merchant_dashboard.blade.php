<!DOCTYPE HTML>
<html>
<head>
    <title>RentMyCar.co.ke | My Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="RentMyCar.co.ke"/>
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
                        <div class="navbar-header">
                            <button type="button" class="btn btn-primary">Waiting Action</button>
                            <button type="button" class="btn btn-primary">Pending Payment</button>
                            <button type="button" class="btn btn-primary">My Car Rented</button>
                            <button type="button" class="btn btn-primary">All</button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                    </div><!-- /.container-fluid -->
                </nav>
                <div class="inner-content">
                    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
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
                            <th>No of Days</th>
                            <th>Deposit Amount</th>
                            <th>Total Amt</th>
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
                                <td>{!! $order_details->deposit_amount!!}</td>
                                <td>{!! $order_details->total_amount!!}</td>
                                <td>{!! $order_details->merchant_approval_status!!}</td>
                                <td>Pay deposit</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
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

<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.js"></script>

</body>
</html>