@extends('backend.main-master.main-master')
@section('content')
    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">contact Information</li>
                <li class="breadcrumb-item active">Team Info</li>

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

                <h3>Contact Information</h3>
                <form action="{{route('contact.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>address</label>
                                <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="address Of Book" name="address" value="{{ old('address') }}" >
                                @if($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('address') }}</strong>
                                     </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label > phonenumber</label>
                                <input type="number" class="form-control{{ $errors->has('phonenumber') ? ' is-invalid' : '' }}" placeholder="Name of  phonenumber" name=" phonenumber" value="{{ old('phonenumber') }}" >
                                @if($errors->has('phonenumber'))
                                    <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('phonenumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Email Address</label>
                                <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Main Price" name="email" value="{{ old('email') }}" >
                                @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('email') }}</strong>
                                             </span>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label > Website address</label>
                                <input type="url" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} " placeholder="Discount price" name="name" value="{{ old('name') }}" >
                                @if($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('name') }}</strong>
                                             </span>
                                @endif

                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Facebook links </label>
                                <input type="url" class="form-control {{ $errors->has('facebook') ? ' is-invalid' : '' }} " placeholder="facebook" name="facebook" value="{{ old('facebook') }}" >
                                @if($errors->has('facebook'))
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('facebook') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >Twitter link</label>
                                <input type="url" class="form-control {{ $errors->has('twitter') ? ' is-invalid' : '' }} " placeholder="twitter" name="twitter" value="{{ old('twitter') }}" >

                                @if($errors->has('twitter'))
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('twitter') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >gmail link</label>
                                <input type="url" class="form-control {{ $errors->has('gmail') ? ' is-invalid' : '' }} " placeholder="gmail" name="gmail" value="{{ old('gmail') }}" >

                                @if($errors->has('gmail'))
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('gmail') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >youtube link</label>
                                <input type="url" class="form-control {{ $errors->has('youtube') ? ' is-invalid' : '' }} " placeholder="youtube" name="youtube" value="{{ old('youtube') }}" >

                                @if($errors->has('youtube'))
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('youtube') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label >linkedin link</label>
                                <input type="url" class="form-control {{ $errors->has('linkedin') ? ' is-invalid' : '' }} " placeholder="linkedin" name="linkedin" value="{{ old('linkedin') }}" >

                                @if($errors->has('linkedin'))
                                    <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('linkedin') }}</strong>
                                             </span>
                                @endif
                            </div>
                        </div>



                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label >About Us</label>
                            <textarea rows="5" cols="50" type="text" class="form-control  {{ $errors->has('about_us') ? ' is-invalid' : '' }}" placeholder="write a short information about e-library" name="about_us" value="{{ old('about_us') }}" ></textarea>
                            @if($errors->has('about_us'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('about_us') }}</strong>
                        </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Introduction</label>
                            <textarea rows="5" cols="50" type="text" class="form-control  {{ $errors->has('introduction') ? ' is-invalid' : '' }}" placeholder="write a brief introduction about e-library" name="introduction" value="{{ old('introduction') }}" ></textarea>
                            @if($errors->has('introduction'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('introduction') }}</strong>
                        </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label >Office Info</label>
                            <textarea rows="5" cols="50" type="text" class="form-control  {{ $errors->has('office_info') ? ' is-invalid' : '' }}" placeholder="write a short information about office" name="office_info" value="{{ old('office_info') }}" ></textarea>
                            @if($errors->has('office_info'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('office_info') }}</strong>
                        </span>
                            @endif

                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .row{
            padding-left: 10px;
            padding-right: 10px;
        }
    </style>
@endsection
