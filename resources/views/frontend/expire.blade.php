@extends('frontend.layouts.user-dashboard')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"></h4> Expired Books</div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Expired Books</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="col-md-12">
        @foreach($orders as $order)
            {{--{{dd($order->library['expire_at'])}}--}}
            @foreach($order->library->items as $item)
                @if($item['expire_at']< date("y/m/d"))
                    @foreach($books as $book)
                        @if($item['item']['id'] == $book->id)
                            <div class="col-md-4"  >
                                <div class="row">
                                    <div class="card" style="width:400px;" >
                                        <a href="{{route('user.book',[$book->id])}}"><img class="card-img-top" src="/storage/image/{{$book->Image}}" width="200px;" height="200px;" alt="Card image">
                                            <div class="card-body">
                                                <h4 class="card-title">{{$book->Title}}</h4>
                                                <small class="card-title">Expired: {{$item['expire_at']}}</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endforeach
    </div>
    </div>
@endsection
