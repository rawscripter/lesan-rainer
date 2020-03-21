@extends('layouts.admin.layout')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
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
                        {!! Form::model($user,['url' => route('users.update',$user->id),'enctype' => 'multipart/form-data']) !!}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            {{Form::label('name', 'Name')}}
                            {{Form::text('name', null,['class'=>'form-control','required'])}}
                        </div>

                        <div class="form-group">
                            {{Form::label('email', 'E-mail')}}
                            {{Form::text('email', null,['class'=>'form-control','required'])}}
                        </div>


                        <div class="form-group">
                            {{Form::label('password', 'Password')}}
                            {{Form::text('password', '',['class'=>'form-control'])}}
                        </div>


                        <div class="form-group">
                            {{Form::submit('Update User',['class'=>'btn btn-block btn-primary'])}}
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
