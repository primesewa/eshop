@extends('frontend.layouts.user-dashboard')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Buy Category</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">Buy Category</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <h5>Buy Sub-category</h5>
                <ul class="list-group">
                    @foreach($subcategorys as $sub)
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="width: 500px;">
                        <a href="{{route('archive.sub',[$sub->id])}}">{{$sub->sub_category}}</a>
                        <span class="badge badge-primary badge-pill">{{$sub->currency}} {{$sub->price}}</span>

                    @foreach(Auth::user()->suborders as $suborder)
                            @if($suborder->sub_id == $sub->id and $suborder->expire_date >= date("y/m/d"))
                        <span class="badge badge-primary badge-pill">Bought</span>
                            @endif
                            @endforeach
                    </li>
                   @endforeach
                        {{ $subcategorys->links() }}
                </ul>

                <br>
                <hr>
                <br>
                <h5>Buy mini-category</h5>
                <ul class="list-group">
                    @foreach($minicategorys as $mini)
                        <li class="list-group-item d-flex justify-content-between align-items-center"  style="width: 500px;">
                          <a href="{{route('archive.mini',[$mini->id])}}"> {{$mini->mini_category}}</a>
                            <span class="badge badge-primary badge-pill">{{$mini->currency}} {{$mini->price}}</span>
                            @foreach(Auth::user()->miniorders as $miniorder)
                                @if($miniorder->mini_id == $mini->id and $miniorder->expire_date >= date("y/m/d"))
                                    <span class="badge badge-primary badge-pill">Bought</span>
                                @endif
                            @endforeach
                        </li>
                    @endforeach
                        {{ $minicategorys->links() }}
                </ul>
            </div>
        </div>
    </div>
@endsection

