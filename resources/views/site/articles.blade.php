@extends('layouts.user.layout')
@section('body')
    <
    <div class="main_content">
        <div class="row m-0 p-0">
            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                <div class="collection text-center">
                    <h1>Articles</h1>
                </div>
            </div>
        </div>
        <!-- start demo modal -->


        <!-- end of modal -->
        <div class="colection_content">
            <div class="container">
                <div class="infinite-scroll">
                    <div class="row m-0 p-0">
                        @foreach($articles as $art)

                            <div class="col-md-4 col-lg-4">
                                <div class="collection_single">
                                    <div class="collection_image">
                                        <img width="100%" src="/images/feature/{{$art->image}}"
                                             alt="collection-image">
                                        <a href="{{route('read.article',$art->slug)}}">
                                            <div class="collection_shadow p-3">
                                                Read Article
                                            </div>
                                        </a>
                                    </div>
                                    <a href="#">{{$art->title}}</a>
                                </div>
                            </div>

                        @endforeach

                        {{ $articles->links() }}
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
