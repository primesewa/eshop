@extends('frontend.layouts.layout')
@section('content')

    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <div class="col-md-12">
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
            </div>
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="wn__single__product">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="wn__fotorama__wrapper">
                                    <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                        <a href="1.jpg"><img src="/storage/image/{{$vendor->Image}}" alt="" height="400px;" width="300px;"></a>
                                        {{--<a href="2.jpg"><img src="assets/images/product/2.jpg" alt=""></a>--}}
                                        {{--<a href="3.jpg"><img src="assets/images/product/3.jpg" alt=""></a>--}}
                                        {{--<a href="4.jpg"><img src="assets/images/product/4.jpg" alt=""></a>--}}
                                        {{--<a href="5.jpg"><img src="assets/images/product/5.jpg" alt=""></a>--}}
                                        {{--<a href="6.jpg"><img src="assets/images/product/6.jpg" alt=""></a>--}}
                                        {{--<a href="7.jpg"><img src="assets/images/product/7.jpg" alt=""></a>--}}
                                        {{--<a href="8.jpg"><img src="assets/images/product/8.jpg" alt=""></a>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product__info__main">
                                    <h1>{{$vendor->Title}}</h1>
                                    <div class="product-reviews-summary d-flex">
                                        <ul class="rating-summary d-flex">
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span>{{$vendor->currency}} {{$vendor->Discount_price}}</span>
                                    </div>
                                    <div class="product__overview">
                                        <p>{{$vendor->currency}} {{$vendor->Description}}</p>
                                    </div>
                                    <div class="box-tocart d-flex">

                                        <div class="addtocart__actions">
                                            <form action="{{route('vendor.book.cart',[$vendor->id])}}" method="post">
                                                <input name ="_method" type="hidden" value="get">
                                                @csrf
                                                <button class="tocart" type="submit">Add to Library</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="product_meta">
											<span class="posted_in">Categories:
                                                {{$vendor->maincategory->main_category}}/{{$vendor->subcategory->sub_category}}/{{$vendor->minicategory->mini_category}}
											</span>
                                    </div>
                                    <br>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product__info__detailed">
                        <div class="pro_details_nav nav justify-content-start" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
                        </div>
                        <div class="tab__container">
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                <div class="description__attribute">
                                    <p>{{$vendor->Description}}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--@if(count($relatedbooks)>0)--}}
                        {{--<div class="wn__related__product pt--80 pb--50">--}}
                            {{--<div class="section__title text-center">--}}
                                {{--<h2 class="title__be--2">Related Products</h2>--}}
                            {{--</div>--}}
                            {{--<div class="row mt--60">--}}

                                {{--<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">--}}
                                    {{--@foreach($relatedbooks as $related)--}}
                                        {{--<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">--}}
                                            {{--<div class="product__thumb">--}}
                                                {{--<a class="first__img" href="{{route('book.show',[$related->id])}}"><img src="/storage/image/{{$related->Image}}" alt="product image"></a>--}}
                                                {{--<div class="hot__box">--}}
                                                    {{--<span class="hot-label">{{$related->feature}}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="product__content content--center">--}}
                                                {{--<h4><a href="/single-product">{{$related->Title}}</a></h4>--}}
                                                {{--<ul class="prize d-flex">--}}
                                                    {{--<li>{{$book->currency}}{{$related->Discount_price}}</li>--}}
                                                    {{--<li class="old_prize">{{$book->currency}}{{$related->Main_price}}</li>--}}
                                                {{--</ul>--}}
                                                {{--<div class="action">--}}
                                                    {{--<div class="actions_inner">--}}
                                                        {{--<ul class="add_to_links">--}}
                                                            {{--<li><a class="cart" href="{{route('add.library',[$related->id])}}"><i class="bi bi-shopping-bag4"></i></a></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</div>--}}


                        {{--</div>--}}
                    {{--@endif--}}

                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Product Categories</h3>
                            <ul>
                                @foreach($categorylist as $cat)
                                    <li><a href="{{route('get.maincategorys',[$cat->id])}}">{{$cat->main_category}} <span>{{$cat->c}}</span></a></li>
                                @endforeach
                            </ul>
                        </aside>
                        {{--<aside class="wedget__categories pro--range">--}}
                        {{--<h3 class="wedget__title">Filter by price</h3>--}}
                        {{--<div class="content-shopby">--}}
                        {{--<div class="price_filter s-filter clear">--}}
                        {{--<form action="#" method="GET">--}}
                        {{--<div id="slider-range"></div>--}}
                        {{--<div class="slider__range--output">--}}
                        {{--<div class="price__output--wrap">--}}
                        {{--<div class="price--output">--}}
                        {{--<span>Price :</span><input type="text" id="amount" readonly="">--}}
                        {{--</div>--}}
                        {{--<div class="price--filter">--}}
                        {{--<a href="#">Filter</a>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</aside>--}}
                        {{--<aside class="wedget__categories poroduct--compare">--}}
                        {{--<h3 class="wedget__title">Compare</h3>--}}
                        {{--<ul>--}}
                        {{--<li><a href="#">x</a><a href="#">Condimentum posuere</a></li>--}}
                        {{--<li><a href="#">x</a><a href="#">Condimentum posuere</a></li>--}}
                        {{--<li><a href="#">x</a><a href="#">Dignissim venenatis</a></li>--}}
                        {{--</ul>--}}
                        {{--</aside>--}}
                        <aside class="wedget__categories poroduct--tag">
                            <h3 class="wedget__title">Book Tags</h3>
                            <ul>


                                @foreach(explode(',',$vendor->tag) as $tag)

                                    <li><a href="#">{{$tag}}</a></li>


                                @endforeach



                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End main Content -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form--2" class="minisearch" action="#">
            <div class="field__search">
                <input type="text" placeholder="Search entire store here...">
                <div class="action">
                    <a href="#"><i class="zmdi zmdi-search"></i></a>
                </div>
            </div>
        </form>
        <div class="close__wrap">
            <span>close</span>
        </div>
    </div>


@endsection

