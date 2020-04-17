@extends('layouts.user.layout')
@section('body')
	<
	<div class="main_content">
		<div class="row m-0 p-0">
			<div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
				<div class="collection text-center">
					<h1>INSTALLATIONS</h1>
				</div>
			</div>
		</div>
		<!-- start demo modal -->


		<!-- end of modal -->
		<div class="colection_content">
			<div class="container">
				<div class="installation-area-btn text-center">
					<a href="{{route('site.installations')}}" class="btn {{ !isset($_GET['filter']) ? 'btn-light' : 'btn-outline-light' }} mt-3  rounded-0" style="min-width: 150px;">SHOW
						ALL</a>
					<a href="?filter=Private" class="btn  mt-3 {{ isset($_GET['filter']) && $_GET['filter'] == 'Private' ? 'btn-light' : 'btn-outline-light' }} rounded-0" style="min-width: 150px;">PRIVATE</a>
					<a href="?filter=Public" class="btn  mt-3 {{ isset($_GET['filter']) && $_GET['filter'] == 'Public' ? 'btn-light' : 'btn-outline-light' }}  rounded-0" style="min-width: 150px;">PUBLIC</a>
				</div>

				<div class="infinite-scroll">
					<div class="row m-0 p-0">
						@foreach($installations as $ins)
							<div class="col-md-4 col-lg-4">
								<div class="collection_single">
									<div class="collection_image">
										<img width="100%" src="/images/feature/{{$ins->image_1}}" alt="collection-image">
										<div class="collection_shadow callInstallationDetailsModal" data-installation="{{$ins->id}}">
											<h5>
												<p>click to view
													details</p>
											</h5>
										</div>
									</div>
									<a href="#"><h3>{{$ins->name}}</h3></a>
								</div>
							</div>
						@endforeach

						{{ $installations->appends($_GET)->links() }}
					</div>
				</div>
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
