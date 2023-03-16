@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    @push('header-scripts')
        @once

        @endonce
    @endpush


    {{--    <h2 class="content-heading">Category Table</h2>--}}
    <div class="block block-rounded">
        <div class="block-content block-content-full">

            <form action="/route" method="get">

                <div class="row">

                    <div class="col">
                        <input name="search" type="text" class="form-control" placeholder="">
                    </div>


                    <div class="col">
                        <button type="submit" class="btn btn-alt-primary">Search</button>
                    </div>
                </div>

            </form>

        </div>
    </div>



    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                crud_title <small>Table</small>


                <button type="button" class="btn btn-alt-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#modalCreate">
                    <i class="fa fa-plus"></i> New
                </button>
                @include('create_include')

            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                table_data

            </div>
        </div>


    </div>





    @push('footer-scripts')
        @once

        @endonce
    @endpush

@endsection
