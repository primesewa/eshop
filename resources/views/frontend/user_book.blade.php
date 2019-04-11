@extends('frontend.layouts.user-dashboard')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">My Books</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">My Books</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
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
            <div class="white-box">
                @if(isset(Auth::user()->vendor))
                <div class="container">
                    <table class="table table-hover" style="width: 1000px;">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Expire date</th>
                            <th>Currency</th>
                            <th>Feature</th>
                            <th>Main price</th>
                            <th>Discount price</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Auth::user()->vendor as $book)
                        <tr>
                            <td>{{$book->Title}}</td>
                            <td>{{$book->Description}}</td>
                            <td>{{$book->Author}}</td>
                            <td>{{$book->expire_date}}</td>
                            <td>{{$book->currency}}</td>
                            <td>{{$book->feature}}</td>
                            <td>{{$book->Main_price}}</td>
                            <td>{{$book->Discount_price}}</td>
                            <td> <img src="/storage/image/{{$book->Image}}" style="width: 50px; hight:50px;"></td>
                            <td><a href="{{route('user.book.edit',[$book->id])}}"><span><i class="fas fa-edit"></i></span></a></td>

                            <td>
                                <form method="post" action="{{route('user.book.drop',[$book->id])}}">
                                    @csrf
                                    <input name ="_method" type="hidden" value="DELETE">
                                    <button onclick="return confirm('Are you sure want to delete this product?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
