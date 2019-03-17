@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Category</li>
                <li class="breadcrumb-item active">Add Sub Category</li>
            </ol>
            <div class="row justify-content-center">
                <div class="col-md-9">
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
                <div class="col-md-9">
                    <h3>Add sub Category</h3>
                    <form action="{{route('sub.store')}}" method="post">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Main Category</label>
                            <select  id="select"class="form-control {{ $errors->has('main_id') ? ' is-invalid' : '' }}"  name="main_id">
                                <option value="">Select</option>
                                @foreach($maincategory as $main)
                                    <option value="{{$main->id}}">{{$main->main_category}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('main_category'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('main_id') }}</strong>
                        </span>
                            @endif
                        </div>
                        </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Sub category
                            </label>
                            <input type="text" class="form-control{{ $errors->has('sub_category') ? ' is-invalid' : '' }}" placeholder="Enter Sub-Category" name="sub_category" value="{{ old('sub_category') }}" >
                            @if($errors->has('sub_category'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sub_category') }}</strong>
                        </span>
                            @endif
                        </div>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                        </center>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

