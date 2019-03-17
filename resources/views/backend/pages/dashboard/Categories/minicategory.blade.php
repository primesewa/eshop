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
                <div class="col-md-9">
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



