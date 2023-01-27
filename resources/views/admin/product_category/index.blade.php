@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    @push('header-scripts')
        @once

        @endonce
    @endpush


    {{--    <h2 class="content-heading">Category Table</h2>--}}


    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Category <small>Table</small>


                <button type="button" class="btn btn-alt-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#modalCreate">
                    <i class="fa fa-plus"></i> New
                </button>
                @include('admin.product_category.create')


            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer"
                       id="DataTables_Table_1">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Title</th>
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
                            <td class="font-w600">{{$item->title}}</td>
                            <td><img src="{{$item->featured_image}}" width="50"/></td>
                            <td class="d-none d-sm-table-cell">
                                @if( $item->is_active)
                                    <span class="badge bg-primary">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                            href="{{ route('product-categories.edit', $item ) }}" data-bs-toggle="modal"
                                            data-bs-target="#modal{{$item->id}}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>

                                    <form action="{{ route('product-categories.destroy', $item ) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-sm btn-secondary js-bs-tooltip-enabled"
                                                data-toggle="tooltip"
                                                title="View Customer">
                                            <i class="fa fa-close"></i>
                                        </button>
                                    </form>
                                </div>

                                @include('admin.product_category.edit')

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

        @endonce
    @endpush

@endsection
