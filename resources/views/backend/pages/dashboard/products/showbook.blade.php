@extends('backend.main-master.main-master')
@section('content')
    <div id="content-wrapper">
        <div class="row justify-content-center">

            <div class="container-fluid col-12">
                    <!-- Breadcrumbs-->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Books</li>
                        <li class="breadcrumb-item active">Show Books</li>
                    </ol>
                    <div id="message">
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

                    <h2>Books</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Author</th>
                            <th>Expire date</th>
                            <th>Currency</th>
                            <th>Feature</th>
                            <th>Main price</th>
                            <th>Discount price</th>
                            <th>Image</th>
                            <th>file</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        @foreach ($books as $book)

                        <tbody>
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$book->Title}}</td>
                            <td>{{$book->Description}}</td>
                            <td>{{$book->Author}}</td>
                            <td>{{$book->expire_date}}</td>
                            <td>{{$book->currency}}</td>
                            <td>{{$book->feature}}</td>
                            <td>{{$book->Main_price}}</td>
                            <td>{{$book->Discount_price}}</td>
                            <td> <img src="/storage/image/{{$book->Image}}" style="width: 50px; hight:50px;"></td>
                            <td> <a href="/storage/file/{{$book->file}}"download="{{$book->file}}"><i class="fas fa-file-download"></i></a></td>
                            <td><a href="{{route('books.edit',[$book->id])}}"><span><i class="fas fa-edit"></i></span></a></td>

                                <td>
                                    <form method="post" action="{{route('books.destroy',[$book->id])}}">
                                        @csrf
                                        <input name ="_method" type="hidden" value="DELETE">
                                        <button onclick="return confirm('Are you sure want to delete this product?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                    </form>
                                </td>


                        </tr>

                        </tbody>
                        @endforeach
                    </table>

                </div>


            </div>
        </div>
@endsection
@section('style')
    <style>
        #message{
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
    @endsection
