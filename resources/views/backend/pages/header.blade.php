@section('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @foreach($icons as $i)
        <link rel="shortcut icon" href="/storage/image/{{$i->image}}">
    @endforeach
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title',$title)</title>
    @yield('style')
    <link href="{{url('css/admin.css')}}" rel="stylesheet">
</head>
<body id="page-top">
<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    @foreach($icons as $i)
    <a class="navbar-brand mr-1" href=""><img src="/storage/image/{{$i->image}}" size="20%"></a>
    @endforeach

        <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Navbar Search -->
        {{--<div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">--}}
                {{--<div class="input-group-append">--}}
                     {{--<img src="/storage/image/{{Auth::user()->image}}" width="50px;" height="50px;" class="rounded">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        {{--<!-- Navbar -->--}}
        {{--<ul class="navbar-nav ml-auto ml-md-0">--}}
            {{--<li class="nav-item dropdown no-arrow">--}}
                {{--<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--<i class="fas fa-user-circle fa-fw"></i>--}}
                {{--</a>--}}
                {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">--}}
                    {{--<a class="dropdown-item" >{{Auth::user()->username}}</a>--}}
                        {{--<a  class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"  onclick="event.preventDefault();--}}
                                                     {{--document.getElementById('logout-form').submit();" class="waves-effect"><i class="fas fa-sign-out-alt"></i> logout</a>--}}
                        {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                            {{--@csrf--}}
                        {{--</form>--}}
                {{--</div>--}}
            {{--</li>--}}
        {{--</ul>--}}
</nav>
@endsection
