<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/iconfonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/lightgallery/css/lightgallery.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">

    <!-- endinject -->
    @yield('head')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="/admin">
                Rainer
            </a>
            <a class="navbar-brand brand-logo-mini" href="/admin">
                Rainer
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="fas fa-bars"></span>
            </button>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="fas fa-bars"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-image">
                            <img src="{{asset('assets/admin/images/faces/face5.jpg')}}" alt="image"/>
                        </div>
                        <div class="profile-name">
                            <p class="name">
                                {{auth()->user()->name}}
                            </p>
                            <p class="designation">
                                {{auth()->user()->email}}
                            </p>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{isset($page) ? $page == 'dashboard' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('admin.home')}}">
                        <i class="fa fa-home menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>


                <li class="nav-item {{isset($page) ? $page == 'collections' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('collections.index')}}">
                        <i class="fab fa-trello menu-icon"></i>
                        <span class="menu-title">Sculptures</span>
                    </a>
                </li>


                <li class="nav-item {{isset($page) ? $page == 'arts' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('arts.index')}}">
                        <i class="fab fa-wpforms menu-icon"></i>
                        <span class="menu-title">Art Works</span>
                    </a>
                </li>
                <li class="nav-item {{isset($page) ? $page == 'installations' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('installations.index')}}">
                        <i class="fab fa-wpforms menu-icon"></i>
                        <span class="menu-title">Installations</span>
                    </a>
                </li>

                <li class="nav-item {{isset($page) ? $page == 'articles' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('articles.index')}}">
                        <i class="fab fa-wpforms menu-icon"></i>
                        <span class="menu-title">Articles</span>
                    </a>
                </li>


                <li class="nav-item {{isset($page) ? $page == 'exhibitions' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('exhibitions.index')}}">
                        <i class="fab fa-wpforms menu-icon"></i>
                        <span class="menu-title">Exhibitions</span>
                    </a>
                </li>

                {{--				<li class="nav-item {{isset($page) ? $page == 'uploads' ? 'active' : '' :'' }}">--}}
                {{--					<a class="nav-link" href="{{route('admin.uploads')}}">--}}
                {{--						<i class="fas fa-window-restore menu-icon"></i>--}}
                {{--						<span class="menu-title">Uploads</span>--}}
                {{--					</a>--}}
                {{--				</li>--}}

                <li class="nav-item {{isset($page) ? $page == 'settings' ? 'active' : '' :'' }}">
                    <a class="nav-link collapsed" data-toggle="collapse" href="#editors" aria-expanded="false"
                       aria-controls="editors">
                        <i class="fas fa-pen-square menu-icon"></i>
                        <span class="menu-title">Settings</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="editors" style="">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"><a class="nav-link" href="{{route('admin.home.page.settings')}}">Home
                                    Page</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('admin.about.page.settings')}}">About
                                    Us</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{isset($page) ? $page == 'archives' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('admin.archives')}}">
                        <i class="fab fas fa-hourglass-half menu-icon"></i>
                        <span class="menu-title">Archives</span>
                    </a>
                </li>
                <li class="nav-item {{isset($page) ? $page == 'logs' ? 'active' : '' :'' }}">
                    <a class="nav-link" href="{{route('admin.logs')}}">
                        <i class="fas fa-chart-pie menu-icon"></i>
                        <span class="menu-title">Activities</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                       href="javascript:void(0)">
                        <i class="fa fa-power-off menu-icon"></i>
                        <span class="menu-title">Logout</span>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->

        <div class="main-panel">

            @yield('content')

            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                        Having Issues? Please contact  <a
                            href="mailto:Lesan@tridedesigns.com">Lesan@tridedesigns.com</a>   </span>

                </div>
            </footer>
        </div>
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
<script src="{{asset('assets/admin/js/dropify.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('select.select2').select2();
        $('table.dataTable').DataTable({
            "order": [[0, "desc"]]
        });
    });
</script>
@yield('footer')
</body>

</html>
