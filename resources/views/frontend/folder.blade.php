@extends('frontend.layouts.user-dashboard')
@section('content')
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">setting</h4> </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="#">Dashboard</a></li>
                <li class="active">setting</li>
            </ol>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                @if(isset(Auth::user()->suborders))
                    @foreach($suborders as $sub)
                        @foreach($subcategory as $subc)
                            @if($subc->id == $sub->sub_id)
                            <h3>Read Sub-category: {{$subc->sub_category}}</h3>
                            @endif
                        @endforeach
                        @endforeach
                    <div class="container">
                        <table class="table table-hover" style="width: 900px;">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Auther</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($suborders as $sub)
                                @foreach($books as $book)
                                    @if($book->sub_id == $sub->sub_id)
                                        <tbody>
                                        <tr>

                                            <td>{!! $book->Title !!}</td>
                                            <td>{!! $book->Author !!}</td>
                                            <td><a href="{{route('sub.read',[$book->id])}}" class="btn btn-primary">Read</a></td>

                                        </tr>
                                        </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                        {{ $suborders->links() }}
                    </div>
                    @else
                    <h6>Empty</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
