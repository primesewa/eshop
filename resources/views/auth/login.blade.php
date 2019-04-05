@extends('layouts.app')

@section('content')
<div class="container" id="login">
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><center>{{ __('Login') }}</center></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf

                        <div class="form-group">
                            <div class="form-label-group">
                                <input  type="text" class="form-control{{ $errors->has('username_or_email') ? ' is-invalid' : '' }}" name="username_or_email" value="{{ old('username_or_email') }}" placeholder="Username or Email">
                                @if ($errors->has('username_or_email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username_or_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-label-group">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="rem">
                            <div class="form-label-group">
                                <label class="form-check-label" for="remember">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>


                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>


                        <div class="form-group">
                            <div class="form-label-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Login') }}
                                </button>

                                {{--@if (Route::has('password.request'))--}}
                                    {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                        {{--{{ __('Forgot Your Password?') }}--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                        <div class="text-center">
                            <a class="d-block small mt-3" href="/register">Register an Account</a>
                            <a class="d-block small" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    #login{
        width: 600px;
        margin-top: 100px;
    }
    #rem{
        margin-left: 20px;
    }
</style>
