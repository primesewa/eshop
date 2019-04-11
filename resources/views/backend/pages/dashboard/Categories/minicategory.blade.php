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
                <li class="breadcrumb-item active">Add mini Category</li>
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
                    <h3>Add Mini Category</h3>
                    <form action="{{route('mini.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select  id="select"class="form-control {{ $errors->has('sub_id') ? ' is-invalid' : '' }}"  name="sub_id">
                                        <option value="">Select</option>
                                            @foreach($subcategory as $sub )
                                                        <option value="{{$sub->id}}">{{$sub->sub_category}}</option>
                                                @endforeach
                                    </select>
                                    @if($errors->has('main_category'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('sub_id') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mini category
                                    </label>
                                    <input type="text" class="form-control{{ $errors->has('mini_category') ? ' is-invalid' : '' }}" placeholder="Enter Mini-Category" name="mini_category" value="{{ old('mini_category') }}" >
                                    @if($errors->has('mini_category'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('mini_category') }}</strong>
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
                                <h3>Mini category</h3>
                            </div>
                            <div class="col-md-6" style="padding-left: 200px;">
                                <form class="form-inline my-2 my-lg-0" method="get" action="{{route('mini.category.search')}}">
                                    <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-primary">search</button>
                                </form>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Mini category</th>
                                <th>Sub Category</th>
                                <th>Price</th>
                                <th>Currency</th>
                                <th>Status</th>
                                <th>Expire After</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>

                            @foreach($minicategory as $mini)
                                <tbody>
                                <tr>

                                    <td>{{++$i}}</td>
                                    <td>
                                        {{$mini->mini_category}}
                                    </td>
                                    <td>
                                        @foreach($subcategory as $sub )
                                           @if($sub->id == $mini->sub_id)
                                               {{$sub->sub_category}}
                                            @endif
                                            @endforeach
                                    </td>
                                    <td>{{$mini->price}}</td>
                                    <td>{{$mini->currency}}</td>
                                    <td> <form method="post" action="{{route('mini.conform',[$mini->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="put">

                                            @if($mini->confirmed == 1)
                                                <button class="btn btn-success"><i class="far fa-check-circle"></i></button>
                                            @endif
                                            @if($mini->confirmed == 0)
                                                <button class="btn btn-danger"><i class="far fa-times-circle"></i></button>
                                            @endif

                                        </form></td>
                                    <td>{{$mini->expire_date}} days</td>

                                    <td><a href="{{route('mini.edit',[$mini->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a> </td>
                                    <td>
                                        <form method="post" action="{{route('mini.delete',[$mini->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="DELETE">
                                            <button onclick="return confirm('Are you sure want to delete this Category?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                        </form>
                                    </td>
                                </tr>

                                </tbody>
                            @endforeach
                            {{ $minicategory->links() }}

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



