@extends('frontend.layouts.layout')
@section('content')


    <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
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
    @if(isset($sections))
    <section class="wn__product__area brown--color pt--80  pb--30">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center>
                    @if(session('success'))

                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>

                    @endif

                    @if(session('error'))

                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>

                    @endif
                </center>
            </div>
        </div>
        @foreach($sections as $section)

            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">{{$section->title}}</h2>
                            <p>{{$section->description}}</p>
                        </div>
                    </div>
                </div>

                <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
                    @foreach($section->book_id as $id)
                        @foreach($books as $book)
                            @if($book->id == $id)
                                <div class="product product__style--3">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <div class="product__thumb">
                                            <a class="first__img" href="book_show/{{$book->id}}"><img src="/storage/image/{{$book->Image}}" alt="product image"></a>
                                            <div class="hot__box">
                                                <span class="hot-label">{{$book->feature}}</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4><a href="book_show/{{$book->id}}">{{$book->Title}}</a></h4>
                                            <ul class="prize d-flex">
                                                <li>{{$book->currency}} {{$book->Discount_price}}</li>
                                                <li class="old_prize">{{$book->currency}} {{$book->Main_price}}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li><a class="cart" href="{{route('add.library',[$book->id])}}"><i class="bi bi-shopping-bag4"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach

                </div>
            </div>
        @endforeach
    </section>
    @endif
    @if(isset($vsections))
    <section class="wn__product__area brown--color pt--80  pb--30">
        @foreach($vsections as $vsection)
            <div class="container" id="container2">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">{{$vsection->title}}</h2>
                            <p>{{$vsection->description}}</p>
                        </div>
                    </div>
                </div>
                <div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
                    @foreach(explode(",",$vsection->vendor_id) as $id)
                        @foreach($vendors as $vendor)
                            @if($vendor->id == $id)
                                <div class="product product__style--3">
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                        <div class="product__thumb">
                                            <a class="first__img" href="{{route('vendor.book.show',[$vendor->id])}}"><img src="/storage/image/{{$vendor->Image}}" alt="product image"></a>
                                            <div class="hot__box">
                                                <span class="hot-label">{{$vendor->feature}}</span>
                                            </div>
                                        </div>
                                        <div class="product__content content--center">
                                            <h4><a href="book_show/{{$vendor->id}}">{{$vendor->Title}}</a></h4>
                                            <ul class="prize d-flex">
                                                <li>{{$vendor->currency}} {{$vendor->Discount_price}}</li>
                                                <li class="old_prize">{{$vendor->currency}} {{$vendor->Main_price}}</li>
                                            </ul>
                                            <div class="action">
                                                <div class="actions_inner">
                                                    <ul class="add_to_links">
                                                        <li><a class="cart" href="{{route('add.library',[$vendor->id])}}"><i class="bi bi-shopping-bag4"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
    @endforeach
    </section>
    @endif


@endsection


@section('style')
    <style>
        #container2
        {
            padding-bottom: 10px;
        }
    </style>
    @endsection
