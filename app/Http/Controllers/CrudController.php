<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class CrudController extends Controller
{


    public function crudGenerator()
    {
        $columns = array(
            "user_id",
            "login_time",
        );
        $columns = json_encode($columns);

        $schema = "";
        $count = 0;
        foreach (json_decode($columns) as $column) {
            if ($count == 0) {
                $schema .= $column . ":string";
            } else {
                $schema .= ',' . $column . ":string";
            }
            $count++;
        }

        $model_name = "Attendance";
        $route_path = preg_replace("/[A-Z]/", "-\$0", $model_name);
        $route_path = substr(strtolower($route_path), 1) . "s";
        $view_path = preg_replace("/[A-Z]/", "_\$0", $model_name);
        $view_path = substr(strtolower($view_path), 1);
        $table_name = $view_path . "s";
        $controller_name = '\App\Http\Controllers\\' . $model_name . 'Controller::class';


        try {
            //Artisan::call('make:model ' . $model_name . ' -mcr');//Migration, Model ,Controller
            Artisan::call('make:model ' . $model_name . ' -cr');

            //Create Migration
            $migrations = glob(database_path('migrations/*_create_' . $table_name . '_table.php'));
            if (count($migrations) <= 0) {
                Artisan::call('make:migration:schema create_' . $table_name . '_table --schema=' . $schema);

                Artisan::call('migrate:refresh', ['--seed' => true]);//Need to change
            }


            if (!File::exists(resource_path('views/' . $view_path . '/index.blade.php'))) {
                File::makeDirectory(resource_path('views/admin/' . $view_path), 0777, true, true);
                File::put(resource_path('views/admin/' . $view_path . '/index.blade.php'), "");
                File::put(resource_path('views/admin/' . $view_path . '/create.blade.php'), "");
                File::put(resource_path('views/admin/' . $view_path . '/edit.blade.php'), "");
            }

            //Update Model
            $model_file = File::get(app_path('Models/' . $model_name . '.php'));
            $model_file = str_replace("protected \$fillable = [];", "protected \$fillable = $columns;\n\tprotected \$table = '$table_name';", $model_file);
            File::put(app_path('Models/' . $model_name . '.php'), $model_file);


            //Create Route

            if (!Route::has($route_path . ".index")) {
                $routes = File::get(base_path('routes/web.php'));
                $route = "\nRoute::resource('/$route_path', $controller_name);";
                $routes .= $route;
                File::put(base_path('routes/web.php'), $routes);
            }


            //Update Controller
            /* $controller = File::get(app_path('Http/Controllers/Admin/'.$model_name.'Controller.php'));
             $controller = str_replace("class ".$model_name."Controller extends Controller", "class ".$model_name."Controller extends Controller\n{\n\tprotected \$model = ".$model_name."::class;\n}", $controller);
             File::put(app_path('Http/Controllers/Admin/ProductCategoryController.php'), $controller);*/

            //Update View File

            return "success";


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function crudViewGenerator(Request $request)
    {

        $columns = array(
            "user_id",
            "login_time",
        );
        $columns = json_encode($columns);

        $schema = "";
        $count = 0;
        foreach (json_decode($columns) as $column) {
            if ($count == 0) {
                $schema .= $column . ":string";
            } else {
                $schema .= ',' . $column . ":string";
            }
            $count++;
        }

        $model_name = "Attendance";
        $view_path = preg_replace("/[A-Z]/", "_\$0", $model_name);
        $view_path = substr(strtolower($view_path), 1);
        $route_path = preg_replace("/[A-Z]/", "-\$0", $model_name);
        $route_path = substr(strtolower($route_path), 1) . "s";


        $success = File::copy(resource_path('views/admin/crud-template/index.blade.php'), resource_path('views/admin/' . $view_path . '/index.blade.php'));
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
                        @foreach (\$results as \$row)
                            <tr>";

        foreach (json_decode($columns) as $column) {
            $table .= "<td >{{\$item->$column}}</td > ";
        }
        $table .= "<td>
                                                <a href = \"{{route('$route_path.edit', \$item->id)}}\" class=\"btn btn-sm btn-primary\">Edit</a>
                                                <a href=\"{{route('$route_path.destroy', \$item->id)}}\" class=\"btn btn-sm btn-danger\">Delete</a>
                                            </td>";

        $table .= "</tr>\n
                        @endforeach
                        </tbody>
                    </table>";


        $index_file = File::get(resource_path('views/admin/' . $view_path . '/index.blade.php'));
        $index_file = str_replace("table_data", $table, $index_file);
        File::put(resource_path('views/admin/' . $view_path . '/index.blade.php'), $index_file);


        //Update Sidebar
        //Update Sidebar
        $sidebar = File::get(resource_path('views/includes/admin/sidebar.blade.php'));
        $sidebar .= "\n<li class='nav-main-item'>
    <a class='nav-main-link' href='/" . $route_path . "'>
        <i class='nav-main-link-icon fa fa-pallet'></i>
        <span class='nav-main-link-name'>" . $model_name . "</span>
    </a>
</li>";

        File::put(resource_path('views/includes/admin/sidebar.blade.php'), $sidebar);
        return "success";
    }
}
