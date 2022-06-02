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


    <h2 class="content-heading">DataTables Plugin</h2>


    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Dynamic Table <small>Export Buttons</small>
            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer"
                       id="DataTables_Table_1">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Geadline</th>
                        <th class="d-none d-sm-table-cell">Status</th>

                        <th class="text-center" style="width: 15%;">Profile</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $i=1?>
                    @foreach($result as $item)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="font-w600">{{$item->post_title}}</td>
                            <td class="d-none d-sm-table-cell">
                                <span class="badge bg-primary">{{ $item->publish_status }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('posts.destroy', $item ) }}" class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                        title="View Customer">
                                    <i class="fa fa-delete-left"></i>
                                </a>
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