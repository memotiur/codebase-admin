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


    {{--    <h2 class="content-heading">User Table</h2>--}}


    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                User <small>Table</small>


                <button type="button" class="btn btn-alt-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#modalCreate">
                    <i class="fa fa-plus"></i> New
                </button>
                @include('admin.user.create')


            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer"
                       id="DataTables_Table_1">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th class="d-none d-sm-table-cell">Status</th>

                        <th class="text-center" style="width: 15%;">Profile</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $i = 1?>
                    @foreach($results as $item)
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td class="font-w600">{{$item->name}}</td>
                            <td class="font-w600">{{$item->email}}</td>
                            <td><img src="{{$item->profile_pic}}" width="50"/></td>
                            <td class="d-none d-sm-table-cell">
                                @if( $item->user_type==1)
                                    <span class="badge bg-primary">Admin</span>
                                @else
                                    <span class="badge bg-danger">Operator</span>
                                @endif
                            </td>
                            <td class="">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                            href="{{ route('users.edit', $item ) }}" data-bs-toggle="modal"
                                            data-bs-target="#modal{{$item->id}}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('users.destroy', $item ) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                data-toggle="tooltip"
                                                title="View Customer">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </form>
                                </div>

                                @include('admin.user.edit')

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
