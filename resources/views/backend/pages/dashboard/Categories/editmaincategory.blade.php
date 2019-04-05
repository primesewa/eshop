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
                <li class="breadcrumb-item active">Edit Main Category</li>
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

                    <h3>Edit Main Category</h3>
                    <form action="{{route('main.update',[$maincategory->id])}}" method="post">
                        @csrf
                        <input name ="_method" type="hidden" value="put">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Main category
                                    </label>
                                    <input type="text" class="form-control{{ $errors->has('main_category') ? ' is-invalid' : '' }}" placeholder="Main Category" name="main_category" value="{{ $maincategory->main_category }}" >
                                    @if($errors->has('main_category'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('main_category') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="number" min="0" max="10" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" placeholder="Position of main category" name="position" value="{{ $maincategory->position }}" >
                                    @if($errors->has('position'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('position') }}</strong>
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

