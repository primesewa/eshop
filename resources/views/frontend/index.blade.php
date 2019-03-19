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
		            				<h2>from <span>Here </span></h2>
				                   	<a class="shopbtn" href="#">shop now</a>
		            			</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
            </div>
@endforeach



        </div>

		<section class="wn__product__area brown--color pt--80  pb--30">

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
								<a class="first__img" href="single-product.html"><img src="assets/images/books/1.jpg" alt="product image"></a>
								<a class="second__img animation1" href="single-product.html"><img src="/storage/image/{{$book->Image}}" alt="product image"></a>
								<div class="hot__box">
									<span class="hot-label">BEST SALLER</span>
								</div>
							</div>
							<div class="product__content content--center">
								<h4><a href="single-product.html">{{$book->Title}}</a></h4>
								<ul class="prize d-flex">
									<li>${{$book->Discount_price}}</li>
									<li class="old_prize">${{$book->Main_price}}</li>
								</ul>
								<div class="action">
									<div class="actions_inner">
										<ul class="add_to_links">
											<li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
											<li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
											<li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
											<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="product__hover--content">
									<ul class="rating d-flex">
										<li class="on"><i class="fa fa-star-o"></i></li>
										<li class="on"><i class="fa fa-star-o"></i></li>
										<li class="on"><i class="fa fa-star-o"></i></li>
										<li><i class="fa fa-star-o"></i></li>
										<li><i class="fa fa-star-o"></i></li>
									</ul>
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

		{{--<section class="wn__bestseller__area bg--white pt--80  pb--30">--}}
			{{--<div class="container">--}}
				{{--<div class="row">--}}
					{{--<div class="col-lg-12">--}}
						{{--<div class="section__title text-center">--}}
							{{--<h2 class="title__be--2">All <span class="color--theme">Products</span></h2>--}}
							{{--<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="row mt--50">--}}
					{{--<div class="col-md-12 col-lg-12 col-sm-12">--}}
						{{--<div class="product__nav nav justify-content-center" role="tablist">--}}
                            {{--<a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">ALL</a>--}}
                        {{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="tab__container mt--30">--}}
{{--all--}}
					{{--<div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">--}}
						{{--<div class="product__indicator--4 arrows_style owl-carousel owl-theme">--}}
                            {{--@foreach($books as $book)--}}
							{{--<div class="single__product">--}}

								{{--<div class="col-lg-3 col-md-4 col-sm-6 col-12">--}}

                                        {{--<div class="product product__style--3">--}}
                                                {{--<div class="product__thumb">--}}
                                                    {{--<a class="first__img" href="single-product.html"><img src="assets/images/books/1.jpg" alt="product image"></a>--}}
                                                    {{--<a class="second__img animation1" href="/single-product"><img src="/storage/image/{{$book->Image}}" alt="product image"></a>--}}
                                                    {{--<div class="hot__box">--}}
                                                        {{--<span class="hot-label">BEST SALLER</span>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="product__content content--center">--}}
                                                    {{--<h4><a href="single-product.html">{{$book->Title}}</a></h4>--}}
                                                    {{--<ul class="prize d-flex">--}}
                                                        {{--<li>${{$book->Discount_price}}</li>--}}
                                                        {{--<li class="old_prize">${{$book->Main_price}}</li>--}}
                                                    {{--</ul>--}}
                                                    {{--<div class="action">--}}
                                                        {{--<div class="actions_inner">--}}
                                                            {{--<ul class="add_to_links">--}}
                                                                {{--<li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>--}}
                                                                {{--<li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>--}}
                                                                {{--<li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>--}}
                                                                {{--<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>--}}
                                                            {{--</ul>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="product__hover--content">--}}
                                                        {{--<ul class="rating d-flex">--}}
                                                            {{--<li class="on"><i class="fa fa-star-o"></i></li>--}}
                                                            {{--<li class="on"><i class="fa fa-star-o"></i></li>--}}
                                                            {{--<li class="on"><i class="fa fa-star-o"></i></li>--}}
                                                            {{--<li><i class="fa fa-star-o"></i></li>--}}
                                                            {{--<li><i class="fa fa-star-o"></i></li>--}}
                                                        {{--</ul>--}}
                                                    {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}

						{{--</div>--}}

                            {{--</div>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}


{{--end all--}}
{{--mav bio--}}

					{{--</div>--}}
				{{--</div>--}}
		{{--</section>--}}
    @endsection


