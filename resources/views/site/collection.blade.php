@extends('layouts.user.layout')
@section('body')
	<div class="main_content">
		<div class="row m-0 p-0">
			<div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
				<div class="collection text-center">
					<h2 class="text-white">{{isset($collection) ? $collection->name : 'Archives'}}</h2>
				</div>
			</div>
		</div>
		<div class="colection_content">
			<div class="container">
				@if($arts->count())
					
					<div class="infinite-scroll">
						<div class="row m-0 p-0 ">
							@foreach($arts as $art)
								<div class="col-md-6 col-lg-6">
									<div class="collection_single">
										<div class="collection_image">
											<img width="80%" src="/images/feature/{{$art->image}}" alt="collection-image">
											<div class="collection_shadow callArtDetailsModal" data-art="{{$art->id}}">
												<h5>
													<p>click to view
														details</p>
												</h5>
											</div>
										</div>
										<p class="collection_name p-2" style="">{{$art->name}}</p>
									</div>
								</div>
							@endforeach
						</div>
						{{$arts->links()}}
					
					</div>
				@else
					<div
							style="text-transform: capitalize; text-align: center; color: #8c8c8c;display: block; padding-bottom: 200px; ">
						<h4 class="text-center">This Sculptures is Empty</h4>
					</div>
				@endif
			</div>
		</div>
	</div>
	
	
	<div id="callBackModal">
	
	</div>
@endsection

@section('footer')
	<script type="text/javascript">

      $('ul.pagination').hide();
      $(function () {
          $('.infinite-scroll').jscroll({
              autoTrigger: true,
              padding: 0,
              nextSelector: '.pagination li.active + li a',
              contentSelector: 'div.infinite-scroll',
              callback: function () {
                  $('ul.pagination').remove();
              }
          });
      });
	</script>
@endsection
