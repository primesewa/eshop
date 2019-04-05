@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">users</li>
                <li class="breadcrumb-item active">Edit user</li>
            </ol>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <h3>Edit user</h3>
                    <form action="{{route('admins.update',[$admin->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name ="_method" type="hidden" value="PUT">
                        <div class="row">
                            <div class="col-md-12">
                        <div class="form-group">
                            <label>username</label>
                            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="username" name="username" value=" {{$admin->username}}" >
                            @if($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                            @endif
                        </div>
                            </div>
                            <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                            <div class="form-group">
                                <label > first name</label>
                                <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="first_name" name="first_name" value="{{$admin->first_name}}" >
                                @if($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                                @endif
                            </div>
                                </div>

                                <div class="col-md-4">
                            <div class="form-group">
                                <label >last Name</label>
                                <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="last name" name="last_name" value="{{$admin->last_name}}" >
                                @if($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                                @endif

                            </div>
                                </div>

                                <div class="col-md-4">
                            <div class="form-group">
                                <label >nick Name</label>
                                <input type="text" class="form-control {{ $errors->has('nick_name') ? ' is-invalid' : '' }} " placeholder="nick Name" name="nick_name" value="{{$admin->nick_name}}" >
                                @if($errors->has('nick_name'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('nick_name') }}</strong>
                        </span>
                                @endif
                            </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label >email</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email" name="email" value="{{$admin->email}}" >
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                @endif

                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label >Change password</label>
                                <input  type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password" name="password" value="{{ old('password') }}"  ></input>
                                @if($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>role</label>
                                <select  id="select"class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}"  name="role">

                                    @foreach($roles as $role)
                                        <option value="{{$role->Name}}">{{$role->Name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('role'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
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
                        </div>
                        <center>
                            <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>                        </center>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="javascript">
        $(document).ready(function() {
            $('#select').select2();
        });
    </script>
@endsection
