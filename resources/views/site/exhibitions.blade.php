@extends('layouts.user.layout')
@section('body')
    <
    <div class="main_content">
        <div class="row m-0 p-0">
            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                <div class="collection text-center">
                    <h1>EXHIBITIONS</h1>
                </div>
            </div>
        </div>
        <!-- start demo modal -->


        <!-- end of modal -->
        <div class="colection_content">
            <div class="container">

                <div class="infinite-scroll">
                    <div class="row m-0 p-0">
                        @foreach($exhibitions as $exh)
                            <div class="col-md-4 col-lg-4">
                                <div class="collection_single">
                                    <div class="collection_image">
                                        <img width="100%" src="/images/feature/{{$exh->image}}"
                                             alt="collection-image">
                                        <div class="collection_shadow callExhibitionDetailsModal"
                                             data-exhibiton="{{$exh->id}}">
                                            <span class="p-3">
                                                <p>click to view
                                                    details</p>
                                            </span>
                                        </div>
                                    </div>
                                    <a href="#"><span>{{$exh->title}}</span></a>
                                </div>
                            </div>
                        @endforeach

                        {{--                        {{ $installations->appends($_GET)->links() }}--}}
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
