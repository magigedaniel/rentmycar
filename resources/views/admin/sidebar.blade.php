<?php
/**
 * Created by PhpStorm.
 * User: DMagige
 * Date: 10/27/2016
 * Time: 10:52 AM
 */
?>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 90px;
        height: 34px;
    }

    .switch input {display:none;}

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ca2222;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2ab934;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(55px);
        -ms-transform: translateX(55px);
        transform: translateX(55px);
    }

    /*------ ADDED CSS ---------*/
    .on
    {
        display: none;
    }

    .on, .off    {
        color: white;
        position: absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 50%;
        font-size: 10px;
        font-family: Verdana, sans-serif;
    }

    input:checked+ .slider .on
    {display: block;}

    input:checked + .slider .off
    {display: none;}

    /*--------- END --------*/

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset ("/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->fname}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="/admin"><i class="fa fa-home"></i> <span>Home</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-car"></i> <span>Car</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="/admin/video/category"><i class="fa fa-list-alt"></i> <span>Car Categories</span></a></li>
                    <li class=""><a href="/admin/video/posted"><i class="fa fa-play-circle"></i> <span>Posted Car</span></a></li>
                    <li class=""><a href="/admin/video/voted"><i class="fa fa-check-square"></i> <span>Voted Car</span></a></li>
                    <li class=""><a href="/admin/video/posted/current"><i class="fa fa-check-square-o"></i> <span>Award Current Car</span></a></li>
                    <li class=""><a href="/admin/video/posted/results/bycategory"><i class="fa fa-won"></i> <span>Votes & Points Results</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Blog</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/new-post"><span class="fa fa-bookmark-o"></span> New Post</a></li>
                    <li><a href="/admin/post/view/list"><span class="fa fa-list-alt"></span> View Posts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-users"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="/admin/users/admin"><i class="fa fa-user-secret"></i> <span>Admin Users</span></a></li>
                    <li class=""><a href="/admin/users/non-admin"><i class="fa fa-user-times"></i> <span>Non-Admin Users</span></a></li>
                    <li class=""><a href="/admin/users/all"><i class="fa fa-users"></i> <span>All Users</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-bank"></i> <span>Partner Videos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="/admin/video/partner/new"><i class="fa fa-inbox"></i> <span>New Partner video</span></a></li>
                    <li class=""><a href="/admin/video/partner/posted"><i class="fa fa-inbox"></i> <span>Partners Video list</span></a></li>
                </ul>
            </li>




            <li class="treeview">
                <a href="#"><i class="fa fa-home"></i> <span>Home Images</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="/admin/homepage_picture/new"><i class="fa fa-check-square"></i> <span>New Image</span></a></li>
                    <li class=""><a href="/admin/homepage_picture/list"><i class="fa fa-check-square-o"></i> <span>Image List</span></a></li>
                </ul>
            </li>
            <li class=""><a href="/"><i class="fa fa-reply"></i> <span>Back to website</span></a></li>

        </ul>
        <br/>
        <br/>
        <br/>
        <!-- /.sidebar-menu -->
        <div class="row">
            <div class="col-xs-6 col-xs-offset-2">
                <span style="color: white">Vote setting</span>
                <label class="switch">
                    <input type="checkbox" <?php if(\App\Http\Controllers\PostDataController::getVoteStatus() == 1){ ?> checked <?php }?> id="togBtn" onchange="sendSetting()">
                    <div class="slider round">
                        <span class="on">ON</span><span class="off">OFF</span>
                    </div>
                </label>
            </div>
        </div>
    </section>
    <!-- /.sidebar -->
</aside>
<script>
    function sendSetting() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText + '' == '1') {
                    document.getElementById("togBtn").checked = true;
                } else {
                    document.getElementById("togBtn").checked = false;
                }
            }
        };
        xhttp.open("GET", "/admin/vote_setting", true);
        xhttp.send();
    }
</script>
