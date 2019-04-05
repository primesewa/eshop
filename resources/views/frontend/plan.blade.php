@extends('frontend.layouts.layout')
@section('content')

    <div class="page-about about_area bg--white section-padding--lg">
        @foreach($banner as $ban)
            <div class="slide animation__style10  fullscreen align__center--left" style="background-image: url('/storage/image/{{$ban->image}}'); background-repeat: no-repeat;" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="slider__content">
                                <div class="contentbox">
                                    <h2>Buy <span>your </span></h2>
                                    <h2>favourite <span>Book </span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <section class="wn__team__area pb--75 bg--white">
        <div id="about_us">
            @foreach($abouts as $about)
                @if($about->status == 'Plans & pricing')
                    {{--{{dd($abouts)}}--}}
                    <h2> {{$about->title}}</h2>
                    <p> {!! $about->description !!}</p>
                @endif
            @endforeach
        </div>


    </section>

@endsection
@section('style')
    <style>
        #about_us{
            text-align: center;
        }
    </style>
@endsection
