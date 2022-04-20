<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Mobl</title>
    <link rel="icon" type="image/x-icon" href="{{url('images/favicon.ico')}}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="#page-top">
                <img src="{{url('images/logo.png')}}" alt="logo" width="110">
            </a>
            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button> --}}
            {{-- <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#features">About</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Login</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Sign up</a></li>
                </ul>
                <!-- <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                    <span class="d-flex align-items-center">
                        <i class="bi-chat-text-fill me-2"></i>
                        <span class="small">Send Feedback</span>
                    </span>
                </button> -->
            </div> --}}
        </div>
    </nav>
    <!-- Navigation-->
    @yield('content')
    <footer class="bg-footer text-center py-5">

        <div class="container px-5">
            <hr class="bg-light">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between text-white">

                <div class="col-12 col-lg-4">

                    <a class="m-sm-3 text-white"><i class="rounded-circle bi-facebook icon-feature2 mb-3"></i></a>
                    <a class="m-sm-3 text-white"><i class="rounded-circle bi-linkedin icon-feature2 mb-3"></i></a>
                    <a class="m-sm-3 text-white"><i class="rounded-circle bi bi-telegram icon-feature2 mb-3"></i></a>
                    <a class="m-sm-3 text-white"><i class="rounded-circle bi-twitter icon-feature2 mb-3"></i></a>
                </div>
                <div class="col-12 col-lg-4">
                    <h4 class="font-alt display-4 lh-1 mb-4">mobl.</h4>
                </div>
                <div class="col-12 col-lg-4">
                    {{-- <a href="#!" class="text-white">T&C</a>
                    <span class="mx-1"> </span>
                    <a href="#!" class="text-white">Blog</a>
                    <span class="mx-1"> </span>
                    <a href="#!" class="text-white">Media</a>
                    <span class="mx-1"> </span>
                    <a href="#!" class="text-white">CSR</a> --}}
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-white small">
                <div class="mb-2">Copyright &copy; {{date('Y')}} mobl. All Rights Reserved.</div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('bodyscript')
</body>

</html>