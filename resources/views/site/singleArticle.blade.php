@extends('layouts.user.layout')
@section('body')
    <style>
        p {
            color: #fff;
            padding: 0;
            margin: 0;
        }

        h1, h2, h3, h4, h5, p {
            color: #fff;
        }

        .article-details {
            color: #fff;
            white-space: pre-wrap;
            font-size: 20px;
            line-height: 30px;
            text-align: justify;
            margin-top: -60px;
        }

        .article-details p {
            white-space: pre-wrap;
        }

    </style>
    <div class="main_content">
        <div class="row m-0 p-0">
            <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
                <div class="about_area text-center">
                    <div class="about-main-link mb-3 mt-5">
                        <h3 class="text-white"> {{$article->title}}</h3>
                        <div class="text-white m-3">
                            <p class="p-2">Published
                                On {{\Carbon\Carbon::parse($article->publish_date)->format('d M Y')}},</p>
                            {!! $article->news_source !!}
                        </div>

                        <p>
                            <a href="{{$article->original_link}}" class="text-white m-3">Read Original Article</a>
                        </p>
                    </div>
                    <div class="about_image mt-4">
                        <img width="100%"
                             src="/images/arts/{{$article->image}}" alt="">
                    </div>
                    <div class="article-details show-text-as-white-space">
                        <p> {!! $article->details !!}</p>
                    </div>
                    <br>

                    <div class="back-to-articles mb-5">
                        <a href="{{route('articles')}}" class="btn btn-secondary">Back To Articles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
