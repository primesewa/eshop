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
                <li class="breadcrumb-item active">Edit mini Category</li>
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
                    <h3>Edit Mini Category</h3>
                    <form action="{{route('mini.update',[$minicategory->id])}}" method="post">
                        @csrf
                        <input name ="_method" type="hidden" value="put">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub Category</label>
                                    <select  id="select"class="form-control {{ $errors->has('sub_id') ? ' is-invalid' : '' }}"  name="sub_id">
                                        <option value="">Select</option>
                                        @foreach($subcategory as $sub )
                                            <option value="{{$sub->id}}" @if($minicategory->sub_id==$sub->id) selected @endif>{{$sub->sub_category}}</option>
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
                                    <input type="text" class="form-control{{ $errors->has('mini_category') ? ' is-invalid' : '' }}" placeholder="Enter Mini-Category" name="mini_category" value="{{$minicategory->mini_category}}" >
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
                                    <input type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Enter Price" name="price" value="{{$minicategory->price }}" >
                                    @if($errors->has('price'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('price') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label >Currency</label>
                                            <select  id="select" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency" value="{{$minicategory->currency}}">
                                                <option value="">Select</option>
                                                <option value="$" @if($minicategory->currency=='$')selected @endif>USD($)</option>
                                                <option value="Rs" @if($minicategory->currency=='Rs')selected @endif>Nepali(rupee)</option>
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

                                        <option value="7" @if($minicategory->expire_date == 7) selected @endif>Week</option>
                                        <option value="15" @if($minicategory->expire_date == 15) selected @endif>Half a month</option>
                                        <option value="30" @if($minicategory->expire_date == 30) selected @endif>A month</option>
                                        <option value="90" @if($minicategory->expire_date == 90) selected @endif>A 3 month</option>
                                        <option value="180" @if($minicategory->expire_date == 180) selected @endif>A 6 month</option>
                                        <option value="240" @if($minicategory->expire_date == 240) selected @endif>A 8 month</option>
                                        <option value="360" @if($minicategory->expire_date == 360)selected @endif>A year</option>
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
                </div>
            </div>
        </div>
    </div>

@endsection



