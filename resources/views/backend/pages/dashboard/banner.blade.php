@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add banner</li>

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

                <h3>Add Banner</h3>
                <form  action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>title</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title" name="title" value="{{ old('title') }}" >
                                @if($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label >Upload image</label>
                                <input type="file" class="form-control-file  {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                                @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                    <div class="col-md-12">
                        <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>
                    </div>
                </form>
                        <br>
                        <h2>Banners</h2>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Banner</th>
                                <th>Title</th>
                                <th>Delete</th>

                            </tr>
                            </thead>
                            @foreach ($banner as $ban)

                                <tbody>
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td> <img src="/storage/image/{{$ban->image}}" style="width: 50px; hight:10px;"></td>
                                    <td> {{$ban->title}}</td>
                                    <td>
                                        <form method="post" action="{{route('banner.drop',[$ban->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="DELETE">
                                            <button onclick="return confirm('Are you sure want to delete this product?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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
@endsection

