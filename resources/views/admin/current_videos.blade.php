<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RentMyCar.co.ke |  ADMIN</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css")}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/dist/css/AdminLTE.min.css")}}">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="{{ asset ("/bower_components/AdminLTE/dist/css/skins/skin-blue.min.css")}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">


        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    </head>
    <!--
    BODY TAG OPTIONS:
    =================
    Apply one or more of the following classes to get the
    desired effect
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
    -->
    <body class="hold-transition skin-blue sidebar-mini fixed">
        <div class="wrapper">

            <!-- Main Header -->
            @include('admin.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('admin.sidebar')
            <script type="text/javascript">
$(document).ready(function () {
$('#posted_videos_table').DataTable({
"paging": true,
        "ordering": true,
        "info": false
        });
});
            </script>
            <!-- Content Wrapper. Contains headpage content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1 class="w3-center">
                        {{$title}}<br/>
                        <small>Manage current videos</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li><a href="/admin/video/posted/current">Videos</a></li>
                        <li class="active">Posted Videos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Points award form</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form-inline" onsubmit="return validateForm()" action="/admin/video/posted/current/award_points" method="POST" name="myform">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="video_id" id="video_id">
                                        <div class="form-group">
                                            <label for="points">Enter points</label>
                                            <input type="text" class="form-control" id="points" name="points">
                                        </div>
                                        <p id="error_message" class="w3-text-red"></p>
                                        <br/>
                                        <br/>
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="posted_videos_table" class="display small" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Uploaded By</th>
                                <th>User Award</th>
                                @if($user->usertype == "super-user")   
                                <th>Total Points</th>
                                @endif
                                <th class="w3-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($videos as $video)
                            <tr>
                                <td>{{$video->title}}</td>
                                <td>{{$video->category}}</td>
                                <td>{{$video->fname}}</td>
                                <td>{{$user_points_award[$video->id . '']}}</td>
                                @if($user->usertype == "super-user")   
                                <td>{{$video->points}}</td>
                                @endif
                                <td class="w3-center">
                                    <a href="/mypost?video={{$video->id}}" target="_blank"> <button class="btn btn-success btn-sm"><span class="fa fa-youtube-play"> Play</span></button></a>
                                    <button type="button" style="margin-left: 2px" class="btn btn-facebook btn-sm" data-toggle="modal" data-target="#myModal" onclick="initializeVideoId({{$video->id}})"><span class="fa fa-check-square-o"> Award</span></button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            @include('admin.footer')

            <!-- Add the sidebar's background. This div must be placed
                     immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED JS SCRIPTS -->

        <!-- jQuery 2.2.3 -->
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
        <script>
            function initializeVideoId(video_id) {
                $('#video_id').val(video_id);
            }
            function validateForm() {
                var x = document.forms["myform"]["points"].value;
                if (x == "") {
                    text = "Value must be filled out";
                    document.getElementById("error_message").innerHTML = text;
                    return false;
                }
                if (isNaN(x) || x < 1 || x > 10) {
                    text = "Value must range between 1 and 10";
                    document.getElementById("error_message").innerHTML = text;
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
