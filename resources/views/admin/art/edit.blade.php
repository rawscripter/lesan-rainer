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
				Edit Art Work Info
			</h3>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{route('arts.index')}}">Art Works</a></li>
					<li class="breadcrumb-item active" aria-current="page">New Art</li>
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
					<div class="col-12col-12 col-md-8 m-auto text-right">
						<button id="uploadArtImages" class="btn btn-primary" data-toggle="modal" data-keyboard="false"
						        data-backdrop="static"
						        data-target="#exampleModal">Upload
							Images
						</button>
					</div>
					<div class="col-12 col-md-8 m-auto">
						{!! Form::model($art,['url' => route('arts.update',$art->id),'enctype' => 'multipart/form-data']) !!}
						{{ method_field('PUT') }}
						<div class="form-group">
							{{Form::label('name', 'Art Name')}}
							{{Form::text('name', null,['class'=>'form-control','required'])}}
						</div>
						
						<div class="row">
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('size1', 'Size 1')}}
									{{Form::text('size1', null,['class'=>'form-control','required'])}}
								</div>
							</div>
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('size2', 'Size 2')}}
									{{Form::text('size2', null,['class'=>'form-control','required'])}}
								</div>
							</div>
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('year', 'Year')}}
									{{Form::text('year', null,['class'=>'form-control','required','maxlength'=>'4','pattern'=>"\d*"])}}
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
							{{Form::textarea('description', null,['class'=>'form-control','required'])}}
						</div>
						
						<div class="row">
							<div class="col-12 col-md-6 m-auto">
								<div class="form-group">
									{{Form::label('image', 'Feature Image')}}
									{{Form::file('image',['class'=>'dropify'])}}
								</div>
							</div>
							<div class="col-12 col-md-6 m-auto text-center">
								<div class="lightgalleryID lightGallery">
									<a href="/images/arts/{{$art->image}}" class="image-tile">
										<img
												src="/images/feature/{{$art->image}}"
												class="img-thumbnail"
												style="height: 200px !important;"
												alt="{{$art->name}}"
										>
									</a>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-12 grid-margin">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Drag and Drop Image</h4>
										<div class="row">
											<div class="col-md-6">
												<h6 class="card-title">Attached Images</h6>
												<div id="dragula-event-left" class="py-2">
													@if(!empty($art->relatedImages))
														@foreach($art->relatedImages as $activeImage)
															<div class="card rounded border mb-2">
																<div class="card-body p-3">
																	<div class="media">
																		<i class="fa fa-check icon-sm align-self-center mr-3 text-success"></i>
																		<div class="media-body">
																			<div class="lightgalleryID lightGallery">
																				<a href="/images/arts/{{$activeImage->name}}"
																				   class="image-tile">
																					<img
																							src="/images/feature/{{$activeImage->name}}"
																							class="img-thumbnail"
																							style="height: 50px !important;"
																							alt="{{$activeImage->name}}">
																				</a>
																				<input class="related_image active"
																				       type="hidden"
																				       value="{{$activeImage->id}}"
																				       name="relatedImage[]">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														@endforeach
													@endif
												</div>
											</div>
											<div class="col-md-6">
												<h6 class="card-title">Remove Images</h6>
												<div id="dragula-event-right" class="py-2 parentDiv">
												
												
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							{{Form::submit('Update Installation',['class'=>'btn btn-block btn-primary'])}}
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
	
	
	
	{{--    upload image modal --}}
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	     aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">
					<div class="row">
						<div class="col-12 mt-5 mb-5">
							<h5>Drag And Drop Images</h5>
							<br>
							<form action="{{route('admin.upload.image',$art->id)}}" class="dropzone d-flex align-items-center"
							      id="my-awesome-dropzone">
								{{ csrf_field() }}
							</form>
						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="window.location.reload();">
						Close
					</button>
				</div>
			</div>
		</div>
	</div>

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