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
                    <h1 class="w3-center">
                        Users Dashboard
                        {{--<small>Optional description</small>--}}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li><a href="/admin/users/all">User List</a></li>
                        <li class="active">User Edit</li>
                        </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <form class="form-horizontal" action="/admin/users/profile/edit" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$profile_user->id}}" name="user_id"/>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Name"  value="{{$profile_user->fname}}" name="fname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" placeholder="Name"  value="{{$profile_user->lname}}" name="lname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" placeholder="Email"  value="{{$profile_user->email}}" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user-type" class="col-sm-2 control-label">User Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="user-type" name="user_type">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="super-user">Super User</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="phone" value="{{$profile_user->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="idno" class="col-sm-2 control-label">National Id</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="idno" placeholder="National ID/Passport" name="idno" value="{{$profile_user->idno}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="university" class="col-sm-2 control-label">University</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="university" placeholder="University" name="university" value="{{$profile_user->university}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="col-sm-2 control-label">Country</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="country" placeholder="Country" name="country" value="{{$profile_user->country}}">
                            </div>
                        </div>         
                        <div class="form-group">
                            <label for="company" class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="company" placeholder="Company" name="company" value="{{$profile_user->company}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="language" class="col-sm-2 control-label">Language</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="language" placeholder="Language" name="language" value="{{$profile_user->language}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Submit Update!</button>
                            </div>
                        </div>
                    </form>
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
