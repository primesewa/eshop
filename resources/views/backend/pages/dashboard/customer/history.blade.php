@extends('backend.main-master.main-master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Customer</li>

            <li class="breadcrumb-item active">Customer History</li>
        </ol>

        <div class="container">

            <h2>{{$user->name}}</h2>
            @if((count($orders)) > 0)
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Price</th>
                    <th>Time</th>
                    <th>Payment Id</th>
                </tr>
                </thead>
                    @foreach($orders as $order)
                        {{--{{dd($order)}}--}}
                         @foreach($order->library->items as $item)
                            <tbody>
                                <tr>
                                    <td>{{$item['item']['Title']}}</td>
                                    <td>{{$item['item']['Discount_price']}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->payment_id}}</td>
                                </tr>
                            </tbody>
                        @endforeach
                @endforeach
            </table>
                @endif
        </div>
    </div>
</div>
@endsection
@section('style')
    <style>
        ul {
            list-style-type: none;
        }
    </style>
    @endsection
