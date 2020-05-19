@extends('layouts.admin.layout')
@section('head')
    <style>
        .table td img, .jsgrid .jsgrid-table td img {
            width: 120px;
            height: auto !important;
        }

        .lightGallery .image-tile img {
            max-width: 100%;
            width: 120px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Uploads table
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Uploads</li>
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
                        <div class="create-btn text-right mb-5">
                            <a href="{{route('admin.upload.image.page')}}"
                               class="btn btn-primary">Upload New Images</a><br>
                        </div>
                        <div class="card mt5">
                            <table class="table table-striped table-borderless">
                                <tr>
                                    <th>
                                        Image
                                    </th>

                                    <th>
                                        Image Name
                                    </th>

                                    <th>
                                        Active
                                    </th>
                                </tr>
                                @foreach($images as $img)
                                    <tr>
                                        <td>
                                            <div class="card-body">
                                                <div class="row lightgalleryID lightGallery">
                                                    <a href="/images/arts/{{$img->name}}" class="image-tile">
                                                        <img src="/images/thumb/{{$img->name}}" alt="image small">
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{$img->name}}
                                        </td>

                                        <td>
                                            <form method="POST"
                                                  action="{{route('admin.upload.image.delete',$img->id)}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input onClick="return confirm('Are you sure you want to delete the Image?')"
                                                       type="submit" class="btn btn-danger"
                                                       value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
