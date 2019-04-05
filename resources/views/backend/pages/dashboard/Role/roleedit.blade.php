@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Role</li>
                <li class="breadcrumb-item active">Add Role</li>
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

                    <h3>Add Role</h3>
                    <form action="{{route('role.update',[$role->id])}}" method="post">
                        @csrf
                        <input name ="_method" type="hidden" value="put">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role
                                    </label>
                                    <input type="text" class="form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" placeholder="Role" name="Name" value="{{ $role->Name }}" >
                                    @if($errors->has('Name'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('Name') }}</strong>
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

                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

