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
                <li class="breadcrumb-item active">Add user</li>
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

                    <h3>Add user</h3>
                    <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>username</label>
                                    <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="username" name="username" value="{{ old('username') }}" >
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
                                    <input type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="first_name" name="first_name" value="{{ old('first_name') }}" >
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
                                            <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="last name" name="last_name" value="{{ old('last_name') }}" >
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
                                            <input type="text" class="form-control {{ $errors->has('nick_name') ? ' is-invalid' : '' }} " placeholder="nick Name" name="nick_name" value="{{ old('nick_name') }}" >
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
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email" name="email" value="{{ old('email') }}" >
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >password</label>
                                    <input  type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="password" name="password" value="{{ old('password') }}" ></input>
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
                                        <select  id="select"class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}"   name="role">
                                            <option value="">Select</option>
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


                                <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>

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

@section('style')
    <style>
        body{
            background-color: #F4F6F7 ;
        }
        input[type="text"], textarea {
            background-color : #FBFCFC;
        }
        input[type="number"], textarea {
            background-color : #FBFCFC;
        }
        input[type="password"], textarea {
            background-color : #FBFCFC;
        }
        input[type="email"], textarea {
            background-color : #FBFCFC;
        }
        select {
            background-color : #FBFCFC;
        }

    </style>
@endsection
