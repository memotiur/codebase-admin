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
                @include('admin.category.create')

            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                   <table class='table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer' >
                        <thead>
                            <tr> <th> name</th>
<th> email</th>
<th> address</th>
<th> password</th>
<th> Action</th> </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $row)
                            <tr><td >{{$item->name}}</td > <td >{{$item->email}}</td > <td >{{$item->address}}</td > <td >{{$item->password}}</td > <td>
                                                <a href = "{{route('tests.edit', $item->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{route('tests.destroy', $item->id)}}" class="btn btn-sm btn-danger">Delete</a>
                                            </td></tr>

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