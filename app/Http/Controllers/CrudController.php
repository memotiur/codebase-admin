<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use ZipArchive;

class CrudController extends Controller
{

    public function crudGenerator()
    {
        return view('admin.crud-generator.create');

    }

    public function crudGeneratorStart(Request $request)
    {

        //return $request->all();
        $model_name = $request['model_name'];
        $schema = "";
        $count = 0;
        $columns = [];
        foreach ($request['column'] as $key => $value) {

            $type = $request['type'][$key];
            if ($type == null) {
                $type = "";
            } else {
                $type = ":" . $request['type'][$key];
            }
            ##Default  Value##
            $default_value = $request['default_value'][$key];
            if ($default_value == null) {
                $default_value = "";
            } else {
                $default_value = ":default(" . $request['default_value'][$key] . ")";
            }

            ##Foreign ##
            $is_foreign = $request['is_foreign'][$key];
            if ($is_foreign == null) {
                $is_foreign = "";
            } else {
                $is_foreign = ":foreign";
            }

            if ($count == 0) {
                $schema .= $request['column'][$key] . ":" . $request['column_type'][$key] . $type . $default_value . $is_foreign;
            } else {
                $schema .= ',' . $request['column'][$key] . ":" . $request['column_type'][$key] . $type . $default_value . $is_foreign;
            }
            $count++;
            $columns[] = $value;
        }


        //return $schema;
        $columns = json_encode($columns);

        $route_path = preg_replace("/[A-Z]/", "-\$0", $model_name);
        $route_path = substr(strtolower($route_path), 1) . "s";
        $view_path = preg_replace("/[A-Z]/", "_\$0", $model_name);
        $view_path = substr(strtolower($view_path), 1);
        $table_name = $view_path . "s";

        $controller_name = '\App\Http\Controllers\\' . $model_name . 'Controller::class';


        try {
            if ($request['middleware'] == 1) {
                Artisan::call('make:middleware ' . $model_name . 'Middleware');
            }

            //Artisan::call('make:model ' . $model_name . ' -mcr');//Migration, Model ,Controller
            Artisan::call('make:model ' . $model_name . ' -cr');

            $this->deleteTable($table_name);
            //Create Migration
            $migrations = glob(database_path('migrations/*_create_' . $table_name . '_table.php'));
            if (count($migrations) > 0) {
                try {
                    File::delete($migrations[0]);
                } catch (\Exception $e) {
                }
            }
            Artisan::call('make:migration:schema create_' . $table_name . '_table --schema=' . $schema);
            /*Edit Migration File*/
            $migrations = glob(database_path('migrations/*_create_' . $table_name . '_table.php'));
            $migration_file = File::get($migrations[0]);
            $migration_file = str_replace("use Illuminate\Database\Migrations\Migration;", "use Illuminate\Database\Migrations\Migration;\nuse Illuminate\Support\Facades\Schema;", $migration_file);
            $migration_file = str_replace("Schema::dropIfExists('kitchens');", "Schema::dropIfExists('" . $table_name . "');", $migration_file);
            $migration_file = str_replace("bigIncrements('id');", "id();", $migration_file);
            File::put($migrations[0], $migration_file);

            Artisan::call('migrate');//Need to change
            //Artisan::call('migrate:refresh', ['--seed' => true]);//Need to change

            if (!File::exists(resource_path('views/' . $view_path . '/index.blade.php'))) {
                File::makeDirectory(resource_path('views/admin/' . $view_path), 0777, true, true);
                File::put(resource_path('views/admin/' . $view_path . '/index.blade.php'), "");

                File::put(resource_path('views/admin/' . $view_path . '/create.blade.php'), "");
                File::put(resource_path('views/admin/' . $view_path . '/edit.blade.php'), "");
            }

            //Update Model
            $model_file = File::get(app_path('Models/' . $model_name . '.php'));
            $model_file = str_replace("protected \$fillable = [];", "protected \$fillable = $columns;\n\t protected \$table = '$table_name';", $model_file);
            File::put(app_path('Models/' . $model_name . '.php'), $model_file);


            //Create Route
            if (!Route::has($route_path . ".index")) {
                $routes = File::get(base_path('routes/web.php'));
                $route = "\nRoute::resource('/$route_path', $controller_name);";
                $routes .= $route;
                File::put(base_path('routes/web.php'), $routes);
            }

            //Update View File

            $view_path = preg_replace("/[A-Z]/", "_\$0", $model_name);
            $view_path = substr(strtolower($view_path), 1);
            $route_path = preg_replace("/[A-Z]/", "-\$0", $model_name);
            $route_path = substr(strtolower($route_path), 1) . "s";


            $success = File::copy(resource_path('views/admin/crud-template/index.blade.php'), resource_path('views/admin/' . $view_path . '/index.blade.php'));
            $success = File::copy(resource_path('views/admin/crud-template/create.blade.php'), resource_path('views/admin/' . $view_path . '/create.blade.php'));
            $success = File::copy(resource_path('views/admin/crud-template/edit.blade.php'), resource_path('views/admin/' . $view_path . '/edit.blade.php'));
            //Update Index File
            //Generate Table  from columns
            $table = "<table class='table table-bordered table-striped table-vcenter js-dataTable-buttons dataTable no-footer' >
                        <thead>
                            <tr> ";
            foreach (json_decode($columns) as $column) {
                $table .= "<th> $column</th>\n";
            }
            $table .= "<th> Action</th> ";
            $table .= "</tr>
                        </thead>
                        <tbody>
                        @foreach (\$results as \$item)
                            <tr>";

            foreach (json_decode($columns) as $column) {
                $table .= "<td >{{\$item->$column}}</td > ";
            }


            $table .= "<td>
                             <div class='btn-group'>
                                    <button type='button' class='btn btn-sm btn-secondary js-bs-tooltip-enabled'
                                            href='{{ route('$route_path.edit', \$item ) }}' data-bs-toggle='modal'
                                            data-bs-target='#modalEdit{{\$item->id}}'>
                                                <i class='fa fa-pencil-alt'></i>
                                    </button>


                                    <form action='{{ route('$route_path.destroy', \$item ) }}' method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button type='submit' class='btn btn-sm btn-secondary js-bs-tooltip-enabled'
                                                data-toggle='tooltip'>
                                            <i class='fa fa-close'></i>
                                        </button>
                                    </form>
                                </div>
                            </td>";


            $table .= "</tr>\n @include('admin." . $view_path . ".edit')
                        @endforeach
                        </tbody>
                    </table>\n  {{ \$results->appends(request()->query())->links('pagination::bootstrap-4') }}";


            $index_file = File::get(resource_path('views/admin/' . $view_path . '/index.blade.php'));
            $index_file = str_replace("table_data", $table, $index_file);
            $index_file = str_replace("route_link", $route_path, $index_file);
            $index_file = str_replace("crud_title", $model_name, $index_file);

            $index_file = str_replace("create_include", "admin." . $view_path . ".create", $index_file);
            File::put(resource_path('views/admin/' . $view_path . '/index.blade.php'), $index_file);

            //Update Create File
            $crud_create_fields = "";
            $crud_edit_fields = "";
            $column_names = "";
            foreach ($request['column'] as $key => $column) {

                $type = $request['input_type'][$key];
                $required = false;
                if ($type != 'nullable') {
                    $required = true;
                }
                $required_field = '';
                if ($required) {
                    $required_field = '<span class="text-danger">*</span>';
                }
                if ($request['input_type'][$key] == 2) {

                    $crud_create_fields .= ' <label class="form-label" for="' . $column . '">' . $column . $required_field . ' </label>
                            <select class="form-select" id="' . $column . '" name="' . $column . '" required="' . $required . '">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                            </select>';

                    $crud_edit_fields .= ' <label class="form-label" for="' . $column . '">' . $column . $required_field . '</label>
                            <select class="form-select" id="' . $column . '" name="' . $column . '" required="' . $required . '">
                                <option selected="">Select an option</option>
                                                                    <option value="1" @if($item->' . $column . '==1) selected  @endif>Active</option>
                                                                    <option value="0"  @if($item->' . $column . '==0) selected  @endif>Inactive</option>

                                                            </select>';
                } else if ($request['input_type'][$key] == 3) {
                    $crud_create_fields .= '<div class="col-12">
                            <label class="" for="' . $column . '">' . $column . $required_field . '</label>
                            <textarea type="text" class="form-control" id="' . $column . '" name="' . $column . '"
                                   placeholder="' . $column . '" required="' . $required . '"></textarea>
                        </div>';

                    $crud_edit_fields .= '<div class="col-12">
                            <label class="" for="' . $column . '">' . $column . $required_field . '</label>
                            <textarea type="text" class="form-control" id="' . $column . '" name="' . $column . '"
                                   placeholder="' . $column . '" required="' . $required . '">{{$item->' . $column . '}}</textarea>
                        </div>';
                } else {
                    $column_names = $column;
                    $crud_create_fields .= '<div class="col-12">
                          <label class="" for="' . $column . '">' . $column . $required_field . '</label>
                            <input type="text" class="form-control" id="' . $column . '" name="' . $column . '"
                                   placeholder="' . $column . '" required="' . $required . '">
                        </div>';

                    $crud_edit_fields .= '<div class="col-12">
                            <label class="" for="category_title">' . $column . $required_field . '</label>
                            <input type="text" class="form-control" id="' . $column . '" name="' . $column . '"
                                   placeholder="' . $column . '" value="{{$item->' . $column . '}}" required="' . $required . '">
                        </div>';
                }
            }
            $create_file = File::get(resource_path('views/admin/' . $view_path . '/create.blade.php'));
            $create_file = str_replace("crud_route", "{{route('" . $route_path . ".store' )}}", $create_file);
            $create_file = str_replace("crud_title", $model_name . " Create", $create_file);
            $create_file = str_replace("crud_fields", $crud_create_fields, $create_file);
            $create_file = str_replace("modal_id", 'modalEdit{{\$item->id}}', $create_file);
            File::put(resource_path('views/admin/' . $view_path . '/create.blade.php'), $create_file);

            //Crud Update File
            $update_file = File::get(resource_path('views/admin/' . $view_path . '/edit.blade.php'));
            $update_file = str_replace("crud_route", "{{route('" . $route_path . ".update', \$item )}}", $update_file);
            $update_file = str_replace("crud_title", $model_name . " Update", $update_file);
            $update_file = str_replace("modal_id", 'modalEdit{{$item->id}}', $update_file);
            $update_file = str_replace("crud_fields", $crud_edit_fields, $update_file);
            File::put(resource_path('views/admin/' . $view_path . '/edit.blade.php'), $update_file);

            //Update Sidebar
            $sidebar = File::get(resource_path('views/includes/admin/sidebar.blade.php'));
            $sidebar .= "\n<li class='nav-main-item'>
    <a class='nav-main-link' href='/" . $route_path . "'>
        <i class='nav-main-link-icon fa fa-sticky-note'></i>
        <span class='nav-main-link-name'>" . $model_name . "</span>
    </a>
</li>";

            File::put(resource_path('views/includes/admin/sidebar.blade.php'), $sidebar);

            // sleep(5);
            //Update Controller if Exist
            $controller = File::get(app_path('Http/Controllers/' . $model_name . 'Controller.php'));

            sleep(5);
            $done = $this->updateControllerIfExist($controller, $view_path, $model_name, $column_names);

            if ($done == 1) {
                alert()->success('Success', 'Successfully Crud Created');
                return back();
            } else {
                alert()->error('Failed', 'Failed to Create Crud');
                return back();
            }

            /*$controller = File::get(app_path('Http/Controllers/Admin/' . $model_name . 'Controller.php'));
            $controller = str_replace("view_path", $view_path, $controller);
            File::put(app_path('Http/Controllers/Admin/' . $model_name . 'Controller.php'), $controller);*/


        } catch (\Exception $e) {
            alert()->error('Error', $e->getMessage());
            return back();
        }


    }

