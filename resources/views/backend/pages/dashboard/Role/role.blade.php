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
                    <form action="{{route('role.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Role
                                    </label>
                                    <input type="text" class="form-control{{ $errors->has('Name') ? ' is-invalid' : '' }}" placeholder="Role" name="Name" value="{{ old('Name') }}" >
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
                    <div class="container">
                        <h2>Role</h2>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($roles as $role)
                                <tbody>
                                <tr>

                                    <td>{{++$i}}</td>
                                    <td>
                                        {{$role->Name}}
                                    </td>
                                    <td><a href="{{route('role.edit',[$role->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a> </td>
                                    <td>
                                        <form method="post" action="{{route('role.delete',[$role->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="DELETE">
                                            <button onclick="return confirm('Are you sure want to delete this role?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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

