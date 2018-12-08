<!--<style>
    .border-all{
        /*  border: solid 2px #9a9a9a;
          border-top: 0px;*/
        /*//box-shadow: 5px 5px 5px 5px #888888;*/
    }
    @media handheld and (min-width: 1000px),
    screen and (min-width: 1000px) {
        .header-section {
            right: 10%;
            left: 10%
        }
    }
</style>
<div class="header-section" style="">
    <style>
        .menu{

            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
        }
        @media handheld and (min-width: 300px),
        screen and (min-width: 300px){
            .menu{
                margin-left: 2%;

            }

        }

    </style>
    <div style="padding-top: 1%; padding-bottom: 1%;">

        <a href="/" class="menu pull-left"><img src="images/EASFF-logo-small.png" style="float: left; "></a>
        <a href="/" class="menu">Home</a>
        <a href="/NewPost" class="menu">Submission</a>
        <a href="/about" class="menu">About</a>
        <a href="/archive" class="menu">Archive</a>
        <a href="/support" class="menu">Support & Partner</a>
        <a href="/contact" class="menu">Contact Us</a>
        <a href="/contact" class="menu">News</a>
        <a href="/faq" class="menu">FAQ</a>
        @if(!empty($user->fname))
    @if($user->usertype == "admin" || $user->usertype == "super-user")
        <a href="/admin" class="menu">Admin</a>
        @endif
@endif
        <div id="loginpop" class="pull-right">
            @if(!empty($user->fname))
    <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
               class="" style="color: whitesmoke;" title="Click to Log out">
                Log out({!! $user->fname !!})</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            @else
    <a href="/login" id="" >
        <span style="">Login <i class="arrow glyphicon glyphicon-chevron-right"></i></span></a>
@endif

        </div>
        ----
    </div>

</div>-->
<style>
    li a {
        color: #ffffff;
        /*font-size: 16px;*/
        font-weight: 500;
    }

    .icon-bar {
        background: #ffffff
    }
</style>
<nav class="navbar" style="background: #9c1d1d;">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar"
                    style="border-color: black;color: #ffffff">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/"
               style="padding-top: 0px;padding-left: 0;float: left; margin-bottom: 0px"><img
                        src="{{asset('images/logo.png')}} "></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">

                <li><a href="/" class="active menu">Home</a></li>

                <li><a href="/about">About Us</a></li>
                <li><a href="/contact">Contact Us</a></li>
                {{--
                                <li> <a href="/faq" >FAQ</a>
                --}} @if(!empty($user->fname))
                    @if($user->usertype=="merchant")
                        <li><a href="/NewPost">Register New Car</a></li>
                        <li><a href="/merchantDashboard">Merchant Dashboard</a></li>
                    @endif
                @if($user->usertype=="user")
                            <li><a href="/memberDashboard">My Dashboard</a></li>
                    @endif

                    @if($user->usertype == "admin" || $user->usertype == "super-user")
                        <li><a href="/admin">Admin</a></li>
                    @endif
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
                @if(!empty($user->fname))
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="glyphicon glyphicon-log-out">
                            Logout({!! $user->fname !!})</a>
                    </li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <li><a href="/login"> Login / Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
