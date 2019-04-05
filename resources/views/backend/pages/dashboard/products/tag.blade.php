@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"> Home Section</li>
                <li class="breadcrumb-item active">Add Tag</li>

            </ol>
            <div class="row justify-content-center">
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

                    <h3>Add Home Section</h3>
                    <form  action="{{route('tag.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Section Postion</label>
                                    <select  id="mini"class="form-control {{ $errors->has('book_id') ? ' is-invalid' : '' }}"  name="book_id">
                                        <option value="">Select</option>
                                        @foreach($books as $book)
                                            <option value="{{$book->id}}">{{$book->Title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('book_id'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('book_id') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="drop">
                                    <label >Books</label>
                                    <select id="select"  class="form-control {{ $errors->has('tag') ? ' is-invalid' : '' }}"  name="tag[]" multiple="multiple">
                                    </select>
                                    @if($errors->has('tag'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tag') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                    </form>

                    <br>
                        <div class="container">
                            <h2>Tags</h2>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Book</th>
                                    <th>Tag</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                @foreach($tags as $tag)
                                <tbody>
                                <tr>
                                    @foreach($books as $book)
                                        @if($book->id == $tag->book_id)
                                            <td>{{$book->Title}}</td>
                                        @endif
                                    @endforeach
                                    <td>
                                        <select>
                                            <option value=""> your books tages</option>
                                            @foreach(explode(",",$tag->tag) as $t))
                                                <option >{{$t}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{route('tag.edit',[$tag->id])}}"><span><i class="fas fa-edit"></i></span></a>
                                    </td>
                                    <td>
                                        <form method="post" action="{{route('tag.delete',[$tag->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="DELETE">
                                            <button onclick="return confirm('Are you sure want to delete this Tag?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                        </form>
                                    </td>
                                </tr>

                                </tbody>
                                @endforeach
                            </table>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>

    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('script')
    <script
        src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#select').select2(
                {
                    placeholder:'Enter tags',
                    tags: true,
                    tokenSeparators: [',', ' ']
                }
            );

        });
    </script>


@endsection
