@extends('layouts.user.layout')
@section('body')
    {{--    <div class="main_content">--}}
    {{--        <div class="row m-0 p-0">--}}
    {{--            <div class="col-lg-6 col-md-10 col-10 m-auto">--}}
    {{--                <div class="about_area text-center mt-5">--}}
    {{--                    <h2>About</h2>--}}
    {{--                    @if($aboutPageSettings->image)--}}
    {{--                        <div class="about_image">--}}
    {{--                            <img width="100%"--}}
    {{--                                 src="/images/pages/{{$aboutPageSettings->image}}"--}}
    {{--                                 alt="{{$aboutPageSettings->heading}}">--}}
    {{--                        </div>--}}
    {{--                    @endif--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="about_content text-center">--}}
    {{--            <div class="row m-0 p-0">--}}
    {{--                <div class="col-lg-6 col-md-10 col-12 m-auto">--}}
    {{--                    <h2 class="pt-4 mb-4">{{$aboutPageSettings->heading}}</h2>--}}
    {{--                    <p style="white-space: pre-line">--}}
    {{--                        {!! $aboutPageSettings->contents !!}--}}
    {{--                    </p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <div class="main_content">
        <div class="row m-0 p-0">
            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                <div class="about_area text-center">
                    <div class="about_image mt-4">
                        <img width="100%"
                             src="/images/pages/{{$aboutPageSettings->image}}" alt="">
                    </div>
                    <div class="about-main-link mb-5">
                        <h1> RAINER LAGEMANN</h1>
                        <div class="about-main-link-butons">
                            <a href="#" class="btn btn-light mt-3  rounded-0" style="min-width: 180px;">ARTIST
                                STATEMENT</a>
                            <a href="#" class="btn btn-light mt-3  rounded-0" style="min-width: 180px;">ARTICLES</a>
                            <a href="#" class="btn btn-light mt-3  rounded-0" style="min-width: 180px;">EXHIBITIONS</a>
                            <a href="#" class="btn btn-light mt-3  rounded-0" style="min-width: 180px;">INFO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_content text-center">
            <div class="row m-0 p-0">
                <div class="col-md-6 offset-md-3 col-lg-6 offset-md-3">
                    <h2 class="pt-4 mb-4">{{$aboutPageSettings->heading}}</h2>
                    <p>{!! $aboutPageSettings->contents !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
