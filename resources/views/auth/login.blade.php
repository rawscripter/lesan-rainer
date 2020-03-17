<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <h4>Admin Dashboard</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>

                        <div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <form method="POST" action="{{ route('login') }}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <input type="email" required
                                       class="form-control form-control-lg"
                                       id="exampleInputEmail1"
                                       placeholder="email"
                                       name="email"
                                >
                            </div>
                            <div class="form-group">
                                <input type="password" required
                                       name="password"
                                       class="form-control form-control-lg"
                                       id="exampleInputPassword1"
                                       placeholder="Password">
                            </div>
                            <div class="mt-3">
                                <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('assets/admin/vendors/js/vendor.bundle.addons.js')}}"></script>
<script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/admin/js/settings.js')}}"></script>
<script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
<!-- endinject -->
</body>
</html>
