@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Home Section</li>

                <li class="breadcrumb-item active">Icon</li>

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

                    <h3>Add Icon</h3>
                    <form  action="{{route('icon.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label >Upload image</label>
                            <input type="file" class="form-control-file  {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">


                            @if($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    <br>
                    <h2>Icons</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Icons</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        @foreach ($icon as $ic)

                            <tbody>
                            <tr>
                                <td>{{++$i}}</td>
                                <td> <img src="/storage/image/{{$ic->image}}" style="width: 50px; hight:10px;"></td>


                                <td>
                                    <form method="post" action="{{route('icon.delete',[$ic->id])}}">
                                        @csrf
                                        <input name ="_method" type="hidden" value="DELETE">
                                        <button onclick="return confirm('Are you sure want to delete this Icon?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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

