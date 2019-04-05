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
                    <li class="breadcrumb-item active">Contact Information</li>
                    <li class="breadcrumb-item active">show contact info</li>
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
                {{--<div style="padding-left: 30px;">--}}
                    {{--@foreach ($contacts as $c)--}}

                        {{--<h5>Address: {{$c->address}}</h5>--}}
                        {{--<h5>Phone no: {{$c->phonenumber}}</h5>--}}
                        {{--<h5>Email: {{$c->email}}</h5>--}}
                        {{--<h5>Website Address: {{$c->name}}</h5>--}}
                        {{--<h5>Facebook Address: {{$c->facebook}}</h5>--}}
                        {{--<h5>Twitter Address: {{$c->twitter}}</h5>--}}
                        {{--<h5>Gmail Address: {{$c->gmail}}</h5>--}}
                        {{--<h5>Youtube Address: {{$c->youtube}}</h5>--}}
                        {{--<h5>Linkedin Address: {{$c->linkedin}}</h5>--}}
                        {{--<h5>About Us: {{$c->about_us}}</h5>--}}
                        {{--<h5>Office Info: {{$c->office_info}}</h5>--}}
                        {{--<h5>Introduction: {{$c->introduction}}</h5>--}}
                    {{--@endforeach--}}

                {{--</div>--}}

                <h2>Contact info</h2>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Address</th>
                        <th>Phone no</th>
                        <th>Email</th>
                        <td>About Us</td>
                        <th>Office info</th>
                        <th>Introduction</th>

                    </tr>
                    </thead>
                    @foreach ($contacts as $c)

                        <tbody>
                        <tr>

                            <td>{{$c->address}}</td>
                            <td>{{$c->phonenumber}}</td>
                            <td>{{$c->email}}</td>
                            <td>{{$c->about_us}}</td>
                            <td>{{$c->office_info}}</td>
                            <td>{{$c->introduction}}</td>
                        </tr>

                        </tbody>
                    @endforeach
                </table>
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Website address</th>
                            <th>Facebook</th>
                            <th>Twitter</th>
                            <th>Linkedin</th>
                            <th>Youtube</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        @foreach ($contacts as $c)

                            <tbody>
                            <tr>
                                <td>{{$c->name}}</td>
                                <td>{{$c->facebook}}</td>
                                <td>{{$c->twitter}}</td>
                                <td>{{$c->linkedin}}</td>
                                <td>{{$c->youtube}}</td>
                                <td> <a href="{{route('contact.edit',[$c->id])}}"class="btn btn-primary ">Edit</a></td>
                                <td>
                                   <h6>delete</h6>
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
