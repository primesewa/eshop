<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title',$title)</title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @foreach($icon as $i)
        <link rel="shortcut icon" href="/storage/image/{{$i->image}}">
    @endforeach

@yield('style')
</head>
<body>
@yield('content')
@yield('script')

</body>
</html>
