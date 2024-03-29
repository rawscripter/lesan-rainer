@extends('layouts.admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('exhibitions.index')}}">Exhibitions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Exhibition</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-body">

                @if(Session::has('message'))
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <p class="alert alert-success">{{ Session::get('message') }}</p>
                        </div>
                    </div>

                @endif


                <div class="row">
                    <div class="col-12 col-md-6 m-auto">

                        {!! Form::model($exhibition,['url' => route('exhibitions.update',$exhibition->id),'enctype' => 'multipart/form-data']) !!}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            {{Form::label('title', 'Title')}}
                            {{Form::text('title', null,['class'=>'form-control','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('image', 'Image')}}
                            {{Form::file('image',['class'=>'dropify'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('year', 'Year')}}
                            {{Form::text('year', null,['class'=>'form-control','required'])}}
                        </div>


                        <div class="form-group">
                            {{Form::label('body', 'Details')}}
                            {{Form::textarea('body', null,['class'=>'form-control'])}}
                        </div>


                        <div class="form-group">
                            {{Form::submit('Post Exhibition',['class'=>'btn btn-block btn-primary'])}}
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


