@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit Book</li>
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

                    <form action="{{route('books.update',[$book->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name ="_method" type="hidden" value="PUT">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control{{ $errors->has('Title') ? ' is-invalid' : '' }}" placeholder="Title Of Book" name="Title" value="{{ $book->Title }}" >
                                    @if($errors->has('Title'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Title') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label > Author</label>
                                    <input type="text" class="form-control{{ $errors->has('Author') ? ' is-invalid' : '' }}" placeholder="Name of  Author" name=" Author" value="{{ $book->Author }}" >
                                    @if($errors->has('Author'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Author') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label >Main Price</label>
                                            <input type="number" class="form-control {{ $errors->has('Main_price') ? ' is-invalid' : '' }}" placeholder="Main Price" name="Main_price" value="{{ $book->Main_price }}" >
                                            @if($errors->has('Main_price'))
                                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Main_price') }}</strong>
                        </span>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label >Discount price</label>
                                            <input type="number" class="form-control {{ $errors->has('Discount_price') ? ' is-invalid' : '' }} " placeholder="Discount price" name="Discount_price" value="{{ $book->Discount_price }}" >
                                            @if($errors->has('Discount_price'))
                                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Discount_price') }}</strong>
                        </span>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label >Main Categories</label>
                                            <select  id="select" class="form-control" name="main_id" onchange="show(this)">
                                                <option value="">Select</option>
                                                @foreach($maincategory as $main)
                                                    <option value="{{$main->id}}" @if($book->main_id == $main->id)selected @endif>{{$main->main_category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label >Sub Categories</label>
                                            <select class="form-control" id="model" name="sub_id" onchange="show2(this)">
                                                <option value="">Select</option>
                                                @foreach($subcategory as $key=> $sub)
                                                    @if($sub->main_id == $book->main_id)
                                                    <option value="{{$sub->id}}" @if($book->sub_id == $sub->id)selected @endif>{{$sub->sub_category}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label >Mini Categories</label>
                                            <select  id="mini"class="form-control {{ $errors->has('Categories') ? ' is-invalid' : '' }}"  name="mini_id">
                                                <option value="">Select</option>
                                                @foreach($minicategory as $mini)
                                                    @if($mini->sub_id == $book->sub_id)
                                                    <option value="{{$mini->id}}" @if($book->mini_id == $mini->id)selected @endif>{{$mini->mini_category}}</option>
                                                @endif
                                                        @endforeach

                                            </select>
                                            @if($errors->has('Categories'))
                                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Categories') }}</strong>
                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label >Description</label>
                                    <textarea rows="10" cols="50" type="text" class="form-control  {{ $errors->has('Description') ? ' is-invalid' : '' }}" placeholder="Description" name="Description"  ></textarea>
                                    @if($errors->has('Description'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Description') }}</strong>
                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Upload image</label>
                                    <input type="file" class="form-control-file  {{ $errors->has('Image') ? ' is-invalid' : '' }}" name="Image" value="{{$book->Image}}">
                                    @if($errors->has('Image'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Image') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Upload File</label>
                                    <input type="file" class="form-control-file  {{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" value="{{$book->file}}">
                                    @if($errors->has('file'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success">Success</button>
                            </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script  type="text/javascript">

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        function show(thisObj)
        {
            var main_id = $(thisObj).val();
            if (main_id) {
                $.ajax({
                    type: 'GET',
                    url: '/ebook-admin/subcategory/' + main_id,
                    dataType: 'json',
                    success: function (data) {
                        $('#model').empty();
                        $.each(data, function(key, element) {

                            $('#model').append("<option value='" +element.id +"'>" + element.sub_category + "</option>");
                            $('#model').prepend("<option value=''>Select</option>");

                        });
                        show2();
                    }
                });
            }
        }
        function show2()
        {
            var sub_id = $('#model').val();
            if (sub_id) {
                $.ajax({
                    type: 'GET',
                    url: '/ebook-admin/minicategory/' + sub_id,
                    dataType: 'json',
                    success: function (data) {
                        $('#mini').empty();
                        $.each(data, function (key, element) {

                            $('#mini').append("<option value='" + element.id + "'>" + element.mini_category + "</option>");
                            $('#mini').prepend("<option value=''>Select</option>");
                        });

                    }
                });
            }
        }
    </script>

@endsection
