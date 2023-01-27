<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{getPlatformName()}} - Login </title>
    <meta name="description"
          content="">
    <meta name="author" content="{{getCopyright()}}">

    <meta property="og:title" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description"
          content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="/admin-assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/admin-assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/admin-assets/media/favicons/apple-touch-icon-180x180.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap">
    <link rel="stylesheet" id="css-main" href="/admin-assets/css/codebase.min-5.1.css">

</head>
<body>
@include('sweetalert::alert')
<div id="page-container" class="main-content-boxed">
    <main id="main-container">
        <div class="bg-body-dark">
            <div class="row mx-0 justify-content-center">
                <div class="hero-static col-lg-6 col-xl-4">
                    <div class="content content-full overflow-hidden">
                        <div class="py-4 text-center">
                            <a class="link-fx fw-bold" href="/">
                               {{-- <span class="fs-4 text-body-color">Qubit</span><span class="fs-4">Solution</span>--}}

                                <img src="/images/logo.png" width="150" alt=""/>
                            </a>
                            <h1 class="h3 fw-bold mt-4 mb-2">Welcome to {{getPlatformName()}} Dashboard</h1>
                        </div>
                        <form class="" action="/login" method="POST" enctype="multipart/form-data">
                            <div class="block block-themed block-rounded block-fx-shadow">
                                <div class="block-header bg-gd-dusk">
                                    <h3 class="block-title">Please Sign In</h3>
                                </div>
                                <div class="block-content">
                                    <div class="form-floating mb-4">
                                        <input type="email" class="form-control" id="login-username"
                                               name="email" placeholder="Enter your email" required>
                                        <label class="form-label" for="login-username">Email</label>
                                        @csrf
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control" id="login-password"
                                               name="password" placeholder="Enter your password" required>
                                        <label class="form-label" for="login-password">Password</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 d-sm-flex align-items-center push">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="login-remember-me" name="login-remember-me">
                                                <label class="form-check-label" for="login-remember-me">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-sm-end push">
                                            <button type="submit" class="btn btn-lg btn-alt-primary fw-medium">
                                                Sign In
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="block-content block-content-full bg-body-light text-center d-flex justify-content-between">
                                    {{-- <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block"
                                        href="#">
                                         <i class="fa fa-plus opacity-50 me-1"></i> Create Account
                                     </a>--}}
                                    <a class="fs-sm fw-medium link-fx text-muted me-2 mb-1 d-inline-block"
                                       href="/forget-password">
                                        Forgot Password
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="/admin-assets/js/codebase.app.min-5.1.js"></script>
<script src="/admin-assets/js/lib/jquery.min.js"></script>

</body>
</html>
