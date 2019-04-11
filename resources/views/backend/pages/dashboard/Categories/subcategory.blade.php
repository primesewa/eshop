@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Category</li>
                <li class="breadcrumb-item active">Add Sub Category</li>
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
                </div>
                <div class="col-md-12">
                    <h3>Add sub Category</h3>
                    <form action="{{route('sub.store')}}" method="post">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label>Main Category</label>
                            <select  id="select"class="form-control {{ $errors->has('main_id') ? ' is-invalid' : '' }}"  name="main_id">
                                <option value="">Select</option>
                                @foreach($maincategory as $main)
                                    <option value="{{$main->id}}">{{$main->main_category}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('main_category'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('main_id') }}</strong>
                        </span>
                            @endif
                        </div>
                        </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Sub category
                            </label>
                            <input type="text" class="form-control{{ $errors->has('sub_category') ? ' is-invalid' : '' }}" placeholder="Enter Sub-Category" name="sub_category" value="{{ old('sub_category') }}" >
                            @if($errors->has('sub_category'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sub_category') }}</strong>
                        </span>
                            @endif
                        </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Price
                                            </label>
                                            <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter Price" name="price" value="{{ old('price') }}" >
                                            @if($errors->has('price'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label >Currency</label>
                                            <select  id="select" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency"  >
                                                <option value="">Select</option>
                                                <option value="$">USD($)</option>
                                                <option value="Rs" selected>Nepali(rupee)</option>
                                            </select>
                                            @if($errors->has('currency'))
                                                <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('currency') }}</strong>
                                             </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Expire date</label>
                                    <select  id="select" class="form-control{{ $errors->has('expire_date') ? ' is-invalid' : '' }}" name="expire_date">
                                        <option value="">Select</option>

                                        <option value="7">Week</option>
                                        <option value="15">Half a month</option>
                                        <option value="30">A month</option>
                                        <option value="90">A 3 month</option>
                                        <option value="180">A 6 month</option>
                                        <option value="240">A 8 month</option>
                                        <option value="365">A year</option>
                                    </select>
                                    @if($errors->has('expire_date'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('expire_date') }}</strong>
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
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Sub category</h3>
                            </div>
                            <div class="col-md-6" style="padding-left: 200px;">
                                <form class="form-inline my-2 my-lg-0" method="get" action="{{route('sub.category.search')}}">
                                    <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-primary">search</button>
                                </form>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Sub category</th>
                                <th>Main Category</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>Expire After</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            @foreach($subcategory as $sub)
                                <tbody>
                                <tr>

                                    <td>{{++$i}}</td>
                                    <td>
                                        {{$sub->sub_category}}
                                    </td>
                                    <td>
                                        @foreach($maincategory as $main)
                                            @if($main->id == $sub->main_id)
                                        {{$main->main_category}}
                                            @endif
                                            @endforeach
                                    </td>
                                    <td>{{$sub->price}}</td>
                                    <td>{{$sub->currency}}</td>
                                    <td>{{$sub->expire_date}} days</td>
                                    <td> <form method="post" action="{{route('sub.conform',[$sub->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="put">

                                            @if($sub->confirmed == 1)
                                                <button class="btn btn-success"><i class="far fa-check-circle"></i></button>
                                            @endif
                                            @if($sub->confirmed == 0)
                                                <button class="btn btn-danger"><i class="far fa-times-circle"></i></button>
                                            @endif

                                        </form></td>
                                    <td><a href="{{route('sub.edit',[$sub->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a> </td>
                                    <td>
                                        <form method="post" action="{{route('sub.delete',[$sub->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="DELETE">
                                            <button onclick="return confirm('Are you sure want to delete this Category?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                        </form>
                                    </td>
                                </tr>

                                </tbody>
                            @endforeach
                            {{ $subcategory->links() }}

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

