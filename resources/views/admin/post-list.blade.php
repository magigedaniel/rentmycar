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
    $('#posts_table').DataTable({
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
                        {{$title}} <br/>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="/admin"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li><a href="/admin/post/view/list">Post</a></li>
                        <li class="active">Post List</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Your Page Content Here -->
                    <table id="posts_table" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th class="w3-center">Acton</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->email}}</td>
                                <td>{{$post->created_at}}</td>
                                <td class="w3-center">
                                    <a href="/admin/post/view/{{$post->id}}"> <button class="btn btn-success btn-sm"><span class="fa fa-eye"> View</span></button></a>
                                    <a href="/admin/post/edit/{{$post->id}}"> <button class="btn btn-primary btn-sm"><span class="fa fa-edit"> Update</span></button></a>
                                    <a href="/admin/post/delete/{{$post->id}}"onclick="return validateDelete()"> <button class="btn btn-danger btn-sm"  style="margin-left: 2px"><span class="fa fa-trash"> Delete</span></button></a>
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
             function validateDelete() {
                 if (confirm("Do wish to delete this post?") === true) {
                     return true;
                 } else {
                     return false;
                 }
             }
        </script>
    </body>
</html>
