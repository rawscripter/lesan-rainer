@extends('layouts.user.layout')
@section('body')
    <div class="main_content">
        @if($arts->count() > 0)
            <div class="slider_area">
                <div class="row m-0 p-0">
                    <div class="col-md-10 col-lg-6 m-auto">
                        <div id="carouselExampleFade" data-interval="1500" class="carousel slide carousel-fade"
                             data-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($arts as $art)
                                    <div class="carousel-item callArtDetailsModal {{$i < 1 ? 'active' : ''}}"
                                         data-art="{{$art->id}}">
                                        <img src="/images/feature/{{$art->image}}"
                                             alt="slider-image-1">
                                    </div>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleFade" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleFade" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="home_about">
            <div class="row m-0 p-0">
                <div class="col-lg-6 col-md-10 col-12 m-auto">
                    <h2 class="pt-4 mb-4">{{$homePageContents->heading}}</h2>
                    <p class="show-text-as-white-space">{!! $homePageContents->contents !!}</p>
                    @if(!empty($homePageContents->url) && !empty($homePageContents->button_text))
                        <a href="{{$homePageContents->url}}"
                           class="btn btn-outline-light mt-3  rounded-0">{{$homePageContents->button_text}}</a>
                    @endif
                </div>
            </div>
        </div>

        <div id="callBackModal">

        </div>

    </div>
@endsection
