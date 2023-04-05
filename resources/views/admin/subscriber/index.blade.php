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

            <form action="/subscribers" method="get">

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
                Subscriber <small>Table</small>


                <button type="button" class="btn btn-alt-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#modalCreate">
                    <i class="fa fa-plus"></i> New
                </button>
                @include('admin.subscriber.create')

            </h3>
        </div>

        <div class="block-content block-content-full">

            <div class="row">

                <table class='table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer' >
                        <thead>
                            <tr> <th> name</th>
<th> email</th>
<th> phone</th>
<th> password</th>
<th> photo</th>
<th> unique_id</th>
<th> api_version</th>
<th> is_verified</th>
<th> is_active</th>
<th> is_google_login</th>
<th> is_deleted</th>
<th> Action</th> </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $item)
                            <tr><td >{{$item->name}}</td > <td >{{$item->email}}</td > <td >{{$item->phone}}</td > <td >{{$item->password}}</td > <td >{{$item->photo}}</td > <td >{{$item->unique_id}}</td > <td >{{$item->api_version}}</td > <td >{{$item->is_verified}}</td > <td >{{$item->is_active}}</td > <td >{{$item->is_google_login}}</td > <td >{{$item->is_deleted}}</td > <td>
                             <div class='btn-group'>
                                    <button type='button' class='btn btn-sm btn-secondary js-bs-tooltip-enabled'
                                            href='{{ route('subscribers.edit', $item ) }}' data-bs-toggle='modal'
                                            data-bs-target='#modalEdit{{$item->id}}'>
                                                <i class='fa fa-pencil-alt'></i>
                                    </button>


                                    <form action='{{ route('subscribers.destroy', $item ) }}' method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class='btn btn-sm btn-secondary js-bs-tooltip-enabled'
                                                data-toggle='tooltip'>
                                            <i class='fa fa-close'></i>
                                        </button>
                                    </form>
                                </div>
                            </td></tr>
 @include('admin.subscriber.edit')
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
