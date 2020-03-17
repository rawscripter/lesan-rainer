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
                                {!! Form::model($homepage,['route' => ['admin.home.page.settings.update',$homepage->id]]) !!}
                                <div class="form-group">
                                    {{Form::label('heading', 'Heading')}}
                                    {{Form::text('heading', null,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('contents', 'Contents')}}
                                    {{Form::textarea('contents', null,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('url', 'Button Link')}}
                                    {{Form::text('url', null,['class'=>'form-control'])}}
                                </div>
                                <div class="form-group">
                                    {{Form::label('button_text', 'Button Text')}}
                                    {{Form::text('button_text',null,['class'=>'form-control'])}}
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

