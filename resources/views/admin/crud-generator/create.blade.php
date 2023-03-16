@extends("layouts.admin")
@section('title', 'Admin Panel')
@section("content")

    @push('header-scripts')
        @once

        @endonce
    @endpush


    {{--    <h2 class="content-heading">Category Table</h2>--}}


    <div class="block block-rounded" ng-app="myApp" ng-controller="myCtrl">
        <div class="block-header block-header-default">
            <h3 class="block-title">
                Crud <small>Generator</small>

            </h3>
        </div>

        <div class="block-content block-content-full">
            <form action="/crud-generator/start" method="POST"
                  enctype="multipart/form-data">
                <div class="row">
                    @csrf

                    <div class="col-md-3">
                        <div class="col-12">
                            <label class="" for="model_name">Model Name</label>
                            <input type="text" class="form-control" id="model_name" name="model_name"
                                   placeholder="Model Name">
                        </div>

                        <div class="col-12 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="middleware"
                                       name="middleware">
                                <label class="form-check-label" for="middleware">Create Middleware</label>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-9">
                        <div class="row" ng-repeat="item in field" ng-cloak>
                            <div class="col">
                                <label class="" for="column">Col Name</label>
                                <input type="text" class="form-control" id="column" name="column[]"
                                       value="@{{ item.column }}"
                                       placeholder="Column Name">
                            </div>
                            <div class="col">
                                <label class="" for="column_type">Col Type</label>
                                <select class="form-select" id="column_type" name="column_type[]">
                                    @foreach(getColumnType() as $item)
                                        <option>{{$item}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col">
                                <label class="" for="type">Type</label>
                                <select class="form-select" id="type" name="type[]">
                                    <option value="">Required</option>
                                    <option value="nullable">Nullable</option>
                                    <option value="unique">Unique</option>
                                </select>
                            </div>

                            <div class="col">
                                <label class="" for="input_type">Form Type</label>
                                <select class="form-select" id="input_type" name="input_type[]">
                                    <option value="1">Text</option>
                                    <option value="2">Select</option>
                                    <option value="3">Textarea</option>
                                </select>
                            </div>

                            <div class="col">
                                <label class="" for="default_value">Default Value</label>
                                <input type="text" class="form-control" id="default_value" name="default_value[]"
                                       value="@{{ item.default_value }}">
                            </div>

                            <div class="col">
                                <label class="" for="is_foreign">Is Foreign</label>
                                <select class="form-select" id="is_foreign" name="is_foreign[]">
                                    <option value="">No</option>
                                    <option value="1">Yes</option>

                                </select>
                            </div>

                            <div class="col">
                                <button type="button" class="btn btn-alt-danger mt-4"
                                        ng-click="removeItem($index)">
                                    X
                                </button>

                            </div>
                        </div>
                        <button type="button" class="btn btn-alt-primary mt-2" ng-click="addNewItem()">+</button>

                    </div>


                </div>


                <button type="submit" class="btn btn-alt-primary">
                    Save
                </button>
            </form>
        </div>


    </div>


    {{--@if( count($field)<1)
                     $scope.field = [{}];
                 @else
                     $scope.field = <?php echo $field ?>;
                 @endif--}}


    @push('footer-scripts')
        @once
            <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
            <script>
                var app = angular.module('myApp', []);
                app.controller('myCtrl', function ($scope, $http) {

                    $scope.field = [{}];
                    $scope.addNewItem = function () {
                        console.log("clicked")
                        var item = $scope.field.length + 1;
                        $scope.field.push({'colId': 'col' + item});
                    };
                    $scope.removeItem = function (index) {
                        // remove the row specified in index
                        $scope.field.splice(index, 1);
                    };
                    //Items Activity End


                });

            </script>

        @endonce
    @endpush

@endsection
