@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper" xmlns="">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"> Home Section</li>
                <li class="breadcrumb-item active">Add Home Section</li>

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

                    <h3>Add Home Section</h3>
                    <form  action="{{route('about.update',[$about->id])}}" method="post">
                        @csrf
                        <input name ="_method" type="hidden" value="put">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title " name="title" value="{{ $about->title }}" >
                                    @if($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Select page you want to add section</label>
                                    <select  id="select" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status"  >
                                        <option value="">Select</option>
                                        <option value="Plans & pricing" @if($about->status== 'Plans & pricing')selected @endif>Plans & pricing</option>
                                        <option value="Terms & Conditions" @if($about->status== 'Terms & Conditions')selected @endif>Terms & Conditions</option>
                                        <option value="Privacy_Policy" @if($about->status== 'Privacy_Policy')selected @endif>Privacy Policy</option>
                                        <option value="About_us" @if($about->status== 'About_us')selected @endif>About us</option>
                                    </select>
                                    @if($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('status') }}</strong>
                                             </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label > description</label>
                                    <textarea   id="mytextarea" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Description" name="description" >{!! $about->description !!}</textarea>
                                    @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
                            </div>
                        </div>
                    </form>

                    <br>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('js/tinymce.min.js')}}"></script>
     <script src="{{asset('js/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('js/theme.min.js')}}"></script>
    {{--<script src="{{asset('ckeditor/js/ckeditor.js')}}"></script>--}}
    {{--<script src="//cdn.ckeditor.com/4.11.3/basic/ckeditor.js"></script>--}}


    <script>
        // CKEDITOR.replace( 'mytextarea' );
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
@section('style')
    <link href="{{url('css/skin.min.css')}}" rel="stylesheet">
    <link href="{{url('css/content.min.css ')}}" rel="stylesheet">
    <link href="{{url('css/extra/content.min.css ')}}" rel="stylesheet">

@endsection
