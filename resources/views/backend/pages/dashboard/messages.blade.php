@extends('backend.main-master.main-master')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Contact Info</li>
                <li class="breadcrumb-item active"> Message</li>

            </ol>

            <div class="row">

                <div class="container">
                    <h2>Customer Message</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                        </thead>
                        @foreach($messages as $message)
                        <tbody>
                        <tr>
                            <td>{{$message->firstname}} {{$message->lastname}}</td>
                            <td>{{$message->email}}</td>
                            <td>{{$message->website}}</td>
                            <td>{{$message->subject}}</td>
                            <td>{{$message->message}}</td>
                        </tr>
                        </tbody>
                            @endforeach
                    </table>
                </div>

    </div>
@endsection
@section('style')
    <style>
        #d
        {

            margin-left: 200px;
            margin-bottom: 500px;
        }
    </style>
@endsection
