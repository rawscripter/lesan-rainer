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
                            <span><a target="_blank" href="//mail.google.com">Almazana@gmail.com</a></span>
                        </div>
                        <div class="contact_mail subscribe_form">
                            <p>For Invitations & Updates, feelfree to sign up to my newsletter!</p>
                            <form action="#">
                                <input type="email" placeholder="Email" name="sub_email">
                                <div class="form-group text-center mt-3">
                                    <button type="submit" class="btn btn-light rounded-0 pl-4 pr-4">SUBSCRIBE</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
@endsection
