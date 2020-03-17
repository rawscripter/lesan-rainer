@extends('layouts.admin.layout')
@section('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">
                Create New Sculpture
            </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('collections.index')}}">Sculptures</a></li>
                    <li class="breadcrumb-item active" aria-current="page">New Sculpture</li>
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
                        {!! Form::open(['url' => route('collections.store')]) !!}
                        <div class="form-group">
                            {{Form::label('name', 'Sculpture Name')}}
                            {{Form::text('name', '',['class'=>'form-control','required'])}}

                        </div>
                        <div class="form-group">
                            {{Form::submit('Create New Sculpture',['class'=>'btn btn-block btn-primary'])}}
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
