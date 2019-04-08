@extends('frontend.layouts.user-dashboard')
@section('content')
    <div style="margin-top: 50px;">
    <div class="row">
        <div class="col-md-9">
            <center>
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
            </center>
        </div>
            <div class="col-md-4 col-xs-12">
            <div class="white-box">
                <div class="user-bg">
                    <img width="100%" alt="user" src="{{asset('ample/plugins/images/large/img1.jpg')}}">
                    <div class="overlay-box">
                        <div class="user-content">
                            @if(isset(Auth::user()->pic->image))
                            <a href="javascript:void(0)"><img src="/storage/image/{{Auth::user()->pic->image}}"  class="thumb-lg img-circle" alt="img"></a>
                            @else
                                <a href="javascript:void(0)"><img src="/storage/image/15TiL93a.jpg"  class="thumb-lg img-circle" alt="img"></a>
                            @endif
                                <h4 class="text-white">{{Auth::user()->name}}</h4>
                            <h5 class="text-white">{{Auth::user()->email}}</h5> </div>
                    </div>
                </div>
                <div class="user-btm-box">
                    <div class="col-md-4 col-sm-4 text-center">
                        @if(isset(Auth::user()->pic->image) == null)
                        <form action="{{route('upload.pic')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file  {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                                @if($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Upload</button>
                            </div>
                        </form>

                            @else
                            <form action="{{route('update.pic',[Auth::user()->pic->id])}}" method="post">
                                @csrf
                                <input name ="_method" type="hidden" value="PUT">
                                <div class="form-group">
                                    <input type="file" class="form-control-file  {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image">
                                    @if($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Update Pic</button>
                                </div>
                            </form>
                        @endif
                </div>
            </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-12">
            <div class="white-box">
                <form class="form-horizontal form-material" action="{{route('user.update',[Auth::user()->id])}}" method="post">
                    @csrf
                    <input name ="_method" type="hidden" value="PUT">
                    <div class="form-group">
                        <label class="col-md-12">User Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="{{Auth::user()->username}}" name="username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{Auth::user()->username}}">
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Full Name</label>
                        <div class="col-md-12">
                            <input type="text" placeholder="{{Auth::user()->name}}" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{Auth::user()->name}}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <input type="email" placeholder="{{Auth::user()->email}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="example-email" value="{{Auth::user()->email}}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-12">Change Password</label>
                        <div class="col-md-12">
                            <input type="password" value="" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success"  onclick="return confirm('Are you sure want to delete this product?')">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
