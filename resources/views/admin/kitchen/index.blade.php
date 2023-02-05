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
                Kitchen <small>Table</small>


                <button type="button" class="btn btn-alt-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#modalCreate">
                    <i class="fa fa-plus"></i> New
                </button>
                @include('admin.kitchen.create')

            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                <table class='table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer' >
                        <thead>
                            <tr> <th> kitchen_name</th>
<th> address</th>
<th> is_active</th>
<th> Action</th> </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $item)
                            <tr><td >{{$item->kitchen_name}}</td > <td >{{$item->address}}</td > <td >{{$item->is_active}}</td > <td>
                             <div class='btn-group'>
                                    <button type='button' class='btn btn-sm btn-secondary js-bs-tooltip-enabled'
                                            href='{{ route('kitchens.edit', $item ) }}' data-bs-toggle='modal'
                                            data-bs-target='#modalEdit{{$item->id}}'>
                                                <i class='fa fa-pencil-alt'></i>
                                    </button>

                                    <form action='' method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class='btn btn-sm btn-secondary js-bs-tooltip-enabled'
                                                data-toggle='tooltip'>
                                            <i class='fa fa-close'></i>
                                        </button>
                                    </form>
                                </div>
                            </td></tr>
 @include('admin.kitchen.edit')
                        @endforeach
                        </tbody>
                    </table>
  {{ $results->appends(request()->query())->links('pagination::bootstrap-4') }}

            </div>
        </div>


    </div>





    @push('footer-scripts')
        @once

        @endonce
    @endpush

@endsection
