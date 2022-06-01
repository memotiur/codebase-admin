<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield("title")</title>
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
<div id="page-container"
     class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

    @include('includes.admin.sidebar')

    <header id="page-header">
        <div class="content-header">
            <div class="d-flex align-items-center space-x-2">
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                        data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <button type="button" class="btn btn-sm btn-alt-secondary d-sm-none" data-toggle="layout"
                        data-action="header_search_on">
                    <i class="fa fa-fw fa-search"></i>
                </button>
                <form class="d-none d-sm-inline-block" action="/dashboard" method="POST" onsubmit="return false;">
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control" placeholder="Search..">
                        <span class="input-group-text">
            <i class="fa fa-search"></i>
          </span>
                    </div>
                </form>
            </div>
            <div class="space-x-1">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fw-semibold">Admin</span>
                        <i class="fa fa-angle-down opacity-50 ms-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0"
                         aria-labelledby="page-header-user-dropdown">
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                               href="be_pages_generic_profile.html">
                                <span>Profile</span>
                                <i class="fa fa-fw fa-user opacity-25"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                               href="be_pages_generic_inbox.html">
                                <span>Inbox</span>
                                <i class="fa fa-fw fa-envelope-open opacity-25"></i>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                               href="be_pages_generic_invoice.html">
                                <span>Invoices</span>
                                <i class="fa fa-fw fa-file opacity-25"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                               href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                                <span>Settings</span>
                                <i class="fa fa-fw fa-wrench opacity-25"></i>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1"
                               href="/log-out">
                                <span>Sign Out</span>
                                <i class="fa fa-fw fa-sign-out-alt opacity-25"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout"
                        data-action="side_overlay_toggle">
                    <i class="fa fa-fw fa-list"></i>
                </button>
            </div>
        </div>
        <div id="page-header-search" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <form class="w-100" action="be_pages_generic_search.html" method="POST">
                    <div class="input-group">
                        <button type="button" class="btn btn-secondary" data-toggle="layout"
                                data-action="header_search_off">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                        <input type="text" class="form-control" placeholder="Search or hit ESC.."
                               id="page-header-search-input" name="page-header-search-input">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div id="page-header-loader" class="overlay-header bg-primary">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="far fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
    </header>
    <main id="main-container">
        <div class="content">

            @yield("content")

        </div>
    </main>
    <footer id="page-footer" class="bg-body-extra-light">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                                                                               href="https://1.envato.market/ydb"
                                                                               target="_blank">pixelcave</a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    <a class="fw-semibold" href="https://1.envato.market/95j" target="_blank">Codebase 5.1</a> &copy;
                    <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="/admin-assets/js/codebase.app.min-5.1.js"></script>

<!--Start js Code For This Page-->
<script src="/admin-assets/js/chart.min.js"></script>
<script src="/admin-assets/js/pages/db_classic.min.js"></script>
<!--Start js Code For This Page-->


</body>
</html>
