@extends('layouts.admin.layout')
@section('content')

    <style>
        .page-heading {
            margin: 20px 0;
            color: #666;
            -webkit-font-smoothing: antialiased;
            font-family: "Segoe UI Light", "Arial", serif;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        #my-dropzone .message {
            font-family: "Segoe UI Light", "Arial", serif;
            font-weight: 600;
            color: #0087F7;
            font-size: 1.5em;
            letter-spacing: 0.05em;
        }

        .dropzone {
            border: 2px dashed #0087F7;
            background: white;
            border-radius: 5px;
            min-height: 300px;
            padding: 90px 0;
            vertical-align: baseline;
        }
    </style>
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Upload New Image</li>
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
                    <div class="col-12 mt-5 mb-5">
                        <h4>Drag And Drop Images</h4>
                        <form action="{{route('admin.upload.image')}}" class="dropzone d-flex align-items-center"
                              id="my-awesome-dropzone">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </div>
                <div class="text-center mt5">
                    <span class="btn btn-primary"><a href="{{route('admin.uploads')}}">Go Back</a></span>
                </div>
            </div>
        </div>
    </div>
@endsection
