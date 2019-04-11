@extends('frontend.layouts.layout')
@section('meta')
    <meta name="Title" content="{{$book->Title}}">
    <meta name="Description" content="{{$book->Description}}">
    <meta name="Tag" content="{{$book->tag}}">
    <meta name="Keyword" content="{{$book->tag}}">
    @endsection
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
		        							  <a href="1.jpg"><img src="/storage/image/{{$book->Image}}" alt="" height="400px;" width="300px;"></a>
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
        								<h1>{{$book->Title}}</h1>
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
        									<span>{{$book->currency}} {{$book->Discount_price}}</span>
        								</div>
                                        @if(isset($book->name))
                                        <div class="product__overview">

                                            <p>Vendor Name: {!!  $book->name !!}</p>
                                        </div>
                                        @endif
        								<div class="box-tocart d-flex">

        									<div class="addtocart__actions">
                                                <form action="{{route('add.library',[$book->id])}}" method="post">
                                                    <input name ="_method" type="hidden" value="get">
                                                            @csrf
                                                    <button class="tocart" type="submit">Add to Library</button>
                                                </form>
        									</div>
        								</div>
										<div class="product_meta">
											<span class="posted_in">Categories:
												{{$book->maincategory->main_category}}/{{$book->subcategory->sub_category}}/{{$book->minicategory->mini_category}}
											</span>
										</div>
                                        <br>
                                        {{--<div class="box-tocart d-flex">--}}

                                            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
                                                {{--Show Demo--}}
                                            {{--</button>--}}

                                            {{--<!-- Modal -->--}}
                                            {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                                                {{--<div class="modal-dialog" role="document">--}}
                                                    {{--<div class="modal-content" id="model">--}}
                                                        {{--<div class="modal-header">--}}
                                                            {{--<h5 class="modal-title" id="exampleModalLabel">Demo</h5>--}}
                                                            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                                                {{--<i class="fas fa-times"></i>--}}
                                                            {{--</button>--}}
                                                        {{--</div>--}}
                                                            {{--<div id="main">--}}
                                                                {{--<div class="magazine-viewport">--}}
                                                                    {{--<div class="container">--}}
                                                                        {{--<div id="book"></div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}

                                                                {{--<div id="controls">--}}

                                                                    {{--<button id="next">Next</button>--}}
                                                                    {{--<button id="zoominbutton" type="button">zoom in</button>--}}
                                                                    {{--<button id="zoomoutbutton" type="button">zoom out</button>--}}
                                                                    {{--<label for="page-number">Page:</label> <input type="text" size="1" id="page-number"> of <span id="number-pages"></span>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}


                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}


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
                                        <p>Title : {{$book->Title}}</p>
                                        <p>Author : {{$book->Author }}</p>


                                        <p>Description : <br>{!! $book->Description !!}</p>
									</div>
	                        	</div>
	                        	<!-- End Single Tab Content -->
	                        	<!-- Start Single Tab Content -->
	                        	{{--<div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">--}}
									{{--<div class="review__attribute">--}}
										{{--<h1>Customer Reviews</h1>--}}
										{{--<h2>Hastech</h2>--}}
										{{--<div class="review__ratings__type d-flex">--}}
											{{--<div class="review-ratings">--}}
												{{--<div class="rating-summary d-flex">--}}
													{{--<span>Quality</span>--}}
			    									{{--<ul class="rating d-flex">--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
			    									{{--</ul>--}}
												{{--</div>--}}

												{{--<div class="rating-summary d-flex">--}}
													{{--<span>Price</span>--}}
			    									{{--<ul class="rating d-flex">--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
			    									{{--</ul>--}}
												{{--</div>--}}
												{{--<div class="rating-summary d-flex">--}}
													{{--<span>value</span>--}}
			    									{{--<ul class="rating d-flex">--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
			    									{{--</ul>--}}
												{{--</div>--}}
											{{--</div>--}}
											{{--<div class="review-content">--}}
												{{--<p>Hastech</p>--}}
												{{--<p>Review by Hastech</p>--}}
												{{--<p>Posted on 11/6/2018</p>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
									{{--<div class="review-fieldset">--}}
										{{--<h2>You're reviewing:</h2>--}}
										{{--<h3>Chaz Kangeroo Hoodie</h3>--}}
										{{--<div class="review-field-ratings">--}}
											{{--<div class="product-review-table">--}}
												{{--<div class="review-field-rating d-flex">--}}
													{{--<span>Quality</span>--}}
													{{--<ul class="rating d-flex">--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
			    									{{--</ul>--}}
												{{--</div>--}}
												{{--<div class="review-field-rating d-flex">--}}
													{{--<span>Price</span>--}}
													{{--<ul class="rating d-flex">--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
			    									{{--</ul>--}}
												{{--</div>--}}
												{{--<div class="review-field-rating d-flex">--}}
													{{--<span>Value</span>--}}
													{{--<ul class="rating d-flex">--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
														{{--<li class="off"><i class="zmdi zmdi-star"></i></li>--}}
			    									{{--</ul>--}}
												{{--</div>--}}
											{{--</div>--}}
										{{--</div>--}}
										{{--<div class="review_form_field">--}}
											{{--<div class="input__box">--}}
												{{--<span>Nickname</span>--}}
												{{--<input id="nickname_field" type="text" name="nickname">--}}
											{{--</div>--}}
											{{--<div class="input__box">--}}
												{{--<span>Summary</span>--}}
												{{--<input id="summery_field" type="text" name="summery">--}}
											{{--</div>--}}
											{{--<div class="input__box">--}}
												{{--<span>Review</span>--}}
												{{--<textarea name="review"></textarea>--}}
											{{--</div>--}}
											{{--<div class="review-form-actions">--}}
												{{--<button>Submit Review</button>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
	                        	{{--</div>--}}
	                        	<!-- End Single Tab Content -->
	                        </div>
        				</div>
                        @if(count($relatedbooks)>0)
						<div class="wn__related__product pt--80 pb--50">
							<div class="section__title text-center">
								<h2 class="title__be--2">Related Products</h2>
							</div>
							<div class="row mt--60">

								<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                                    @foreach($relatedbooks as $related)
									<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
										<div class="product__thumb">
											<a class="first__img" href="{{route('book.show',[$related->id])}}"><img src="/storage/image/{{$related->Image}}" alt="product image"></a>
											<div class="hot__box">
												<span class="hot-label">{{$related->feature}}</span>
											</div>
										</div>
										<div class="product__content content--center">
											<h4><a href="/single-product">{{$related->Title}}</a></h4>
											<ul class="prize d-flex">
												<li>{{$book->currency}}{{$related->Discount_price}}</li>
												<li class="old_prize">{{$book->currency}}{{$related->Main_price}}</li>
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														<li><a class="cart" href="{{route('add.library',[$related->id])}}"><i class="bi bi-shopping-bag4"></i></a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
                                    @endforeach
								</div>
							</div>


						</div>
                        @endif

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


                                             @foreach(explode(',',$book->tag) as $tag)

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
@section('script')

    <script id="my_script" type="text/javascript">

        // $('#book .double').scissor();

        var numberOfPages = 0;
        var url = '/storage/file/{{$x}}';

        var rendered = [];
        var firstPagesRendered = false;



        var pdf = null,
            pageNum = 1,
            scale = 0.7;

        function renderPage(num) {

            pdf.getPage(num).then(function(page) {

                    var viewport = page.getViewport(scale);

                    //
                    // Prepare canvas using PDF page dimensions
                    //
                    var canvasID = 'canv' + num;
                    var canvas = document.getElementById(canvasID);
                    if (canvas == null) return;
                    var context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    //
                    // Render PDF page into canvas context
                    //
                    var renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);

                    // Update page counters
                    document.getElementById('page-number').textContent = pageNum;
                    document.getElementById('number-pages').textContent = pdf.numPages;
                }
            )}


        // Adds the pages that the book will need
        function addPage(page, book) {
            // 	First check if the page is already in the book
            if (!book.turn('hasPage', page)) {


                // Create an element for this page
                var element = $('<div />', {'class': 'page '+((page%2==0) ? 'odd' : 'even'), 'id': 'page-'+page})
                element.html('<div class="data"><canvas id="canv' + page + '"></canvas></div>');
                // element.html('<div><i>test</i></div>');
                // If not then add the page
                book.turn('addPage', element, page);
                // renderPage(page);
                //*/
            }
        }



        $(window).ready(function(){

            pdfjsLib.disableWorker = true;

            pdfjsLib.getDocument(url).then(function(pdfDoc) {

                numberOfPages = pdfDoc.numPages;
                pdf = pdfDoc;
                $('#book').turn.pages = numberOfPages;


                $('#book').turn({acceleration: false,
                    pages: numberOfPages,
                    elevation: 50,
                    gradients: !$.isTouch,
                    // display: 'single',
                    when: {
                        turning: function(e, page, view) {

                            // Gets the range of pages that the book needs right now
                            var range = $(this).turn('range', page);

                            // Check if each page is within the book
                            for (page = range[0]; page<=range[1]; page++) {
                                addPage(page, $(this));
                            };

                        },

                        turned: function(e, page) {
                            $('#page-number').val(page);

                            if (firstPagesRendered) {
                                var range = $(this).turn('range', page);
                                for (page = range[0]; page<=range[1]; page++) {
                                    if (!rendered[page]) {
                                        renderPage(page);
                                        rendered[page] = true;
                                    }
                                };
                            }

                        }
                    }
                });
                $('#book').click(function(e) {
                    var pos = {
                        x: e.pageX - $(this).offset().left,
                        y: e.pageY - $(this).offset().top
                    };
                    console.log(pos);
                    $('#book').zoom('zoomIn', pos);
                });

                $('#number-pages').html(numberOfPages);

                $('#page-number').keydown(function(e){

                    var p = $('#page-number').val();
                    if (e.keyCode==13) {
                        $('#book').turn('page', p);
                        renderPage(p);
                    }

                });

                var n = numberOfPages;
                if (n > 6 ) n = 6;

                for (page = 1; page <= n; page++) {
                    renderPage(page);
                    rendered[page] = true;
                };
                firstPagesRendered = true;


            });


        });

        $(window).bind('keydown', function(e){

            if (e.target && e.target.tagName.toLowerCase()!='input')
                if (e.keyCode==37)
                    $('#book').turn('previous');
                else if (e.keyCode==39)
                    $('#book').turn('next');

        });

    </script>


@endsection
@section('style')
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.943/build/pdf.min.js"></script>
    {{--<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>--}}
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{asset('js/turn.js')}}"></script>
    <script type="text/javascript" src="{{asset('turnjs4/lib/zoom.js')}}"></script>
    <style>
    #book{
    width:900px;
    height:570px;
    margin: 20px;
    /*box-shadow: 0px 0px 20px gray;*/
    /*z-index: -.5;*/
    }

    #book .turn-page{
    background-color:white;

    background-color:silver;
    box-shadow: 0px 0px 10px gray;
    }


    #book .cover{
    background:#333;
    }

    #book .cover h1{
    color:white;
    text-align:center;
    font-size:50px;
    line-height:500px;
    margin:0px;
    }

    #book .loader{
    /*background-image:url();*/
    width:24px;
    height:24px;
    display:block;
    position:relative;
    top:238px;
    left:188px;
    }

    #book .data{
    text-align:center;
    font-size:40px;
    color:#999;
    line-height:500px;
    }

    #controls{
    width:800px;
    text-align:center;
    margin:10px 0px;
    font:15px arial;
    /*float: right;*/
    position: absolute;
    padding-left: 300px;
    top: 575px;
    /*z-index: 1;*/
    }

    #controls input, #controls label{
    font:15px arial;

    }

    #book .odd{
    background-image:-webkit-linear-gradient(left, #FFF 95%, #ddd 100%);
    background-image:-moz-linear-gradient(left, #FFF 95%, #ddd 100%);
    background-image:-o-linear-gradient(left, #FFF 95%, #ddd 100%);
    background-image:-ms-linear-gradient(left, #FFF 95%, #ddd 100%);
    }

    #book .even{
    background-image:-webkit-linear-gradient(right, #FFF 95%, #ddd 100%);
    background-image:-moz-linear-gradient(right, #FFF 95%, #ddd 100%);
    background-image:-o-linear-gradient(right, #FFF 95%, #ddd 100%);
    background-image:-ms-linear-gradient(right, #FFF 95%, #ddd 100%);
    }
    #main
    {
    height: 500px;
    }
        #model
        {
            height: 800px;
            width: 900px;

        }
    </style>
    @endsection
