@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Add Vendor</li>

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
                    <h3>Add Vendor</h3>
                    <form  action="{{route('fake.vendor.create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="name" name="name" value="{{ old('name') }}" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <h2>Vendor</h2>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Vendor</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendor as $t)
                            <tr>
                                <td> {{$t->name}}</td>
                                <td>
                                    <form method="post" action="{{route('fake.vendor.delete',[$t->id])}}">
                                        @csrf
                                        <input name ="_method" type="hidden" value="DELETE">
                                        <button onclick="return confirm('Are you sure want to delete this Vendor ?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

