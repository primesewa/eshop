@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Books</li>
                <li class="breadcrumb-item active">Add Book</li>
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
            </div>

                    <h3>Add Books</h3>
                <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control{{ $errors->has('Title') ? ' is-invalid' : '' }}" placeholder="Title Of Book" name="Title" value="{{ old('Title') }}" >
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
                        <input type="text" class="form-control{{ $errors->has('Author') ? ' is-invalid' : '' }}" placeholder="Name of  Author" name=" Author" value="{{ old('Author') }}" >
                        @if($errors->has('Author'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Author') }}</strong>
                        </span>
                        @endif
                    </div>
                    </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Expire date</label>
                                <select  id="select" class="form-control{{ $errors->has('expire_date') ? ' is-invalid' : '' }}" name="expire_date">
                                    <option value="">Select</option>

                                    <option value="7">Week</option>
                                    <option value="15">Half a month</option>
                                    <option value="30">A month</option>
                                    <option value="90">A 3 month</option>
                                    <option value="180">A 6 month</option>
                                    <option value="240">A 8 month</option>
                                    <option value="365">A year</option>
                                </select>
                                @if($errors->has('expire_date'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expire_date') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Vendor name</label>
                                <select  id="select" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name">
                                    <option value="">Select</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                    @endforeach

                                </select>
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                        <div class="col-md-4">
                    <div class="form-group">
                        <label >Main Price</label>
                        <input type="number" class="form-control {{ $errors->has('Main_price') ? ' is-invalid' : '' }}" placeholder="Main Price" name="Main_price" value="{{ old('Main_price') }}" >
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
                        <input type="number" class="form-control {{ $errors->has('Discount_price') ? ' is-invalid' : '' }} " placeholder="Discount price" name="Discount_price" value="{{ old('Discount_price') }}" >
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
                                <select  id="select" class="form-control{{ $errors->has('sub_id') ? ' is-invalid' : '' }}" name="main_id" onchange="show(this)">
                                    <option value="">Select</option>
                                    @foreach($maincategory as $main)
                                            <option value="{{$main->id}}">{{$main->main_category}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('main_id'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('main_id') }}</strong>
                        </span>
                                @endif
                            </div>
                            </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label >Sub Categories</label>
                                    <select class="form-control {{ $errors->has('sub_id') ? ' is-invalid' : '' }}" id="model" name="sub_id" onchange="show2(this)">
                                        <option value="">Select</option>
                                    </select>
                                    @if($errors->has('sub_id'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sub_id') }}</strong>
                        </span>
                                    @endif
                                </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                    <label >Mini Categories</label>
                                    <select  id="mini"class="form-control {{ $errors->has('mini_id') ? ' is-invalid' : '' }}"  name="mini_id">
                                        <option value="">Select</option>

                                    </select>
                                    @if($errors->has('mini_id'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mini_id') }}</strong>
                        </span>
                                    @endif
                                </div>
                                </div>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-12">
                    <div class="form-group">
                        <label >Description</label>
                        <textarea  id="mytextarea" rows="10" cols="50"  class="form-control{{ $errors->has('Description') ? ' is-invalid' : '' }}" placeholder="Description" name="Description" value="{{ old('Description') }}" ></textarea>
                        @if($errors->has('Description'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Description') }}</strong>
                        </span>
                        @endif

                    </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Upload image</label>
                                <input type="file" class="form-control-file  {{ $errors->has('Image') ? ' is-invalid' : '' }}" name="Image">


                                @if($errors->has('Image'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Image') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Upload file</label>
                                <input type="file" class="form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" name="file">
                                @if($errors->has('file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                                {{--<div class="col-md-6">--}}
                                    {{--<div class="form-group">--}}
                                        {{--<label >Upload images<span> <small>(can upload more than one image)</small></span></label>--}}
                                        {{--<input type="file" class="form-control{{ $errors->has('images') ? ' is-invalid' : '' }}" name="images[]" multiple="multiple">--}}
                                        {{--@if($errors->has('images'))--}}
                                            {{--<span class="invalid-feedback" role="alert">--}}
                                                {{--<strong>{{ $errors->first('images') }}</strong>--}}
                                            {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6">
                                    <div class="form-group" id="drop">
                                        <label >Books</label>
                                        <select id="select2"  class="form-control {{ $errors->has('tag') ? ' is-invalid' : '' }}"  name="tag[]" multiple="multiple">
                                        </select>
                                        @if($errors->has('tag'))
                                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tag') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Currency</label>
                                        <select  id="select" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency"  >
                                            <option value="">Select</option>
                                                <option value="$">USD($)</option>
                                                 <option value="Rs" selected>Nepali(rupee)</option>
                                        </select>
                                        @if($errors->has('currency'))
                                            <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('currency') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Feature</label>
                                        <select  id="select" class="form-control{{ $errors->has('feature') ? ' is-invalid' : '' }}" name="feature">
                                            <option value="">Select</option>

                                            <option value="Hot" selected>Hot</option>
                                            <option value="Best seller">Best Seller</option>
                                            <option value="Top Feature">Top Feature</option>


                                        </select>
                                        @if($errors->has('feature'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('feature') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>
                                </div>
                            </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
        </div>

@endsection
@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <style>
        .row{
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
    <link href="{{url('css/skin.min.css')}}" rel="stylesheet">
    <link href="{{url('css/content.min.css ')}}" rel="stylesheet">
    <link href="{{url('css/extra/content.min.css ')}}" rel="stylesheet">
@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#select2').select2(
                {
                    dropdownParent: $('#drop'),
                    placeholder:'Enter tags',
                    tags: true,
                    tokenSeparators: [',', ' ']
                }
            );

        });
    </script>
    {{--<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>--}}
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

                                });

                            }
                        });
                    }
        }
    </script>
    <script src="{{asset('js/tinymce.min.js')}}"></script>
    <script src="{{asset('js/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('js/theme.min.js')}}"></script>


    <script>

        tinymce.init({
            selector: '#mytextarea'
        });

    </script>
    @endsection


