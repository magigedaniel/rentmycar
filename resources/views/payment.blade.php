<!DOCTYPE HTML>
<html>
<head>
    <title>RentMyCar.co.ke | My Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="RentMyCar.co.ke"/>
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
                        <div class="navbar-header">
                            <button type="button" class="btn btn-primary">All Rents</button>
                            <button type="button" class="btn btn-primary">Pending Car</button>
                            <button type="button" class="btn btn-primary">Approved Car</button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                    </div><!-- /.container-fluid -->
                </nav>
                <div class="inner-content">

                    <div class="alert alert-success" style="display:none"></div>
                    <form id="myForm">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type">
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price">
                        </div>
                        <button class="btn btn-primary" id="ajaxSubmit">Submit</button>
                    </form>


                    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
                            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                            crossorigin="anonymous">
                    </script>
                    <script>
                        jQuery(document).ready(function () {
                            jQuery('#ajaxSubmit').click(function (e) {
                                e.preventDefault();
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                    }
                                });
                                jQuery.ajax({
                                    url: "{{ url('/car/order') }}",
                                    method: 'post',
                                    data: {
                                        name: jQuery('#name').val(),
                                        type: jQuery('#type').val(),
                                        price: jQuery('#price').val()
                                    },
                                    success: function (result) {
                                        jQuery('.alert').show();
                                        jQuery('.alert').html(result.success);
                                    }
                                });
                            });
                        });
                    </script>
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
