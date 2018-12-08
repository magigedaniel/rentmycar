<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rentmycar.co.ke | ADMIN</title>
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

    <!--Script for ckeditor-->
    <script src="{{ asset ("/vendor/unisharp/laravel-ckeditor/ckeditor.js")}}"></script>


    <![endif]-->
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

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="w3-center">
                Partner/University Video Post <br/><br/>
            </h1>
            <ol class="breadcrumb">
                <li><a href="/admin"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li><a href="/admin/video/partner/new">Partner Video</a></li>
                <li class="active">New Video</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <form class="form-horizontal" role="form" method="POST" action="/admin/video/partner/add" files="true"
                  enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="vurl" class="col-md-4 control-label">Video Url</label>

                    <div class="col-md-6">
                        <input id="vurl" type="text" class="form-control" name="vurl" required autofocus>
                        <span style="font-size: 11px; color:red;"> (Upload video to Youtube and copy paste link here!)</span>

                    </div>
                </div>

                <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
                <div class="form-group">
                    <label for="cartitle" class="col-md-4 control-label">Partner/University Name</label>
                    <div class="col-md-6">
                        <input id="cartitle" type="text" class="form-control" name="cartitle" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="col-md-4 control-label">Video Owner Type</label>
                    <div class="col-md-6">
                        <select id="category" class="form-control" name="category" required autofocus>
                            <option value="Partner">Partner</option>
                            <option value="University">University</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="car_content" class="col-md-4 control-label">Video Description </label>
                    <div class="col-md-6">
                        <textarea id="car_content" class="form-control" name="car_content" autofocus rows="10"></textarea>
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

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
@include('admin.footer')

<!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!--                    jQuery 2.2.3 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script>
    CKEDITOR.replace('messageArea', {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });

    //        CKEDITOR.replace( 'messageArea' );
</script>
</body>
</html>
