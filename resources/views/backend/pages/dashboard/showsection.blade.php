@extends('backend.main-master.main-master')
@section('content')

<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Home Section</li>
            <li class="breadcrumb-item active">Show section</li>

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

                <h2>Section</h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Books</th>
                        <th>Edit</th>
                        <th>Delete</th>

                    </tr>
                    </thead>
                    @foreach ($sections as $section)

                    <tbody>
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$section->title}}</td>
                        <td>{{$section->description}}</td>
                        <td>
                            <select class="form-control" >
                                <option value="">View Books</option>
                            @foreach($section->book_id as $id)
                                @foreach($books as $book)
                                    @if($book->id == $id)

                                            <option value="">{{$book->Title}}</option>


                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a href="{{route('section.edit',[$section->id])}}"><span><i class="fas fa-edit"></i></span></a>
                        </td>

                        <td>
                            <form method="post" action="{{route('section.destroy',[$section->id])}}">
                                @csrf
                                <input name ="_method" type="hidden" value="DELETE">
                                <button onclick="return confirm('Are you sure want to delete this Section?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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
@endsection

