@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"> Home Section</li>
                <li class="breadcrumb-item active">Edit Tag</li>

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
                    <form  action="{{route('tag.update',[$tag->id])}}" method="post">
                        @csrf
                        <input name ="_method" type="hidden" value="PUT">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Section Postion</label>
                                    <select  id="mini"class="form-control {{ $errors->has('book_id') ? ' is-invalid' : '' }}"  name="book_id">
                                        <option value="">Select</option>
                                        @foreach($books as $book)
                                            <option value="{{$book->id}}" @if($book->id == $tag->book_id) SELECTED @endif>{{$book->Title}}</option>
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
                                        @foreach($books as $book)
                                                @foreach(explode(",",$tag->tag) as $ta)
                                                @if($book->id != $tag->book_id)
                                                    @continue
                                                @else
                                                    <option value="{{$ta}}" selected>{{$ta}}</option>
                                                @endif
                                                  @endforeach
                                        @endforeach
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
