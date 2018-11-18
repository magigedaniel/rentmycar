<?php
/**
 * Created by PhpStorm.
 * User: DMagige
 * Date: 10/27/2016
 * Time: 10:52 AM
 */
?>
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset ("/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p> {!! $user->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            {{--<li class="header">Menu</li>--}}
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/page/Introduction') }}"><i class="fa fa-link"></i> <span>Introduction</span></a></li>

            <li><a href="{{ url('/page/Company') }}"><i class="fa fa-link"></i> <span>Company</span></a></li>
            <li><a href="{{ url('/page/Product') }}"><i class="fa fa-link"></i> <span>Product</span></a></li>
            <li><a href="{{ url('/page/Pay-plan') }}"><i class="fa fa-link"></i> <span>Pay Plan</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
