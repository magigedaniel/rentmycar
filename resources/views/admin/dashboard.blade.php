<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Rentmycar.co.ke |  ADMIN</title>
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
        <style>
            .mySlides {display:none}
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
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

            <!-- Content Wrapper. Contains headpage content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Admin Dashboard
                    {{--<small>Optional description</small>--}}
                    </h1>
                    <ol class="breadcrumb">
                    <li><a href="/admin"><i class="fa fa-dashboard"></i> Admin</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>{{$user_total}}</h3>

                                    <p>Registered Users</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="/admin/users/all" class="small-box-footer">View list <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow-active">
                                <div class="inner">
                                    <h3> {{$video_total}}</h3>

                                    <p>Total Posted Car</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-video-camera"></i>
                                </div>
                                <a href="/admin/video/posted" class="small-box-footer">View list <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-lime-active">
                                <div class="inner">
                                    <h3>{{$video_total_voted}}</h3>

                                    <p>Total Voted Car</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-play-circle"></i>
                                </div>
                                <a href="/admin/video/voted" class="small-box-footer">View list <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-teal-active">
                                <div class="inner">
                                    <h3>{{$post_total}}</h3>

                                    <p>Total Blog Posts</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-bookmark-o"></i>
                                </div>
                                <a href="/admin/post/view/list" class="small-box-footer">View list <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="padding-top: 50px"> 
                            <div class="box box-danger bg bg-purple-gradient">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Voted v Unvoted Car {{$current_year}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <canvas id="votedVideoPieChart"></canvas>
                                </div>
                                <div class="box box-footer  bg bg-purple-gradient">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <svg width="25%" height="20">
                                            <rect width="15" height="15" 
                                                  style="fill:teal;stroke-width:0;stroke:teal" /> 
                                            </svg>Voted
                                        </div><div class="col-md-6">
                                            <svg width="25%" height="20">
                                            <rect width="15" height="15" 
                                                  style="fill:green;stroke-width:0;stroke:green" /> 
                                            </svg>Un-Voted
                                        </div>
                                    </div>
                                    <a href="/admin/video/voted/chart/data" class="w3-text-black">
                                        <button type="button" class="btn btn-success btn-sm" style="margin-top: 10px"><span class="fa fa-plus-circle"> Click to View more</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-4" style="padding-top: 50px">
                            <div class="box box-danger bg bg-purple-gradient">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Viewed vs Unviewed Car {{$current_year}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <canvas id="viewedVideoPieChart"></canvas>
                                </div>
                                <div class="box box-footer  bg bg-purple-gradient">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <svg width="25%" height="20">
                                            <rect width="15" height="15" 
                                                  style="fill:#104006;stroke-width:0;stroke:#104006" /> 
                                            </svg>Viewed
                                        </div><div class="col-md-6">
                                            <svg width="25%" height="20">
                                            <rect width="15" height="15" 
                                                  style="fill:#800000;stroke-width:0;stroke:#800000" /> 
                                            </svg>Un-Viewed
                                        </div>
                                    </div>
                                    <a href="/admin/video/viewed/chart/data" class="w3-text-black">
                                        <button type="button" class="btn btn-success btn-sm" style="margin-top: 10px"><span class="fa fa-plus-circle"> Click to View more</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>   
                        <div class="col-md-4">                            
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Car's statistics {{$current_year}}</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="glyphicon glyphicon-facetime-video"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Car Posts</span>
                                            <span class="info-box-number">{{count($all_current_videos)}}</span>
                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{$video_posts_stats}}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="glyphicon glyphicon-eye-open"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Car Views</span>
                                            <span class="info-box-number">{{$current_video_total_views}}</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{$video_views_stats}}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <div class="info-box bg-red" >
                                        <span class="info-box-icon"><i class="glyphicon glyphicon-check"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Car Votes</span>
                                            <span class="info-box-number">{{$current_video_total_votes}}</span>

                                            <div class="progress">
                                                <div class="progress-bar" style="width: 50%"></div>
                                            </div>
                                            <span class="progress-description">
                                                {{$video_votes_stats}}
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary bg bg-teal-active">
                                <div class="box-header with-border">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">{{$current_year}} Car Category Top Votes</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="winners" style="height: 300px;"></div>
                                </div>
                                <div class="box box-footer bg bg-teal-active">
                                    <a href="/admin/video/posted/results/bycategory" class="w3-text-black">
                                        <button type="button" class="btn btn-success btn-sm" style="margin-top: 10px"><span class="fa fa-plus-circle"> Click to View more</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary bg bg-aqua-gradient">
                                <div class="box-header with-border">
                                    <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title">{{$current_year}} General Car Votes</h3>
                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div id="votes" style="height: 300px;"></div>
                                </div>
                                <div class="box box-footer  bg bg-aqua-gradient">
                                    <a href="/admin/video/posted/chart/years" class="w3-text-black">
                                        <button type="button" class="btn btn-success btn-sm" style="margin-top: 10px"><span class="fa fa-plus-circle"> Click to View more</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset ("/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js")}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset ("/bower_components/AdminLTE/dist/js/app.min.js")}}"></script>

        <!-- Optionally, you can add Slimscroll and FastClick plugins.
             Both of these plugins are recommended to enhance the
             user experience. Slimscroll is required when using the
             fixed layout. -->
        <!-- ChartJS -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/chartjs/Chart.js")}}"></script>
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/flot/jquery.flot.js")}}"></script>
        <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/flot/jquery.flot.resize.js")}}"></script>
        <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/flot/jquery.flot.pie.js")}}"></script>
        <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
        <script src="{{ asset ("/bower_components/AdminLTE/plugins/flot/jquery.flot.categories.js")}}"></script>


        <script>
