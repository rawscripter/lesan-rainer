@extends('layouts.admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Exhibitions</li>
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
                            <a href="{{route('exhibitions.create')}}"
                               class="btn btn-primary">Add New Exhibition</a><br>
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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Year</th>
                                    <th>Publish Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php
                                    $i = $exhibitions->count();
                                @endphp
                                @foreach($exhibitions as $exh)
                                    <tr>
                                        <td>{{$i--}}</td>
                                        <td><img src="/images/thumb/{{$exh->image}}" width="64" height="64" alt=""></td>
                                        <td>{{$exh->title}}</td>
                                        <td>{{$exh->year}}</td>
                                        <td>{{$exh->created_at->format('d M Y')}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('exhibitions.edit',$exh->id)}}"
                                                   class="btn btn-primary">Edit</a>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="POST"
                                                  action="{{route('exhibitions.destroy',$exh->id)}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input
                                                    onClick="return confirm('Are you sure you want to delete the Exhibition?')"
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
