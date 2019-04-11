@extends('frontend.layouts.user-dashboard')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Setting</h4> </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
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

                    <form action="{{  is_null($sewa_acc) ? route('create.sewa'): route('update.sewa',[$sewa_acc->id])}}" method="post">
                        @csrf
                        @if(!is_null($sewa_acc))
                            <input name ="_method" type="hidden" value="PUT">
                        @endif
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Account no </label>
                                <input type="text" class="form-control{{ $errors->has('account') ? ' is-invalid' : '' }}" placeholder="Enter Account no" name="account" value="{{ isset($sewa_acc->account) ? $sewa_acc->account: '' }}" >
                                @if($errors->has('account'))
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('account') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-primary btn-lg btn-block">Submit</button>
                        </div>

                    </form>
                </div>
            </div>

@endsection
@section('style')
    <style>
        #box
        {
            margin-top: 30px;
        }
    </style>
@endsection