createVotedVideoPieChart();
function createVotedVideoPieChart() {
var pieChartCanvas = $('#votedVideoPieChart').get(0).getContext('2d');
var pieChart = new Chart(pieChartCanvas);
var PieData = [
{
value:  {{$current_video_total_voted}},
        color: 'teal',
        highlight: '#3c8dbc',
        label: 'Voted Car'
},
{
value:  {{count($all_current_videos) - $current_video_total_voted}},
        color: 'green',
        highlight: '#d2d6de',
        label: 'Unvoted Cars'
}

];
var pieOptions = {
//Boolean - Whether we should show a stroke on each segment
segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
};
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Pie(PieData, pieOptions);
}

createViewedVideoPieChart();
function createViewedVideoPieChart() {
var pieChartCanvas = $('#viewedVideoPieChart').get(0).getContext('2d');
var pieChart = new Chart(pieChartCanvas);
var PieData = [
{
value:  {{$current_video_total_viewed}},
        color: '#104006',
        highlight: '#3c8dbc',
        label: 'Viewed Car'
},
{
value:  {{count($all_current_videos) - $current_video_total_viewed}},
        color: '#800000',
        highlight: '#00c0ef',
        label: 'Un-Viewed Car'
}

];
var pieOptions = {
//Boolean - Whether we should show a stroke on each segment
segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
};
//Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Pie(PieData, pieOptions);
}
@if ($user -> usertype == "super-user")
        createWinnersBarChart();
createVotesBarChart();
@endif
        function createVotesBarChart() {
        var locations = [
                @foreach($all_current_videos as $video)
        [ "{{$video->title}}", {{$video -> votes}} ],
                @endforeach
        ];
        var bar_data = {
        data: locations, color: 'teal'
        }
        $.plot('#votes', [bar_data], {
        grid: {
        borderWidth: 1,
                borderColor: '#f3f3f3',
                tickColor: '#f3f3f3'
        },
                series: {
                bars: {
                show: true,
                        barWidth: 0.5,
                        align: 'center'
                }
                },
                xaxis: {
                mode: 'categories',
                        tickLength: 0
                }
        });
        }

function createWinnersBarChart() {
var locations = [
        @foreach($video_categories_array as $car_category)
[ "{{$car_category}}", {{$winners_array[$car_category]}} ],
        @endforeach
];
var bar_data = {
data: locations, color: 'teal'
        }
$.plot('#winners', [bar_data], {
grid: {
borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor: '#f3f3f3'
        },
        series: {
        bars: {
        show: true,
                barWidth: 0.5,
                align: 'center'
        }
        },
        xaxis: {
        mode: 'categories',
                tickLength: 0
        }
});
}
        </script>

    </body>
</html>
