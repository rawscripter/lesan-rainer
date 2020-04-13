@extends('layouts.user.layout')
@section('body')
    <style>
        .modal-dialog {
            max-width: 1100px !important;
        }
    </style>
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
                            <a href="#" data-toggle="modal" data-target="#statementModal"
                               class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">ARTIST
                                STATEMENT</a>
                            <a href="{{route('articles')}}" class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">ARTICLES</a>
                            <a href="{{route('exhibitions')}}" class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">EXHIBITIONS</a>
                            <a href="{{$aboutPageSettings->info_url}}" class="btn btn-light mt-3  rounded-0"
                               style="min-width: 180px;">INFO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about_content text-center">
            <div class="row m-0 p-0">
                <div class="col-md-6 offset-md-3 col-lg-6 offset-md-3">
                    <h2 class="pt-4 mb-4">{{$aboutPageSettings->heading}}</h2>
                    <p class="show-text-as-white-space">{!! $aboutPageSettings->contents !!}</p>
                </div>
            </div>
        </div>

        <div class=" text-center">
            <div class="row mb-5 p-0">
                <div class="col-md-6 m-auto">
                    <div class="contact_mail subscribe_form">
                        <div class="row">
                            <div class="col-6 p-4"><p>Feel free to sign up for our newsletter!</p>
                            </div>
                            <div class="col-6">
                                <div class="form-group text-center mt-4">
                                    <form id="subscribe_from" method="post" action="https://oi.vresp.com?fid=22709e0d55"
                                          target="vr_optin_popup"
                                          onsubmit="window.open( 'http://www.verticalresponse.com', 'vr_optin_popup', 'scrollbars=yes,width=600,height=450' ); return true;">
                                        <div>
                                            <input type="submit" value="Sign Up" class="btn-light"
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

    {{--    modal --}}

    <style>
        .modal-open .modal {
            background-color: transparent !important;
        }

        button.close {
            position: absolute;
            top: 0;
            right: 10px;
        }

        .modal-header {
            padding: 0;
            margin: 0;
        }
    </style>
    <div class="modal fade bd-example-modal-xl" tabindex="-1" id="statementModal" role="dialog"
         aria-labelledby="myExtraLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row m-0 p-0">
                        <div class="col-lg-12 col-md-12 ml-auto text-center">
                            <h1 class="text-white">ARTIST STATEMENT</h1>
                            <br>
                            <p class="text-white lead show-text-as-white-space">
                                {!! $aboutPageSettings->statement !!}
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
