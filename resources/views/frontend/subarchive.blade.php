@extends('frontend.layouts.user-dashboard')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Buy Sub-Category</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Buy Sub-Category</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <div class="container">
                    <h2>Sub-Category</h2>
                    <p>You will get these books if buy this Category</p>
                    <table class="table table-hover" style="width: 900px;">
                        <thead>
                        <tr>
                            <th>Sub-Category</th>
                            <th>Book</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        @foreach($books as $book)
                        <tbody>
                        <tr>
                                @if($book->sub_id == $subcategory->id)
                            <td>{{$subcategory->sub_category}}</td>
                            <td>{{$book->Title}}</td>
                            <td>{{$book->Discount_price}}</td>
                                @endif
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <h5>Price of sub-category '{{$subcategory->sub_category}}' is only {{$subcategory->price}}. Expire After {{$subcategory->expire_date}} days</h5>
                </div>
               <a href="{{route('sub.pay',[$subcategory->id])}}" class="btn btn-primary"> Pay</a>
            </div>
        </div>
    </div>
@endsection
