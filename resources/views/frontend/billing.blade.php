 @extends('frontend.layouts.user-dashboard')
                @section('content')
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">setting</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li><a href="#">Dashboard</a></li>
                                <li class="active">setting</li>
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>You Payment History for Books and Categories</h4>
                            <div class="white-box">

                                <div class="container">
                                    <h4>Books</h4>

                                    <table class="table table-hover" style="margin-right: 100px; width: 900px;">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Price</th>
                                            <th>Payed At</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @if(!empty($orders))
                                        @foreach($orders as $order)
                                        @foreach($order->library->items as $item)
                                        <tr>
                                            <td>{{$item['item']['Title']}}</td>
                                            <td> {{$item['price']}}</td>
                                            <td> {{$order->created_at->diffForHumans()}}</td>
                                        </tr>
                                        @endforeach
                                        @endforeach
                                        @endif
                                        @if(!empty($vorders))
                                        @foreach($vorders as $vorder)
                                                <tr>
                                                    <td>{{$vorder->vendor['item']['Title']}}</td>
                                                    <td> {{$vorder->vendor['price']}}</td>
                                                    <td> {{$vorder->created_at->diffForHumans()}}</td>
                                                </tr>
                                        @endforeach
                                        @endif
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

@endsection

