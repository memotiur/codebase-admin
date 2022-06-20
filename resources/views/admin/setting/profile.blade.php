@extends("layouts.admin")
@section('title', 'Admin Panel - Profile')
@section("content")

    @push('header-scripts')
        @once

        @endonce
    @endpush


    {{--    <h2 class="content-heading">Category Table</h2>--}}

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        Profile
                    </h3>

                </div>

                <div class="block-content block-content-full">

                    <div class="row">


                        <form action="/profile-update" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group row">
                                <label for="name" class="col-sm-1-12 col-form-label">Name</label>
                                <div class="col-sm-12 mb-2">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{Auth::user()->name}}">
                                </div>
                            </div>
                            <div class="input-group row">
                                <label for="email" class="col-sm-1-12 col-form-label">Email</label>
                                <div class="col-sm-12 mb-2">
                                    <input type="email" class="form-control" name="email" id="email"
                                           placeholder="Email" value="{{Auth::user()->email}}">
                                </div>
                            </div>

                            <div class="input-group row" id="change-btn">
                                <div class="col-sm-12 mb-2">
                                    <button type="button" class="btn btn-primary" onclick="changePassword()">Change
                                        Password
                                    </button>
                                </div>
                            </div>

                            <div class="input-group row" id="password-form">
                                <label for="password" class="col-sm-1-12 col-form-label">Password</label>
                                <div class="col-sm-12 mb-2">
                                    <input type="password" class="form-control" name="password" id="password"
                                           placeholder="Email">
                                </div>
                            </div>

                            <div class="input-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary">Update</button>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>


            </div>


        </div>

    </div>





    @push('footer-scripts')
        @once

            <script>

                document.getElementById("password-form").style.display = "none";

                function changePassword() {
                    document.getElementById("change-btn").style.display = "none";
                    document.getElementById("password-form").style.display = "block";
                }

            </script>
        @endonce
    @endpush

@endsection
