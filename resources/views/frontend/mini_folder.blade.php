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
                @if(isset(Auth::user()->miniorders))
                    @foreach($miniorder as $mini)
                        @foreach($minicategory as $minic)
                            @if($minic->id == $mini->mini_id)
                                <h3>Read Mini-category: {{$minic->mini_category}}</h3>
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
                            @foreach($miniorder as $mini)
                                @foreach($books as $book)
                                    @if($book->mini_id == $mini->mini_id)

                                        <tbody>
                                        <tr>

                                            <td>{!! $book->Title !!}</td>
                                            <td>{!! $book->Author !!}</td>
                                            <td><a href="{{route('mini.read',[$book->id])}}" class="btn btn-primary">Read</a></td>

                                        </tr>
                                        </tr>
                                        </tbody>

                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                        {{ $miniorder->links() }}
                    </div>
                @else
                    <h6>Emply</h6>
                @endif
            </div>
        </div>
    </div>
@endsection
