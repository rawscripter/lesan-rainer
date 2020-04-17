@extends('layouts.admin.layout')
@section('head')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

@endsection

@section('content')
	<div class="content-wrapper">
		<div class="page-header">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('admin.home')}}">Dashboard</a></li>
					<li class="breadcrumb-item active" aria-current="page">All Installations</li>
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
							<a href="{{route('installations.create')}}"
							   class="btn btn-primary">Add New Installation</a><br>
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
									<th>Location</th>
									<th>Art</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
								</thead>
								<tbody>
								@php
									$i = 1;
								@endphp
								@foreach($installations as $ins)
									<tr>
										<td>{{$i++}}</td>
										<td>{{$ins->name}}</td>
										<td>{{$ins->location}}</td>
										<td>{{optional($ins->art)->name}}</td>
										<td>
											<a href="{{route('installations.edit',$ins->id)}}"
											   class="btn btn-primary">
												Edit
											</a>
										</td>
										<td>
											<form method="POST"
											      action="{{route('installations.destroy',$ins->id)}}">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<input onClick="return confirm('Are you sure you want to delete the Installation?')"
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
