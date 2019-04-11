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
                <li class="breadcrumb-item active">Add Main Category</li>
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

                <h3>Add Main Category</h3>
                    <form action="{{route('main.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Main category
                                    </label>
                                    <input type="text" class="form-control{{ $errors->has('main_category') ? ' is-invalid' : '' }}" placeholder="Main Category" name="main_category" value="{{ old('main_category') }}" >
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
                                    <input type="number" min="0" max="50" class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" placeholder="Position of main category" name="position" value="{{ old('position') }}" >
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
                    <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Main category</h3>
                                </div>
                                <div class="col-md-6" style="padding-left: 200px;">
                                    <form class="form-inline my-2 my-lg-0" method="get" action="{{route('main.category.search')}}">
                                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                                        <button class="btn btn-primary">search</button>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Main category</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                @foreach($maincategory as $main)
                                <tbody>
                                <tr>

                                        <td>{{++$i}}</td>
                                    <td>
                                       {{$main->main_category}}
                                    </td>
                                    <td> <form method="post" action="{{route('main.conform',[$main->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="put">

                                            @if($main->confirmed == 1)
                                                <button class="btn btn-success"><i class="far fa-check-circle"></i></button>
                                            @endif
                                            @if($main->confirmed == 0)
                                                <button class="btn btn-danger"><i class="far fa-times-circle"></i></button>
                                            @endif

                                        </form></td>
                                    <td><a href="{{route('main.edit',[$main->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a> </td>
                                <td>
                                    <form method="post" action="{{route('main.delete',[$main->id])}}">
                                        @csrf
                                        <input name ="_method" type="hidden" value="DELETE">
                                        <button onclick="return confirm('Are you sure want to delete this category?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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
    </div>

@endsection

