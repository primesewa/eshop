@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper" xmlns="">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"> Home Section</li>
                <li class="breadcrumb-item active">Add footer Section</li>

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

                    <h3>Add  Section</h3>
                    <form  action="{{route('about.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title " name="title" value="{{ old('title') }}" >
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
                                        <option value="Plans & pricing">Plans & pricing</option>
                                        <option value="Terms & Conditions">Terms & Conditions</option>
                                        <option value="Privacy_Policy">Privacy Policy</option>
                                        <option value="About_us">About us</option>
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
                                    <textarea  id="mytextarea"  class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Description" name="description" value="{{ old('description') }}" ></textarea>
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
                        <div class="container">
                            <h2>About us Content</h2>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Section</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                @foreach($about as $a)
                                <tbody>
                                <tr>
                                    <td>{{$a->title}}</td>
                                    <td>{!! $a->description !!}</td>
                                    <td>{{$a->status}}</td>
                                    <td><a href="{{route('about.edit',[$a->id])}}"><i class="fas fa-edit"></i></a></td>
                                    <td>
                                        <form method="post" action="{{route('about.delete',[$a->id])}}">
                                            @csrf
                                            <input name ="_method" type="hidden" value="DELETE">
                                            <button onclick="return confirm('Are you sure want to delete this about?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
                                        </form>
                                    </td>

                                </tr>
                                </tbody>
                                    @endforeach
                            </table>
                        </div>

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
    {{--<script src="{{asset('ckeditor/js/en.js')}}"></script>--}}
    {{--<script src="{{asset('ckeditor/js/config.js')}}"></script>--}}
    {{--<script src="{{asset('ckeditor/js/styles.js')}}"></script>--}}
    {{--<script src="//cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>--}}

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
    {{--<link href="{{url('ckeditor/css/contents.css')}}" rel="stylesheet">--}}
    {{--<link href="{{url('ckeditor/css/editor.css')}}" rel="stylesheet">--}}


@endsection
