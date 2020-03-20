@extends('layouts.user.layout')
@section('body')
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
                            <a href="{{route('site.installations')}}" class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">ARTIST
                                STATEMENT</a>
                            <a href="{{route('articles')}}" class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">ARTICLES</a>
                            <a href="{{route('exhibitions')}}" class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">EXHIBITIONS</a>
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

        <div class=" text-center">
            <div class="row m-0 p-0">
                <div class="col-md-6 m-auto">
                    <div class="contact_mail subscribe_form">

                        <div class="row">
                            <div class="col-6 p-4"><p>For Invitations & Updates, feelfree to sign up to my newsletter!</p>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-center mt-4">
                                    <form id="subscribe_from" method="post" action="https://oi.vresp.com?fid=22709e0d55"
                                          target="vr_optin_popup"
                                          onsubmit="window.open( 'http://www.verticalresponse.com', 'vr_optin_popup', 'scrollbars=yes,width=600,height=450' ); return true;">
                                        <div>
                                            <input type="submit" value="Sign Up"
                                                   style="border: 1px solid #999; padding: 5px;"/><br/>
                                            <br/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
