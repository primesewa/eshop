@include('backend.pages.header')
@include('backend.pages.footer')
@include('backend.pages.sidebar')
{{--@include('backend.pages.message')--}}
@yield ('header')
@yield('sidebar')
@yield('content')
{{--@yield('message')--}}
@yield ('footer')

