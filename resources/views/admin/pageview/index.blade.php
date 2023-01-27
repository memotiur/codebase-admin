@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    <style>
        .modal-content {
            background-color: #fff;

        }
    </style>
    <div class="block block-rounded">

        <div class="block-content block-content-full">

            <form class="row g-3 align-items-center" method="GET" enctype="multipart/form-data">

                <div class="block block-rounded shadow-none mb-0">

                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id="ip_address" placeholder="IP" value="{{$request['ip_address']}}" name="ip_address">
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="date" name="date" value="{{$request['date']}}" placeholder="Date">
                        </div>

                        <div class="col">
                            <button type="submit" class="btn btn-alt-primary" data-bs-dismiss="modal">
                                Search
                            </button>
                        </div>
                    </div>


                </div>
            </form>

        </div>
    </div>



    <div class="block block-rounded">


        <div class="block-header block-header-default">
            <h3 class="block-title">
                Page View - <small>Total: {{$count}}</small>

            </h3>
        </div>


        <div class="block-content block-content-full">

            <div class="row">

                <!-- DataTables functionality is initialized with .js-dataTable-full class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer"
                       id="DataTables_Table_1">
                    <thead>
                        <tr>

                            <th>IP</th>
                            <th>Details</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1 ?>
                        @foreach($results as $item)
                            <tr>

                                <td><a href="/traffic?ip_address={{$item->ip_address}}"/>{{$item->ip_address}} </td>
                                </td>
                                <td>
                                    <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#myModal{{$item->id}}">
                                        Deatils
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal{{$item->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title"></h4>
                                                    <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">


                                                        <?php

                                                        $data = json_decode($item->details, true);
                                                        ?>

                                                    <pre>  <?php print_r($data) ?></pre>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td>{{ getDateFormat($item->created_at) }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>


                {{ $results->appends(request()->query())->links("pagination::bootstrap-4") }}
            </div>
        </div>


    </div>

@endsection
