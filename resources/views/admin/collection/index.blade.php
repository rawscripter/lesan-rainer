@extends('layouts.admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Collections table
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Collections</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-12 m-auto">
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        </div>
                    </div>
                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="create-btn text-right">
                            <a href="{{route('collections.create')}}"
                               class="btn btn-primary">Add New Collection</a><br>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <div id="order-listing_wrapper"
                             class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">

                            <table class="table  no-footer" role="grid"
                                   aria-describedby="order-listing_info">
                                <thead>
                                <tr role="row">
                                    <th>Sl.</th>
                                    <th>Collection Name</th>
                                    <th>Arts</th>
                                    <th>Created At</th>
                                    <th>Added By</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php
                                    $i = $collections->count();
                                @endphp
                                @foreach($collections as $collection)
                                    <tr>
                                        <td>{{$i--}}</td>
                                        <td>{{$collection->name}}</td>
                                        <td>{{$collection->arts->count()}}</td>
                                        <td>{{$collection->created_at->format('m-d-Y')}}</td>
                                        <td>{{$collection->user->name}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('collections.edit',$collection->id)}}"
                                                   class="btn btn-primary">Edit</a>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="POST"
                                                  action="{{route('collections.destroy',$collection->id)}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input onClick="return confirm('Are you sure you want to delete the Sculpture?')"
                                                       type="submit" class="btn btn-danger"
                                                       value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
