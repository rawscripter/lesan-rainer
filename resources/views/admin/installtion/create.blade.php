@extends('layouts.admin.layout')
@section('content')
    <style>
        .lightGallery .image-tile img {
            max-width: 100%;
            width: auto;
        }

        div#dragula-event-right, div#dragula-event-left {
            min-height: 200px;
            background: #f1f1f1;
            padding: 10px;
        }

        div#dragula-event-right div, div#dragula-event-left div {
            cursor: pointer;
        }
    </style>

    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Create New Installation
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('installations.index')}}">Art Works</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Art Work</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-8 m-auto">
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        </div>
                    </div>

                @endif

                <div class="row">
                    <div class="col-12 col-md-8 m-auto">
                        {!! Form::open(['url' => route('installations.store'),'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::label('name', 'Name')}}
                            {{Form::text('name', '',['class'=>'form-control','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('name', 'Location')}}
                            {{Form::text('location', '',['class'=>'form-control','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('description', 'Comment')}}
                            {{Form::textarea('comment', '',['class'=>'form-control'])}}
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                {{Form::label('art_id', 'Select a Collection')}}
                                {{Form::select('art_id', $arts, null, ['class'=>'form-control select2','placeholder' => 'Select a Art'])}}
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-group">
                                {{Form::label('type', 'Select a Collection')}}
                                {{Form::select('type', ['Public'=>'Public','Private'=>'Private'] , 'Public', ['class'=>'form-control select2','placeholder' => 'Select Type','required'])}}
                            </div>
                        </div>


                        <div class="form-group">
                            {{Form::label('image', 'First Image')}}
                            {{Form::file('image_1',['class'=>'dropify','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('image', 'Second Image')}}
                            {{Form::file('image_2',['class'=>'dropify','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('image', 'Third Image')}}
                            {{Form::file('image_3',['class'=>'dropify','required'])}}
                        </div>


                        <br>
                        <div class="form-group">
                            {{Form::submit('Add Installation',['class'=>'btn btn-block btn-primary'])}}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                @if (isset($errors) && count($errors) > 0)
                    <div class="row">
                        <div class="col-12 col-md-6 m-auto">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
