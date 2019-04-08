@extends('frontend.layouts.user-dashboard')
@section('content')
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Dashboard</h4> </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Books ordered</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{count(Auth::user()->orders)}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Categorys Ordered</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash2"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{count(Auth::user()->suborders)+count(Auth::user()->miniorders)}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Unique Visitor</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash3"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">911</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            @if(isset($orders))
            <div class="row">
                <div class="col-md-12">

                        <h5>Your Books <a href="{{route('user.library')}}">View all books</a> </h5>
                        <hr>
                        @foreach($orders as $order)
                            @foreach($order->library->items as $item)
                                <div class="col-md-4" id="book">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{route('user.book',[$item['item']['id']])}}">
                                    <img class="card-img-top" src="/storage/image/{{$item['item']['Image']}}" height="200px;" width="200px;" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$item['item']['Title']}}</h5>
                                    </div>
                                    </a>
                                </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif
            @if(isset($suborders))
            <div class="row">
                <div class="col-md-12">
                    <h5>Your Sub-Category <a href="{{route('my.category')}}">View all category</a> </h5>
                    <hr>
                    @foreach($suborders as $sub)
                        @foreach($books as $book)
                            @if($book->sub_id == $sub->sub_id)
                                    <div class="col-md-4" id="book">
                                        <div class="card" style="width: 18rem;">
                                            <a href="{{route('sub.read',[$book->id])}}">
                                                <img class="card-img-top" src="/storage/image/{{$book->Image}}" height="200px;" width="200px;" alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$book->Title}}</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
            @endif

            @if(isset($miniorders))

                <div class="row">
                    <div class="col-md-12">
                        <h5>Your Mini-Category <a href="{{route('mini.category')}}">View all Mini-category</a> </h5>
                        <hr>
                        @foreach($miniorders as $mini)
                            @foreach($books as $book)
                                @if($book->mini_id == $mini->mini_id)
                                    <div class="col-md-4" id="book">
                                        <div class="card" style="width: 18rem;">
                                            <a href="{{route('mini.read',[$book->id])}}">
                                                <img class="card-img-top" src="/storage/image/{{$book->Image}}" height="200px;" width="200px;" alt="Card image cap">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$book->Title}}</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @endif

    @endsection
@section('style')
    <style>
       #book
       {
           padding-bottom: 20px;
           padding-top: 10px;
       }
    </style>

@endsection
