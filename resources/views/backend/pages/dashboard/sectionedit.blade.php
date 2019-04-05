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
                <li class="breadcrumb-item active">Edit Home Section</li>

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

                    <h3>Edit Home Section</h3>
                        @foreach($section as $s)
                    <form  action="{{route('section.update',[$s->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name ="_method" type="hidden" value="PUT">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text"  class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Section Title " name="title" value="{{ $s->title}}" >
                                    @if($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label > description</label>
                                    <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Section Description" name=" description" value="{{ $s->description }}" >
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Section Postion</label>
                                    <select  id="mini"class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}"  name="position">
                                        <option value="" >Select</option>
                                        <option value="1" @if($s->position == 1)selected @endif>Top Section</option>
                                        <option value="2"@if($s->position == 2)selected @endif>Second Section</option>
                                        <option value="3"@if($s->position == 3)selected @endif>Third Section</option>
                                        <option value="4"@if($s->position == 4)selected @endif>Forth Section</option>
                                        <option value="5"@if($s->position == 5)selected @endif>Fifth Section</option>
                                        <option value="6"@if($s->position == 6)selected @endif>Last Section</option>
                                    </select>
                                    @if($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('position') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="drop">
                                    <label >Books</label>
                                    <select id="select"  class="form-control {{ $errors->has('book_id') ? ' is-invalid' : '' }}"  name="book_id[]" multiple="multiple">
                                        @foreach($books as $book)
                                            {{--@foreach(json_decode($s->book_id) as $id)--}}
                                            <option value="{{$book->id}}" @if(in_array($book->id,json_decode($s->book_id)))selected @endif>{{$book->Title}}</option>
                                        {{--@endforeach--}}
                                        @endforeach
                                    </select>
                                    @if($errors->has('book_id'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('book_id') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                        @endforeach
                    </form>

                    <br>
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
                    dropdownParent: $('#drop'),
                    placeholder:'Select Your Book Title '
                }
            );

        });
    </script>


@endsection
