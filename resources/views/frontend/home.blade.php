@extends('frontend.layouts.user-dashboard')
@section('content')
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Dashboard</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <a href="https://wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Upgrade to Pro</a>
                    <ol class="breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Visit</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">659</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Page Views</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash2"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">869</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Unique Visitor</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash3"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">911</span></li>
                        </ul>
                    </div>
                </div>
            </div>

    @endsection
