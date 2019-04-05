@extends('backend.main-master.main-master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Customer</li>
        </ol>

        <!-- Page Content -->

        <div class="container">
            <h2>Customer list</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
                </thead>
                @foreach($users as $user)
                <tbody>
                <tr>
                    <td><a href="{{route('customer.show',[$user->id])}}">{{$user->name}}</a></td>
                    <td><a href="{{route('customer.show',[$user->id])}}">{{$user->username}}</a></td>
                    <td><a href="{{route('customer.show',[$user->id])}}">{{$user->email}}</a></td>
                </tr>
                </tbody>
                    @endforeach
            </table>
        </div>

    </div>
</div>
@endsection
