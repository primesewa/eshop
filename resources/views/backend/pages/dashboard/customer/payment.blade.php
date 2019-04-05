@extends('backend.main-master.main-master')
@section('content')
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Payment</li>
        </ol>

        <!-- Page Content -->
        <h1>Wellcome</h1>
        <hr>
        <p>customer Payment.</p>

    </div>
</div>
@endsection
