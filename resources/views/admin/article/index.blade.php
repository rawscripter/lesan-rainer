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
					<li class="breadcrumb-item active" aria-current="page">All Articles</li>
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
							<a href="{{route('articles.create')}}"
							   class="btn btn-primary">Add New Article</a><br>
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
									<th>Image</th>
									<th>Title</th>
									<th>Publish Date</th>
									<th>Created At</th>
									<th>Edit</th>
									<th>Delete</th>
								</tr>
								</thead>
								<tbody>
								
								@php
									$i = $articles->count();
								@endphp
								@foreach($articles as $article)
									<tr>
										<td>{{$i}}</td>
										<td><img src="/images/thumb/{{$article->image}}" alt=""></td>
										<td>{{$article->title}}</td>
										<td>{{$article->publish_date}}</td>
										<td>{{$article->created_at->format('d M Y')}}</td>
										<td>
											<div class="btn-group">
												<a href="{{route('articles.edit',$article->id)}}"
												   class="btn btn-primary">Edit</a>
											</div>
										</td>
										<td>
											<form method="POST"
											      action="{{route('articles.destroy',$article->id)}}">
												{{ csrf_field() }}
												{{ method_field('DELETE') }}
												<input onClick="return confirm('Are you sure you want to delete the Article?')"
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
