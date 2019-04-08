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
                <li class="breadcrumb-item active">Add Home Section</li>

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
                    <form  action="{{route('vendor.section.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Section Title " name="title" value="{{ old('title') }}" >
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
                                    <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Section Description" name=" description" value="{{ old('description') }}" >
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group" id="drop">
                                    <label >Books</label>
                                    <select id="select"  class="form-control {{ $errors->has('vendor_id') ? ' is-invalid' : '' }}"  name="vendor_id[]" multiple="multiple">
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->Title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('vendor_id'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('vendor_id') }}</strong>
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
