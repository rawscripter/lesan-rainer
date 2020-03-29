@extends('layouts.user.layout')
@section('body')

    <style>
        .alert-success {
            color: #155724;
            background-color: #e7ffedbf;
            border-color: #c3e6cb;
            border-left: 7px solid;
        }
    </style>
    <div class="main_content">
        <div class="contact_content">
            <div class="container">
                <div class="row m-0 p-0">
                    <div class="col-12">
                        @if(Session::has('success'))
                            <div class="row">
                                <div class="col-md-12 m-auto">
                                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-7 col-lg-7">
                        <div class="contact_form">
                            <form action='{{route('contact.mail')}}' method="POST" id="contactForm">
                                <div class=""><input type="text" required placeholder="Name" name="name"></div>
                                <div class=""><input type="text" required placeholder="Email" name="email"></div>
                                <div class=""><input type="text" required placeholder="Phone" name="phone"></div>
                                <div class=""><textarea required name="message" rows="5"
                                                        placeholder="Message"></textarea></div>
                                <div class="form-group mt-2">
                                    <button type="submit" class="btn btn-light rounded-0 pl-4 pr-4">SEND MESSAGE
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1 col-lg-1"></div>
                    <div class="col-md-4 col-lg-4 ">
                        <div class="contact_mail">
                            <img style="width: 20%;" src="{{asset('assets/user/images/icon/Email Icon.svg')}}" alt="">
                            <span><a target="_blank" href="//mail.google.com">Rainerlagemann@me.com</a></span>
                        </div>
                        <div class="contact_mail subscribe_form">
                            <p>Feel free to sign up for our newsletter!</p>
                            <div class="form-group text-center mt-3">
                                <form id="subscribe_from" method="post" action="https://oi.vresp.com?fid=22709e0d55"
                                      target="vr_optin_popup"
                                      onsubmit="window.open( 'http://www.verticalresponse.com', 'vr_optin_popup', 'scrollbars=yes,width=600,height=450' ); return true;">
                                    <div>
                                        <input type="submit" value="Sign Up" class="btn-light"  style="border: 1px solid #999; padding: 5px;"/><br/>
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
@endsection
