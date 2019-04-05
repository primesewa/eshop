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
                <li class="breadcrumb-item active">Add Demo books</li>

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

                    <h3>Add Demo Books</h3>
                    <form  action="{{route('demo.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="title Of Book" name="title" value="{{ old('title') }}" >
                                    @if($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
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
                            <th>Title</th>
                            <th>File</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        @foreach($demos as $demo)
                            <tbody>
                            <tr>
                           <td>{{$demo->title}}</td>
                            <td>{{$demo->file}}</td>
                                <td>
                                    <form method="post" action="{{route('demo.delete',[$demo->id])}}">
                                        @csrf
                                        <input name ="_method" type="hidden" value="DELETE">
                                        <button onclick="return confirm('Are you sure want to delete this Demo File?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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

