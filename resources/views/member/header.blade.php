<?php
/**
 * Created by PhpStorm.
 * User: DMagige
 * Date: 10/27/2016
 * Time: 10:50 AM
 */
?>
<style>
    .main-header .navbar-custom-menu, .main-header {
        float: none;
    }

    .navbar-nav {
        float: none;
    }
    .navbar-center a{
        font-size: 20px;
        font-weight: bold;
    }

    .navbar-center {
        position: relative;

        left: 0;
        top: 0;
        text-align: center;
        margin: auto;
        height: 100%;
        float: left;
        left:20%;
        overflow: hidden;
    }
</style>

<header class="main-header">

    <!-- Logo -->
    <a href="/home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ config('app.name', 'Home') }}: Home</b></span>

    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>


        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                    <li class="navbar-center">
                        <a href="{{ url('/page/Introduction') }}">
                            Introduction
                        </a>
                    </li>
                    <li class="navbar-center">
                        <a href="{{ url('/page/Company') }}">
                            Company
                        </a>
                    </li>
                    <li class="navbar-center">
                        <a href="{{ url('/page/Product') }}">
                            Product
                        </a>
                    </li>
                    <li class="navbar-center">
                        <a href="{{ url('/page/Pay-plan') }}">
                            Pay Plan
                        </a>
                    </li>
                <li class="navbar-center" style="    margin-top: -10px; padding-bottom: 0px;">
                    <a href="" target="_blank">
                        <img src="{{ asset ("/img/join_now.png")}}"
                             class="" alt="User Image" height="60" title="Click To Join">
                    </a>
                </li>

                <li class="dropdown user user-menu" style="float: right;">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset ("/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}"
                             class="user-image" alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"> {!! $user->fname !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset ("/bower_components/AdminLTE/dist/img/user2-160x160.jpg")}}"
                                 class="img-circle" alt="User Image">

                            <p>
                                {!! $user->name !!}
                                <small>Member since Nov. 2016</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                   class="btn btn-default btn-flat">
                                    Sign out</a>
                            </div>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button  by Dan comment-->
                {{--<li>--}}
                {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </nav>
</header>