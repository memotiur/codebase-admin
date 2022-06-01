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
                                <i class="fa fa-fire"></i>
                                {{-- <span class="fs-4 text-body-color">code</span><span class="fs-4">base</span>--}}
                            </a>
                            <h1 class="h3 fw-bold mt-4 mb-2">Welcome to {{getPlatformName()}} Dashboard</h1>
                        </div>
                        <form class="" action="/reset-password/{{$id}}" method="POST" enctype="multipart/form-data">
                            <div class="block block-themed block-rounded block-fx-shadow">
                                <div class="block-header bg-gd-dusk">
                                    <h3 class="block-title">New Password</h3>
                                </div>
                                <div class="block-content">
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control" id="login-username"
                                               name="password" placeholder="New password" required>
                                        <label class="form-label" for="login-username">New Password</label>

                                        <input type="hidden" name="id" value="{{$id}}">
                                        @csrf
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2 d-sm-flex align-items-center push">

                                        </div>
                                        <div class="col-sm-10 text-sm-end push">
                                            <button type="submit" class="btn btn-lg btn-alt-primary fw-medium">
                                                Reset
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
                                       href="/login">
                                        Login to Continue
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
