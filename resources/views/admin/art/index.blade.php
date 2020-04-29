@extends('layouts.admin.layout')
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Arts table
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Arts</li>
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
                            <a href="{{route('arts.create')}}"
                               class="btn btn-primary">Add New Art Work</a><br>
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
                                    <th>Art Name</th>
                                    <th>Collections</th>
                                    <th>Created At</th>
                                    <th>Added By</th>
                                    <th>Image</th>
                                    <th>Archive</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @if($arts->count() > 0)
                                    @foreach($arts as $art)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$art->name}}</td>
                                            <td>
                                                @foreach ($art->collections as $c)
                                                {{$c->name . ' | '}}
                                                @endforeach
                                            </td>
                                            <td>{{$art->created_at->format('m-d-Y')}}</td>
                                            <td>{{ $art->user->name }}</td>
                                            <td>
                                                <div class="lightgalleryID lightGallery">
                                                    <a href="/images/arts/{{$art->image}}" class="image-tile">
                                                        <img
                                                            src="/images/thumb/{{$art->image}}"
                                                            class="img-thumbnail"
                                                            style="width: 80px;height: auto !important;"
                                                            alt="{{$art->name}}"
                                                        >
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{route('admin.archive.art',$art->id)}}"
                                                   class="btn btn-warning">
                                                    Archive
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('arts.edit',$art->id)}}"
                                                   class="btn btn-primary">
                                                    Edit
                                                </a>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                      action="{{route('arts.destroy',$art->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <input
                                                        onClick="return confirm('Are you sure you want to delete the Art?')"
                                                        type="submit" class="btn btn-danger"
                                                        value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('table').DataTable({
                "order": [[0, "desc"]]
            });
        });
    </script>
@endsection
