@extends('frontend.layouts.layout')
@section('content')
    <div>
        <section class="wn_contact_area bg--white pt--80 pb--80">
        	<div class="container">
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
                    </div>
        			<div class="col-lg-8 col-12">
        				<div class="contact-form-wrap">
        					<h2 class="contact__title">Get in touch</h2>
                            <form action="{{route('message.contact')}}" method="post">
                                @csrf
                                <div class="single-contact-form space-between">
                                    <input type="text" name="firstname" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}"placeholder="First Name*"  value="{{ old('firstname') }}" >
                                    <input type="text" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="Last Name*"  value="{{ old('lastname') }}" >
                                </div>
                                <div class="single-contact-form space-between">
                                    <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email*"  value="{{ old('email') }}" >
                                    <input type="text" name="website" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"placeholder="Website"  value="{{ old('website') }}" >
                                </div>
                                <div class="single-contact-form">
                                    <input type="text" name="subject"class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" placeholder="Subject*"  value="{{ old('subject') }}" >
                                </div>
                                <div class="single-contact-form message">
                                    <textarea name="message" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" placeholder="Type your message here.."  value="{{ old('message') }}" ></textarea>
                                </div>
                                <div class="contact-btn">
                                    <button type="submit">Send Email</button>
                                </div>
                            </form>
                        </div>
        			</div>
        			{{--<div class="col-lg-4 col-12 md-mt-40 sm-mt-40">--}}
        				{{--<div class="wn__address">--}}
        					{{--<h2 class="contact__title">Get office info.</h2>--}}
                            {{--@foreach($contact as $c)--}}
                            {{--<p>{{$c->office_info}}</p>--}}
                                {{--<div class="wn__addres__wreapper">--}}
        						{{--<div class="single__address">--}}
        							{{--<i class="icon-location-pin icons"></i>--}}
        							{{--<div class="content">--}}
        								{{--<span>address:</span>--}}
        								{{--<p>{{$c->address}}</p>--}}
        							{{--</div>--}}
        						{{--</div>--}}

        						{{--<div class="single__address">--}}
        							{{--<i class="icon-phone icons"></i>--}}
        							{{--<div class="content">--}}
        								{{--<span>Phone Number:</span>--}}
        								{{--<p>{{$c->phonenumber}}</p>--}}
        							{{--</div>--}}
        						{{--</div>--}}

        						{{--<div class="single__address">--}}
        							{{--<i class="icon-envelope icons"></i>--}}
        							{{--<div class="content">--}}
        								{{--<span>Email address:</span>--}}
        								{{--<p>{{$c->email}}</p>--}}
        							{{--</div>--}}
        						{{--</div>--}}

        						{{--<div class="single__address">--}}
        							{{--<i class="icon-globe icons"></i>--}}
        							{{--<div class="content">--}}
        								{{--<span>website address:</span>--}}
        								{{--<p>{{$c->name}}</p>--}}
        							{{--</div>--}}
        						{{--</div>--}}

        					{{--</div>--}}
                                {{--@endforeach--}}
        				{{--</div>--}}
        			{{--</div>--}}
        		</div>
        	</div>
        </section>
	</div>
@endsection
