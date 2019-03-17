@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Users</li>
                <li class="breadcrumb-item active">Edit User</li>
            </ol>
            <div class="row justify-content-center">

                <div class="col-md-12">
                    <h3>Edit User</h3>
                    <form action="{{route('admins.update',[$admin->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input name ="_method" type="hidden" value="PUT">
                        <div class="row">
                            <div class="col-md-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control{{ $errors->has('Username') ? ' is-invalid' : '' }}" placeholder="Username" name="Username" value=" {{$admin->Username}}" >
                            @if($errors->has('Username'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Username') }}</strong>
                        </span>
                            @endif
                        </div>
                            </div>
                            <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                            <div class="form-group">
                                <label > First name</label>
                                <input type="text" class="form-control{{ $errors->has('First_name') ? ' is-invalid' : '' }}" placeholder="First_name" name="First_name" value="{{$admin->First_name}}" >
                                @if($errors->has('First_name'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('First_name') }}</strong>
                        </span>
                                @endif
                            </div>
                                </div>

                                <div class="col-md-4">
                            <div class="form-group">
                                <label >Last Name</label>
                                <input type="text" class="form-control {{ $errors->has('Last_name') ? ' is-invalid' : '' }}" placeholder="Last name" name="Last_name" value="{{$admin->Last_name}}" >
                                @if($errors->has('Last_name'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Last_name') }}</strong>
                        </span>
                                @endif

                            </div>
                                </div>

                                <div class="col-md-4">
                            <div class="form-group">
                                <label >Nick Name</label>
                                <input type="text" class="form-control {{ $errors->has('Nick_name') ? ' is-invalid' : '' }} " placeholder="Nick Name" name="Nick_name" value="{{$admin->Nick_name}}" >
                                @if($errors->has('Nick_name'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Nick_name') }}</strong>
                        </span>
                                @endif
                            </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" class="form-control {{ $errors->has('Email') ? ' is-invalid' : '' }}" placeholder="Email" name="Email" value="{{$admin->Email}}" >
                                @if($errors->has('Email'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Email') }}</strong>
                        </span>
                                @endif

                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label >Change Password</label>
                                <input  type="password" class="form-control{{ $errors->has('Password') ? ' is-invalid' : '' }}" placeholder="Password" name="Password" value="{{ old('Password') }}"  ></input>
                                @if($errors->has('Password'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Password') }}</strong>
                        </span>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select  id="select"class="form-control {{ $errors->has('Role') ? ' is-invalid' : '' }}"  name="Role">

                                    @foreach($roles as $role)
                                        <option value="{{$role->Name}}">{{$role->Name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('Role'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Role') }}</strong>
                        </span>
                                @endif
                            </div>
                            </div>

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
                        </div>
                        <center>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </center>


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
