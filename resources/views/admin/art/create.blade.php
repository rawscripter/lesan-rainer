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
				Create New Art Work
			</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('arts.index')}}">Art Works</a></li>
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
						{!! Form::open(['url' => route('arts.store'),'enctype' => 'multipart/form-data']) !!}
						<div class="form-group">
							{{Form::label('name', 'Art Name')}}
							{{Form::text('name', '',['class'=>'form-control','required'])}}
						</div>
						
						<div class="row">
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('size1', 'Size 1')}}
									{{Form::text('size1', '',['class'=>'form-control','required'])}}
								</div>
							</div>
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('size2', 'Size 2')}}
									{{Form::text('size2', '',['class'=>'form-control','required'])}}
								</div>
							</div>
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('year', 'Year')}}
									{{Form::text('year', '',['class'=>'form-control','required','maxlength'=>'4','pattern'=>"\d*"])}}
								</div>
							</div>
							
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('collection_id', 'Select a Sculptures')}}
									{{Form::select('collection_id', $collections, null, ['class'=>'form-control select2','placeholder' => 'Select a Sculptures'])}}
								</div>
							</div>
						</div>
						
						<div class="form-group">
							{{Form::label('description', 'Art Description')}}
							{{Form::textarea('description', '',['class'=>'form-control','required'])}}
						</div>
						
						<div class="form-group">
							{{Form::label('image', 'Feature Image')}}
							{{Form::file('image',['class'=>'dropify','required'])}}
						</div>
						<br>
						<div class="form-group">
							<div class="form-check">
								<label class="form-check-label">
									{{Form::checkbox('archive', 1)}}
									Archive Art Work
									<i class="input-helper"></i></label>
							</div>
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
	
	
	<!-- Modal -->
	{{--    <div class="modal fade" id="uploadModalButton" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
	{{--         aria-hidden="true">--}}
	{{--        <div class="modal-dialog modal-lg" role="document">--}}
	{{--            <div class="modal-content">--}}
	{{--                <div class="modal-header">--}}
	{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
	{{--                        <span aria-hidden="true">&times;</span>--}}
	{{--                    </button>--}}
	{{--                </div>--}}
	{{--                <div class="modal-body" style="height: 800px;">--}}
	{{--                    <iframe src="{{route('admin.upload.image.page')}}" frameborder="0"--}}
	{{--                            style="overflow:hidden;height:100%;width:100%" height="100%" width="50%"></iframe>--}}
	{{--                </div>--}}
	{{--            </div>--}}
	{{--        </div>--}}
	{{--    </div>--}}
@endsection

@section('footer')
	<script src="{{asset('assets/admin/js/dragula.js')}}"></script>
	<script>
      /*Summernote editor*/
      if ($("textarea").length) {
          $('textarea').summernote({
              height: 300,
              tabsize: 2
          });
      }
	
	</script>
@endsection
