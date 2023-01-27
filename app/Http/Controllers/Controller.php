<?php

namespace App\Http\Controllers;

use App\Imports\DataImport;
use App\Models\PageView;
use App\Models\PageVisitor;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(Request $request)
    {

        $page_views = PageVisitor::where('ip_address', $request->ip())->first();
        if (is_null($page_views)) {
            try {

                $url = "http://api.ipapi.com/" . $request->ip() . "?access_key=" . getIpAddressApikey();
                //http request
                $response = Http::get($url);
                //$data= json_decode($response->body());

                PageVisitor::create([
                    'ip_address' => $request->ip(),
                    'details' => $response->body(),
                ]);

                PageView::create([
                    'ip_address' => $request->ip(),
                    'details' => $response->body(),
                ]);

            } catch (\Exception $e) {

                //return $e->getMessage();
            }
        } else {
            try {
                PageView::create([
                    'ip_address' => $request->ip(),
                    'details' => $page_views->details,
                ]);
            } catch (\Exception $e) {
                //return $e->getMessage();
            }
        }

        return view("frontend.home.index");
    }

    public function postDetails($id)
    {

        $result = Post::where('id', $id)->first();
        return view("test")->with("result", $result);
    }

    public function mail()
    {

        $data = array(
            'invoice' => uniqid(),
            'full_name' => "Motiur Rahaman",
            'phone_number' => "017178499658",

            'date' => Carbon::now(),
            'url' => \url("/"),
        );
        $admin_email = "memotiur@gmail.com";
        Mail::send('email-template/confirm', $data, function ($message) use ($admin_email) {
            $message->to($admin_email)
                ->subject('Mail from CEO');
            $message->from('motiur@gmail.com', 'Motiur Rahaman would like to be your friend on e-Verify');
        });

        return "mail";
    }

    public function qrCode()
    {
        return QrCode::generate('Make me into a QrCode!');

        return QrCode::generate('Make me into a QrCode!', '../public/images/favicon.png');;
    }

    public function import()
    {
        $rows = Excel::toArray(new DataImport, 'users.xlsx');
        return response()->json(["rows" => $rows]);
    }

    public function crudGenerator()
    {
        $columns = array(
            "name",
            "description",
        );

        $model_name = "Motiur";

        $view_path = strtolower($model_name);
        try {
            Artisan::call('make:model ' . $model_name . ' -mcr');

            if (!File::exists(resource_path('views/' . $view_path . '/index.blade.php'))) {
                File::makeDirectory(resource_path('views/admin/' . $view_path), 0777, true, true);
                File::put(resource_path('views/admin/' . $view_path . '/index.blade.php'), "");
                File::put(resource_path('views/admin/' . $view_path . '/create.blade.php'), "");
                File::put(resource_path('views/admin/' . $view_path . '/edit.blade.php'), "");
            }

            //Update Model
           /* $model_file = File::get(app_path('Models/' . $model_name . '.php'));
            $model_file = str_replace("class " . $model_name . " extends Model", "class " .
                $model_name . " extends Model\n{
            \n\tuse HasFactory;
            \t public \$timestamps=true;
            \t public \$guarded=[];
            \tprotected \$fillable = [\"" . implode("\",\"", $columns) . "\"];
            }", $model_file);
            File::put(app_path('Models/' . $model_name . '.php'), $model_file);*/



            //Create Route
            $routes = File::get(base_path('routes/web.php'));
            $route = "\nRoute::resource('/product-categories', ProductCategoryController::class);";
            $routes .= $route;
            File::put(base_path('routes/web.php'), $routes);





            //$model = str_replace("class " . $model_name . " extends Model", "class " . $model_name . " extends Model\n{\n\tprotected \$fillable = ['name', 'description'];\n}", $model);
            //File::put(app_path('Models/' . $model_name . '.php'), $model);

            //Create Controller
            /* $controller = File::get(app_path('Http/Controllers/Admin/'.$model_name.'Controller.php'));
             $controller = str_replace("class ".$model_name."Controller extends Controller", "class ".$model_name."Controller extends Controller\n{\n\tprotected \$model = ".$model_name."::class;\n}", $controller);
             File::put(app_path('Http/Controllers/Admin/ProductCategoryController.php'), $controller);*/

            //Create Migration
            /*   $migration = File::get(database_path('migrations/2021_03_18_075000_create_product_categories_table.php'));
               $migration = str_replace("class CreateProductCategoriesTable extends Migration", "class CreateProductCategoriesTable extends Migration\n{\n\tpublic function up()\n\t{\n\t\tSchema::create('product_categories', function (Blueprint \$table) {\n\t\t\t\$table->id();\n\t\t\t\$table->string('name');\n\t\t\t\$table->text('description');\n\t\t\t\$table->timestamps();\n\t\t});\n\t}\n\n\tpublic function down()\n\t{\n\t\tSchema::dropIfExists('product_categories');\n\t}\n}", $migration);
               File::put(database_path('migrations/2021_03_18_075000_create_product_categories_table.php'), $migration);*/

            return "success";


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
