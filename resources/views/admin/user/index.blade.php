@extends('layouts.admin.layout')
@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
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
                            <a href="{{route('users.create')}}"
                               class="btn btn-primary">Add New User</a><br>
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
                                    <th>Name</th>
                                    <th>E-mail</th>
                                    <th>Added At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @php
                                    $i = $users->count();
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at->format('d M Y')}}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('users.edit',$user->id)}}"
                                                   class="btn btn-primary">Edit</a>
                                            </div>
                                        </td>
                                        <td>
                                            <form method="POST"
                                                  action="{{route('users.destroy',$user->id)}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input
                                                    onClick="return confirm('Are you sure you want to delete the User?')"
                                                    type="submit" class="btn btn-danger"
                                                    value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
