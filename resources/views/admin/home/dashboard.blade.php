@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <a class="block block-bordered block-rounded block-link-shadow text-start"
               href="javascript:void(0)">
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-semibold">{{$total_users}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Total Users</div>
                    </div>
                    <div>
                        <i class="si si-bag fa-2x opacity-25"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a class="block block-bordered block-rounded block-link-shadow text-start"
               href="javascript:void(0)">
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-semibold">{{$total_visitors}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Total Unique Visitor</div>
                    </div>
                    <div>
                        <i class="si si-wallet fa-2x opacity-25"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a class="block block-bordered block-rounded block-link-shadow text-start"
               href="javascript:void(0)">
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-semibold">{{$total_page_views}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Total page View</div>
                    </div>
                    <div>
                        <i class="si si-globe fa-2x opacity-25"></i>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-xl-3">
            <a class="block block-bordered block-rounded block-link-shadow text-start"
               href="javascript:void(0)">
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fs-3 fw-semibold">{{$today}}</div>
                        <div class="fs-sm fw-semibold text-uppercase text-muted">Today Page View</div>
                    </div>
                    <div>
                        <i class="si si-briefcase fa-2x opacity-25"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block block-bordered block-rounded">
                <div class="block-header block-header-default border-bottom">
                    <h3 class="block-title">
                        Sales <small>This week</small>
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content border-bottom">
                    <div class="row items-push text-center">
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-success">
                                <i class="fa fa-caret-up"></i> +16%
                            </div>
                            <div class="fs-4 fw-semibold">720</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">This Month</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-danger">
                                <i class="fa fa-caret-down"></i> -3%
                            </div>
                            <div class="fs-4 fw-semibold">160</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">This Week</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-success">
                                <i class="fa fa-caret-up"></i> +9%
                            </div>
                            <div class="fs-4 fw-semibold">24.3</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Average</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-danger">
                                <i class="fa fa-caret-down"></i> -6%
                            </div>
                            <div class="fs-4 fw-semibold">96.2</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">This Year</div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <canvas id="js-chartjs-classic-lines"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block block-bordered block-rounded">
                <div class="block-header block-header-default border-bottom">
                    <h3 class="block-title">
                        Earnings <small>This week</small>
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-wrench"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content border-bottom">
                    <div class="row items-push text-center">
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-success">
                                <i class="fa fa-caret-up"></i> +4%
                            </div>
                            <div class="fs-4 fw-semibold">$ 6,540</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">This Month</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-danger">
                                <i class="fa fa-caret-down"></i> -7%
                            </div>
                            <div class="fs-4 fw-semibold">$ 1,525</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">This Week</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-success">
                                <i class="fa fa-caret-up"></i> +35%
                            </div>
                            <div class="fs-4 fw-semibold">$ 9,352</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Balance</div>
                        </div>
                        <div class="col-6 col-sm-3">
                            <div class="fw-semibold text-success">
                                <i class="fa fa-caret-up"></i> +28%
                            </div>
                            <div class="fs-4 fw-semibold">$ 19k</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">This Year</div>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <canvas id="js-chartjs-classic-lines2"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="block block-bordered block-rounded">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                        <div class="mb-3">
                            <i class="si si-earphones fa-3x text-success"></i>
                        </div>
                        <div class="fs-4 fw-semibold">4.8k Songs</div>
                        <div class="text-muted">Your library is growing!</div>
                        <div class="pt-3">
                            <a class="btn btn-alt-success" href="javascript:void(0)">
                                <i class="fa fa-shopping-bag opacity-50 me-1"></i> Get more
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-bordered block-rounded">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                        <div class="mb-3">
                            <i class="si si-diamond fa-3x text-warning"></i>
                        </div>
                        <div class="fs-4 fw-semibold">7580 Points</div>
                        <div class="text-muted">Nice, you are doing great!</div>
                        <div class="pt-3">
                            <a class="btn btn-alt-warning" href="javascript:void(0)">
                                <i class="fa fa-check opacity-50 me-1"></i> Redeem them now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="block block-bordered block-rounded">
                <div class="block-content block-content-full">
                    <div class="py-3 text-center">
                        <div class="mb-3">
                            <i class="si si-grid fa-3x text-info"></i>
                        </div>
                        <div class="fs-4 fw-semibold">2 Grid Servers</div>
                        <div class="text-muted">Currently active.</div>
                        <div class="pt-3">
                            <a class="btn btn-alt-info" href="javascript:void(0)">
                                <i class="fa fa-plus opacity-50 me-1"></i> Add More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <a class="block block-bordered block-rounded" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <i class="si si-game-controller fa-2x text-body-bg-dark"></i>
                    <div class="row pt-2 pb-4 text-center">
                        <div class="col-6 border-end">
                            <div class="fs-3 fw-semibold">190</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Games</div>
                        </div>
                        <div class="col-6">
                            <div class="fs-3 fw-semibold">870</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Subscriptions</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6">
            <a class="block block-bordered block-rounded" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="text-end">
                        <i class="si si-wallet fa-2x text-body-bg-dark"></i>
                    </div>
                    <div class="row pt-2 pb-4 text-center">
                        <div class="col-6 border-end">
                            <div class="fs-3 fw-semibold">$840</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Today</div>
                        </div>
                        <div class="col-6">
                            <div class="fs-3 fw-semibold">$4,490</div>
                            <div class="fs-sm fw-semibold text-uppercase text-muted">Last Week</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
