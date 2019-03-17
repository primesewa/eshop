@extends('backend.main-master.main-master')
@section('content')
    <div id="content-wrapper">
        <div class="row justify-content-center">

            <div class="container-fluid col-12">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Users</li>
                    <li class="breadcrumb-item active">Show Users</li>
                </ol>
                <div id="message">
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

                </div>

                <h2>Users</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Nick_name</th>
                        <th> Email</th>
                        <th>Role</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    @foreach ($admins as $admin)

                        <tbody>
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$admin->Username}}</td>
                            <td>{{$admin->First_name}}</td>
                            <td>{{$admin->Last_name}}</td>
                            <td>{{$admin->Nick_name}}</td>
                            <td>{{$admin->Email}}</td>
                            <td>{{$admin->Role}}</td>
                            <td> <img src="/storage/image/{{$admin->Image}}" style="width: 50px; hight:10px;"></td>

                            <td><a href="{{route('admins.edit',[$admin->id])}}"><span><i class="fas fa-edit"></i></span></a></td>

                            <td>
                                <form method="post" action="{{route('admins.destroy',[$admin->id])}}">
                                    @csrf
                                    <input name ="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                </form>
                            </td>


                        </tr>

                        </tbody>
                    @endforeach
                </table>
                {{$admins->render()}}
            </div>


        </div>
    </div>
@endsection
@section('style')
    <style>
        #message{
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
@endsection
