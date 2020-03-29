@extends('layouts.admin.layout')

@section('content')
    <div class="main-panel" style="width: 100% !important;">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Settings
                </h3>
            </div>
            <div class="row grid-margin">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if(Session::has('message'))
                                <div class="row">
                                    <div class="col-md-12 m-auto">
                                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                                    </div>
                                </div>
                            @endif
                            <div class="card-body">
                                {!! Form::model($aboutPage,['route' => ['admin.about.page.settings.update',$aboutPage->id],'enctype' => 'multipart/form-data']) !!}
                                <div class="row">
                                    <div class="col-12 col-md-6 m-auto">
                                        <div class="form-group">
                                            {{Form::label('image', 'Art Image')}}
                                            {{Form::file('image',['class'=>'dropify'])}}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 m-auto d-block text-center">
                                        <img src="/images/pages/{{$aboutPage->image}}" style="max-height: 210px"
                                             class="img-thumbnail img-responsive"
                                             alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{Form::label('heading', 'Heading')}}
                                    {{Form::text('heading', null,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('info_url', 'Info Url')}}
                                    {{Form::text('info_url', null,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('statement', 'Artist Statement')}}
                                    {{Form::textarea('statement', null,['class'=>'form-control'])}}
                                </div>

                                <div class="form-group">
                                    {{Form::label('contents', 'Contents')}}
                                    {{Form::textarea('contents', null,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::submit('Save Changes',['class'=>'btn btn-block btn-primary'])}}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