    public function updateControllerIfExist($controller, $view_path, $model_name, $column_name)
    {
        if (!$controller) {
            try {

                sleep(5);
                $this->updateControllerIfExist($controller, $view_path, $model_name, $column_name);
            } catch (\Exception $exception) {
                //Log::error('Error occurred while checking for PyController: ' . $exception->getMessage());
                // handle error here

                return $exception->getMessage();

                return 0;
            }
        } else {

            $controller = str_replace("view_path", $view_path, $controller);
            $controller = str_replace("column", $column_name, $controller);
            File::put(app_path('Http/Controllers/' . $model_name . 'Controller.php'), $controller);

            return 1;
        }

    }

    public function crudDelete(Request $request)
    {

    }

    public function projectClone(Request $request)
    {
        //Resources copy
        $to_directory = public_path("product_download/resources");
        $from_directory = resource_path();
        File::copyDirectory($from_directory, $to_directory);

        //Routes copy
        $to_directory = public_path("product_download/routes");
        $from_directory = base_path("routes");
        File::copyDirectory($from_directory, $to_directory);

        //Controllers copy
        $to_directory = public_path("product_download/app/Http/Controllers");
        $from_directory = app_path("Http/Controllers");
        File::copyDirectory($from_directory, $to_directory);

        //Models copy
        $to_directory = public_path("product_download/app");
        $from_directory = app_path();
        File::copyDirectory($from_directory, $to_directory);

        //Views copy
        $to_directory = public_path("product_download/resources/views");
        $from_directory = resource_path("views");
        File::copyDirectory($from_directory, $to_directory);

        //Migrations copy
        $to_directory = public_path("product_download/database/migrations");
        $from_directory = database_path("migrations");
        File::copyDirectory($from_directory, $to_directory);

        //Env copy
        $to_directory = public_path("product_download");
        $from_directory = base_path();
        File::copyDirectory($from_directory, $to_directory);

        //Config copy
        $to_directory = public_path("product_download/config");
        $from_directory = config_path();
        File::copyDirectory($from_directory, $to_directory);

        //Public copy
        /*  $to_directory = public_path("product_download/public");
          $from_directory = public_path();
          File::copyDirectory($from_directory, $to_directory);*/

        //Storage copy
        $to_directory = public_path("product_download/storage");
        $from_directory = storage_path();
        File::copyDirectory($from_directory, $to_directory);

        //Vendor copy
        $to_directory = public_path("product_download/vendor");
        $from_directory = base_path("vendor");
        File::copyDirectory($from_directory, $to_directory);


        return "Done";


        //Zip file create
        $zip = new ZipArchive;

        $fileName = 'example.zip';

        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(public_path('product_download'));

            foreach ($files as $key => $value) {
                $file = basename($value);
                $zip->addFile($value, $file);
            }

            $zip->close();
        }

        return response()->download(public_path($fileName));


        return "done";
    }

    public function deleteTable($table)
    {
        try {
            Schema::drop($table);
            Schema::dropIfExists($table);

            return "Table Deleted Successfully";
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }
}
