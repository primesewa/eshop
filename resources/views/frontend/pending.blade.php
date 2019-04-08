@extends('frontend.layouts.user-dashboard')
@section('content')
   @if(Session::has('library'))
       <div class="row bg-title">
           <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
               <h4 class="page-title">Pending Books</h4> </div>
           <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
               <ol class="breadcrumb">
                   <li><a href="#">Dashboard</a></li>
                   <li class="active">Pending</li>
               </ol>
           </div>
           <!-- /.col-lg-12 -->
       </div>
       <div class="container">
           <div class="row">
               <div class="col-md-12">
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
                                <table class="table table-bordered" id="pending">
                                    <thead>
                                    <tr>
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th>Expire At</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    @foreach($librarys as $library)
                                        <tr>
                                            <td><img src="/storage/image/{{$library['item']['Image']}}" width="100" ></td>

                                            <td>{{$library['item']['Title']}}</td>
                                            <td>{{$library['item']['Discount_price']}}</td>
                                            <td>{{$library['expire_at']}}</td>
                                            <td class="product-remove"><a href="{{route('delete.library',[$library['item']['id']])}}"><span><i class="far fa-trash-alt"></i></span></a></td>
                                        </tr>
                                        @endforeach

                                    @foreach($vendors as $vendor)
                                        <tr>
                                        <td><img src="/storage/image/{{$vendor['item']['Image']}}" width="100" ></td>

                                        <td>{{$vendor['item']['Title']}}</td>
                                        <td>{{$vendor['item']['Discount_price']}}</td>
                                        <td>{{$vendor['expire_at']}}</td>
                                        <td class="product-remove"><a href="{{route('vendor.remove',[$vendor['item']['id']])}}"><span><i class="far fa-trash-alt"></i></span></a></td>
                                        </tr>
                                        @endforeach
                                    <tr>
                                        <td><a href="{{route('user.pay')}}" class="btn btn-primary">Buy</a></td>
                                        <td>Total Qty: {{$totalqty + $totalqty_vendor}}</td>
                                        <td>Total Amount: {{$totalprice + $totalprice_vendor}}</td>
                                        <td></td>
                                    </tr>
                                    </tbody>

                                </table>

                    </div>
                </div>
            </div>

    @endif
@endsection
@section('style')
<style>
    #pending
    {
        width: 600px;
        margin-right: 30px;
        color: white;
    }
</style>
@endsection
