@extends('layouts.admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('articles.index')}}">Articles</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Article</li>
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
                        {!! Form::model($article,['url' => route('articles.update',$article->id),'enctype' => 'multipart/form-data']) !!}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            {{Form::label('title', 'Article Title')}}
                            {{Form::text('title', null,['class'=>'form-control','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('image', 'First Image')}}
                            {{Form::file('image',['class'=>'dropify'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('date', 'Publish Date')}}
                            {{Form::date('publish_date', null,['class'=>'form-control','required'])}}
                        </div>


                        <div class="form-group">
                            {{Form::label('source', 'News Source')}}
                            {{Form::textarea('news_source', null,['class'=>'form-control'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('original_link', 'Original Link')}}
                            {{Form::text('original_link', null,['class'=>'form-control'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('details', 'Details')}}
                            {{Form::textarea('details', null,['class'=>'form-control','id'=>'summernoteExample'])}}
                        </div>


                        <div class="form-group">
                            {{Form::submit('Update Article',['class'=>'btn btn-block btn-primary'])}}
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
