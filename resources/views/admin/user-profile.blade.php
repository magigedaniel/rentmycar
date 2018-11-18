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
    $('#example').DataTable({
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
                    <h1>
                        User Profile
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li><a href="/admin/users/all">User List</a></li>
                        <li class="active">User Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <img class="profile-user-img img-responsive img-circle" src="{{ asset ("/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}" alt="User profile picture">
                                    <h3 class="profile-username text-center">{{$profile_user->fname.' '.$profile_user->lname}}</h3>
                                    <p class="text-muted text-center">{{$profile_user->university}}</p>
                                    <ul class="list-group list-group-unbordered">
                                        <li class="list-group-item">
                                            <b>User Role</b> <a class="pull-right">{{$profile_user->usertype}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Gender</b> <a class="pull-right">{{$profile_user->gender}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Joined</b> <a class="pull-right">{{date("Y-m-d", strtotime($profile_user->created_at))}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Language</b> <a class="pull-right">{{$profile_user->language}}</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b><a href="/admin/video/posted/{{$profile_user->id}}">Videos Posted</a></b> <a class="pull-right">{{count($videos)}}</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">About</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                                    <p class="text-muted">
                                        P. O Box:  {{$profile_user->code}}-{{$profile_user->box}},<br/>
                                        Phone : {{$profile_user->phone}}<br/>
                                        Country : {{$profile_user->box}}<br/>
                                    </p>
                                    <hr>
                                    <strong><i class="fa fa-bank margin-r-5"></i> Company</strong>
                                    <p class="text-muted"> {{$profile_user->company}}</p>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">                               
                                <div class=row">
                                    <h3 class="w3-center">{{$profile_user->fname.' '.$profile_user->lname}} Video Posts</h3>
                                    <!-- The timeline -->
                                    <ul class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @foreach($videos as $video)
                                        <li class="time-label">
                                            <span class="bg-green-active">
                                                {{$video->dateModified}}
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-camera bg-blue"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-check-square"></i> {{$video->votes}}</span>
                                                <h3 class="timeline-header"><a href="{{$video->videoUrl}}" target="_blank"> {{$video->title}}</a></h3>
                                                <div class="timeline-body">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            {!! $video->content!!}
                                                        </div>
                                                        <div class="col-md-5">
                                                            <iframe width="100%" height="345px" src="{{$video->videoUrl}}?html5=1" allowfullscreen=""  frameborder="0">
                                                            </iframe>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-footer">
                                                        <a href="{{$video->videoUrl}}" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-youtube-play"> Play Video</span></a>
                                                        <a href="/admin/video/delete/{{$video->id}}" class="btn btn-danger btn-xs w3-right"><span class="fa fa-trash" > Delete</span></a>
                                                    </div>
                                                </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- /.nav-tabs-custom -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

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
    </body>
</html>
