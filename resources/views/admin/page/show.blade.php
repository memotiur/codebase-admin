@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    @push('header-scripts')
        @once
            <link rel="stylesheet" href="/admin-assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css">
            <link rel="stylesheet"
                  href="/admin-assets/js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css">
            <link rel="stylesheet"
                  href="/admin-assets/js/plugins/datatables-responsive-bs5/css/responsive.bootstrap5.min.css">
        @endonce
    @endpush


    {{--    <h2 class="content-heading">DataTables Plugin</h2>--}}


    <div class="block block-rounded">


        <div class="block-header block-header-default">
            <h3 class="block-title">
                Page <small>Table</small>


                <a href="/pages/create" class="btn btn-alt-primary float-end">
                    <i class="fa fa-plus"></i> New
                </a>

            </h3>
        </div>


        <div class="block-content block-content-full">

            <div class="row">

                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer"
                       id="DataTables_Table_1">
                    <thead>
                    <tr>
                        <th class="text-center">Position</th>
                        <th>Page Title</th>
                        <th>Details</th>
                        <th>Status</th>

                        <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $i = 1?>
                    @foreach($pages as $item)
                        <tr>

                            <td>{{getPosition($item->position)}}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                <a href="/page/{{$item->slug}}" target="_blank">Details</a>
                            </td>
                            <td class="d-none d-sm-table-cell">

                                @if($item->is_active==1)
                                    <span class="badge bg-primary">Yes  </span>
                                @else
                                    <span class="badge bg-danger">No  </span>
                                @endif

                            </td>
                            <td class="text-center">


                                <div class="btn-group">

                                    <form action="{{ route('pages.edit', $item ) }}" method="POST">
                                        @csrf
                                        @method("GET")
                                        <button type="submit" class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                data-toggle="tooltip"
                                                title="View Customer">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </form>


                                    <form action="{{ route('pages.destroy', $item ) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                data-toggle="tooltip"
                                                title="View Customer">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </form>
                                </div>


                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>


    </div>





    @push('footer-scripts')
        @once
            <!--Start JS for This Page-->
            <script src="/admin-assets/js/lib/jquery.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons/dataTables.buttons.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons-jszip/jszip.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons-pdfmake/pdfmake.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons-pdfmake/vfs_fonts.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons/buttons.print.min.js"></script>
            <script src="/admin-assets/js/plugins/datatables-buttons/buttons.html5.min.js"></script>
            <script src="/admin-assets/js/pages/be_tables_datatables.min.js"></script>
            <!--End JS for This Page-->
        @endonce
    @endpush

@endsection
