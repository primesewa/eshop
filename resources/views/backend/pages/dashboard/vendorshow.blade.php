@extends('backend.main-master.main-master')
@section('content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.html">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Vender Section</li>
                <li class="breadcrumb-item active">Show Vendor Section</li>

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
                            <th>Vendor Books</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        @foreach ($sections as $section)

                            <tbody>
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{$section->title}}</td>
                                <td>{{$section->description}}</td>
                                <td>
                                    <select class="form-control" >
                                        <option value="">View vendor books</option>
                                        @foreach(explode(",",$section->vendor_id) as $id)
                                            @foreach($vendors as $vendor)
                                                @if($vendor->id == $id)

                                                    <option value="">{{$vendor->Title}}</option>


                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <a href="{{route('vendorsection.edit',[$section->id])}}"><span><i class="fas fa-edit"></i></span></a>
                                </td>

                                <td>
                                    <form method="post" action="{{route('vendorsection.delete',[$section->id])}}">
                                        @csrf
                                        <input name ="_method" type="hidden" value="DELETE">
                                        <button onclick="return confirm('Are you sure want to delete this Vendor Section?')" class="btn btn-danger"><span><i class="fas fa-trash-alt"></i></span></button>
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

