<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('head')
    @foreach($icon as $i)
        <link rel="icon" type="image/png" sizes="16x16" href="/storage/image/{{$i->image}}">
    @endforeach

    <title>@yield('title',$title)</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="{{asset('ample/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Menu CSS -->

    <link href="{{asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css')}}" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{asset('ample/plugins/bower_components/toast-master/css/jquery.toast.css')}}" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{asset('ample/plugins/bower_components/morrisjs/morris.css')}}" rel="stylesheet">
    {{--<!-- chartist CSS -->--}}
    <link href="{{asset('ample/plugins/bower_components/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('ample/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
    {{--<!-- animation CSS -->--}}
    <link href="{{asset('ample/css/animate.css')}}" rel="stylesheet">
    {{--<!-- Custom CSS -->--}}
    <link href="{{asset('ample/css/style.css')}}" rel="stylesheet">
    {{--<!-- color CSS -->--}}
    <link href="{{asset('ample/css/colors/default.css')}}" id="theme" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    @yield('style')

    <![endif]-->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo" href="/">
                    {{--{{dd($icon)}}--}}
                        @foreach($icon as $i)
                       <img src="/storage/image/{{$i->image}}" alt="home">
                            @endforeach
                    </a>
            </div>
            <!-- /Logo -->
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    @if(isset(Auth::user()->pic->image))
                        <a><img src="/storage/image/{{Auth::user()->pic->image}}" alt="user-img" width="36" class="img-circle">{{Auth::user()->username}}</a>
                    @else
                        <a ><img src="/storage/image/15TiL93a.jpg" alt="user-img" width="36" class="img-circle">{{Auth::user()->username}}</a>
                    @endif
                </li>
            </ul>
        </div>

    </nav>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav slimscrollsidebar">
            <div class="sidebar-head">
                <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu"> Navigation</span></h3>
            </div>
            <ul class="nav" id="side-menu">
                <li style="padding: 70px 0 0;">
                    <a href="{{route('home')}}" class="waves-effect"><i class="fa fa-clock-o" aria-hidden="true"> </i> Dashboard</a>
                </li>
                <li>
                    <a href="{{route('user.profile')}}" class="waves-effect"><i class="fa fa-user " aria-hidden="true"> </i> Profile</a>
                </li>
                <li>
                    <a href="{{route('user.library')}}" class="waves-effect"><i class="fas fa-book-reader" aria-hidden="true"> </i> Single books</a>
                </li>
                <li>
                    <a href="{{route('my.category')}}" class="waves-effect"><i class="fas fa-folder"></i> Category</a>
                </li>
                <li>
                    <a href="{{route('buy.category')}}" class="waves-effect"><i class="fas fa-archive" aria-hidden="true"> </i>  Buy Category</a>
                </li>
                <li>
                    <a href="{{route('billing')}}" class="waves-effect"><i class="fa fa-table" aria-hidden="true"> </i> Billing</a>
                </li>
                <li>
                    <a href="{{route('pending')}}" class="waves-effect"><i class="fa fa-font " aria-hidden="true"> </i> Pending</a>
                </li>
                <li>
                    <a href="{{route('expire')}}" class="waves-effect"><i class="fa fa-globe" aria-hidden="true"> </i> Expire</a>
                </li>
                <li>
                    <a href="{{route('user.setting')}}" class="waves-effect"><i class="fa fa-columns" aria-hidden="true"> </i> Setting</a>
                </li>
                <li>
                    <a  href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="waves-effect"><i class="fas fa-sign-out-alt"></i> logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>


            </ul>
        </div>

    </div>

    <div id="page-wrapper" >
        <div class="container-fluid">
            @yield('content')



        <footer class="footer text-center">sdkhk </footer>
    </div>

</div>
</div>
<script src="{{asset('ample/plugins/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('ample/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Menu Plugin JavaScript -->
<script src="{{asset('ample/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js')}}"></script>
<!--slimscroll JavaScript -->
<script src="{{asset('ample/js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('ample/js/waves.js')}}"></script>
<!--Counter js -->
<script src="{{asset('ample/plugins/bower_components/waypoints/lib/jquery.waypoints.js')}}"></script>
<script src="{{asset('ample/plugins/bower_components/counterup/jquery.counterup.min.js')}}"></script>
<!-- chartist chart -->
<script src="{{asset('ample/plugins/bower_components/chartist-js/dist/chartist.min.js')}}"></script>
<script src="{{asset('ample/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!-- Sparkline chart JavaScript -->
<script src="{{asset('ample/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{asset('ample/js/custom.min.js')}}"></script>
<script src="{{asset('ample/js/dashboard1.js')}}"></script>
<script src="{{asset('ample/plugins/bower_components/toast-master/js/jquery.toast.js')}}"></script>

<script>
    $(document).ready(function(){
        setTimeout(function(){
            $('.alert').hide('slow');
        },2000);
    });
</script>
@yield('script')

</body>

</html>
