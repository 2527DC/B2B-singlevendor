<?php

namespace Modules\ModuleManager\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\UploadTheme;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Modules\ModuleManager\Entities\InfixModuleManager;
use Modules\ModuleManager\Entities\Module;
use Modules\SidebarManager\Entities\Backendmenu;
use Modules\SidebarManager\Entities\BackendmenuUser;
use Modules\UserActivityLog\Traits\LogActivity;
use ZipArchive;

class ModuleManagerController extends Controller
{
    use UploadTheme;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }

    public function ModuleRefresh()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('view:clear');
            Artisan::call('config:clear');
            Toastr::success('Refresh successful', 'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }

    public function ManageAddOns()
    {
        try {
            $module_list = [];
            $is_module_available = Module::all();
            return view('modulemanager::manage_module', compact('is_module_available', 'module_list'));
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage(), trans('common.Failed'));
            return redirect('');
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
        }
    }

    public function uploadModule(Request $request)
    {
        $request->validate([
            'module' => 'required|mimes:zip',
        ]);
    
        try {
            Log::info('Module upload started.');
    
            // Store uploaded zip file
            $path = $request->module->store('updateFile');
            $originalName = $request->module->getClientOriginalName();
            Log::info("Uploaded file stored at: $path, original name: $originalName");
    
            // Open zip file
            $zip = new ZipArchive;
            $res = $zip->open(storage_path('app/' . $path));
    
            if ($res === true) {
                $zip->extractTo(storage_path('app/tempUpdate'));
                $zip->close();
                Log::info('Zip file extracted successfully.');
            } else {
                Log::error('Error! Could not open zip file.');
                abort(500, 'Error! Could not open file.');
            }
    
            // Read module directory
            $src = storage_path('app/tempUpdate');
            $dir = opendir($src);
            $module = '';
            while ($file = readdir($dir)) {
                if ($file != "." && $file != "..") {
                    $module = $file;
                }
            }
            closedir($dir);
            Log::info("Module folder found: $module");
    
            // Read module config JSON
            $dataPath = $src.'/'.$module . '/' . $module . '.json';
            if (!file_exists($dataPath)) {
                Log::error('Config JSON missing: ' . $dataPath);
                $this->cleanup();
                Toastr::error('Config File Missing', trans('common.operation_failed'));
                return redirect()->back();
            }
    
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);
    
            if (!empty($array) && isset($array[$module])) {
                $json = $array[$module];
    
                if (!empty($json['min_system_version']) && app('general_setting')->system_version < $json['min_system_version']) {
                    Log::warning("System version too low. Required: " . $json['min_system_version'] . ", Current: " . app('general_setting')->system_version);
                    $this->cleanup();
                    Toastr::error($json['min_system_version'] . ' or greater system version is required for this version', trans('common.operation_failed'));
                    return redirect()->back();
                }
    
                if (empty($json['min_system_version'])) {
                    Log::warning('Min system version not defined in module config.');
                    $this->cleanup();
                    Toastr::error('This version is not suitable for current system version. Please check update log for minimum required version.', trans('common.operation_failed'));
                    return redirect()->back();
                }
    
            } else {
                Log::error('Module config JSON is empty or invalid.');
                $this->cleanup();
                Toastr::error('Config File Missing', trans('common.operation_failed'));
                return redirect()->back();
            }
    
            // Copy module to Modules folder
            $dst = base_path('/Modules/');
            $this->recurse_copy($src, $dst);
            Log::info("Module $module copied to $dst");
    
            // Run migrations if module is active
            if (isModuleActive($module)) {
                $this->moduleMigration($module);
                Log::info("Migrations executed for module: $module");
            }
    
            // Cleanup temp files
            $this->cleanup();
    
            Toastr::success("Your module successfully uploaded", 'Success');
            Log::info("Module upload completed successfully: $module");
    
            return redirect()->back();
    
        } catch (\Exception $e) {
            Log::error('Module upload failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            Toastr::error('Module upload failed. Check logs for details.', 'Error');
            return redirect()->back();
        }
    }

    public function moduleAddOnsEnable($name)
    {

        try {
            session()->forget('menus');
            $module_tables = [];
            $module_tables_names = [];
            $dataPath = base_path('Modules/' . $name . '/' . $name . '.json');        // // Get the contents of the JSON file
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);

            if (!empty($array)) {
                $json = $array[$name];

                if (!empty($json['min_system_version']) && app('general_setting')->system_version < $json['min_system_version']) {
                    return response()->json([
                       'error' =>  $json['min_system_version'] . ' or greater system version is  required for this version'
                    ]);
                }

                if(empty($json['min_system_version'])){
                    return response()->json([
                       'error' =>  'This version is not suitable for current system version. Please check update log for minimum required version.'
                    ]);
                }

            } else {
                return response()->json([
                   'error' =>  'Config File Missing'
                ]);
            }

            $migrations = $array[$name]['migration'] ?? '';
            $names = $array[$name]['names'];

            $version = $array[$name]['versions'][0] ?? '';
            $url = $array[$name]['url'][0] ?? '';
            $notes = $array[$name]['notes'][0] ?? '';


            DB::beginTransaction();
            $s = InfixModuleManager::where('name', $name)->first();
            if (empty($s)) {
                $s = new InfixModuleManager();
            }
            $s->name = $name;
            $s->notes = $notes;
            $s->version = $version;
            $s->update_url = $url;
            $s->installed_domain = url('/');
            $s->activated_date = date('Y-m-d');
            $s->save();
            DB::commit();


            if (!empty($migrations)) {
                if (count($migrations) != 0) {
                    foreach ($migrations as $value) {
                        $module_tables[] = base_path('Modules/' . $name . '/Database/Migrations/' . $value);
                    }
                }

            }


            foreach ($names as $value) {
                $module_tables_names[] = $value;
            }

            $is_module_available = base_path('Modules/' . $name .'/'."Providers/". $name . 'ServiceProvider.php');

            if (file_exists($is_module_available)) {
                try {

                    $ModuleManage = Module::where('name', $name)->first();


                    if (!isModuleActive($name)) {
                        $ModuleManage->status = 1;
                        $ModuleManage->save();

                        if (!empty($module_tables)) {
                            foreach ($module_tables as $table) {
                                $path = $table;
                                if (file_exists($path)) {
                                    try {

//                                        $command = 'migrate:refresh --path=' . $path;

                                        Artisan::call('migrate',
                                            array(
                                                '--path' => $path,
                                                '--force' => true));


                                    } catch (\Exception $e) {
                                        Log::info($e->getMessage());
                                        $ModuleManage = Module::where('name', $name)->first();
                                        $ModuleManage->status = 0;
                                        $ModuleManage->save();
                                        $data['error'] = $e->getMessage();
                                        return response()->json($data, 200);
                                    }
                                } else {
                                    $ModuleManage = Module::where('name', $name)->first();
                                    $ModuleManage->status = 0;
                                    $ModuleManage->save();
                                    $data['error'] = "Module File is missing, Please contact with administrator";
                                    return response()->json($data, 200);
                                }
                            }
                        }
                        $data['data'] = 'enable';
                        $data['success'] = 'Operation success! Thanks you.';


                        $moduleCheck = \Nwidart\Modules\Facades\Module::find($name);
                        $moduleCheck->enable();


                        return response()->json($data, 200);
                    } else {

                        // if (!empty($migrations)) {
                        //     if (count($migrations) != 0) {
                        //         foreach ($migrations as $value) {
                        //             DB::table('migrations')
                        //                 ->where('migration', pathinfo($value, PATHINFO_FILENAME))->delete();

                        //         }
                        //     }
                        // }


                        if (!empty($module_tables_names)) {
                            foreach ($module_tables_names as $table) {
                                if (Schema::hasTable($table)) {
                                    //remove module tables from database
                                    try {
                                        DB::beginTransaction();
                                        DB::statement('SET FOREIGN_KEY_CHECKS=0');
                                        Schema::dropIfExists($table);
                                        DB::commit();
                                    } catch (\Exception $e) {
                                        Log::info($e->getMessage());
                                        $ModuleManage = Module::where('name', $name)->first();
                                        $ModuleManage->status = 0;
                                        $ModuleManage->save();
                                        DB::rollback();
                                        $data['error'] = $e->getMessage();
                                        return response()->json($data, 200);
                                    }

                                    //remove migration name from migrations database
                                    try {
                                        DB::beginTransaction();
                                        DB::statement('SET FOREIGN_KEY_CHECKS=0');
                                        DB::table('migrations')->where('migration', 'LIKE', '%' . $table . '%')->delete();
                                        DB::commit();
                                    } catch (\Exception $e) {
                                        Log::info($e->getMessage());
                                        DB::rollback();
                                        $data['error'] = $e->getMessage();
                                        return response()->json($data, 200);
                                    }
                                }
                            }
                        }
                        foreach ($module_tables_names as $table) {
                            if (Schema::hasTable($table)) {
                                //remove module tables from database
                                try {
                                    DB::beginTransaction();
                                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                                    Schema::dropIfExists($table);
                                    DB::commit();
                                } catch (\Exception $e) {
                                    Log::info($e->getMessage());
                                    DB::rollback();
                                    $data['error'] = $e->getMessage();
                                    return response()->json($data, 200);
                                }

                                //remove migration name from migrations database
                                try {
                                    DB::beginTransaction();
                                    DB::statement('SET FOREIGN_KEY_CHECKS=0');
                                    DB::table('migrations')->where('migration', 'LIKE', '%' . $table . '%')->delete();
                                    DB::commit();
                                } catch (\Exception $e) {
                                    Log::info($e->getMessage());
                                    DB::rollback();
                                    $data['error'] = $e->getMessage();
                                    return response()->json($data, 200);
                                }
                            }
                        }


                        $ModuleManage = Module::where('name', $name)->first();
                        $ModuleManage->status = 0;
                        $ModuleManage->save();

                        $moduleCheck = \Nwidart\Modules\Facades\Module::find($name);
                        $moduleCheck->disable();

                        $data['data'] = 'disable';
                        $data['Module'] = $ModuleManage;
                    }


                    $data['success'] = 'Operation success! Thanks you.';
                    session()->forget('menus');
                    $backend_menus = Backendmenu::where('module', $name)->pluck('id')->toArray();
                    BackendmenuUser::whereIn('backendmenu_id', $backend_menus)->update([
                        'status' => 1
                    ]);
                    return response()->json($data, 200);
                } catch (\Exception $e) {
                    Log::info($e->getMessage());
                    $data['error'] = $e->getMessage();
                    return response()->json($data, 200);
                }
            } else {
                $data['error'] = 'Operation Failed! Module file missing !';
                return response()->json($data, 200);
            }


        } catch (\Exception $e) {
            Log::info($e->getMessage());
            $ModuleManage = Module::where('name', $name)->first();
            $ModuleManage->status = 0;
            $ModuleManage->save();
            $moduleCheck = \Nwidart\Modules\Facades\Module::find($name);
            if ($moduleCheck) {
                $moduleCheck->disable();
            }
            DB::rollback();
            return response()->json(['error' => $e->getMessage()]);
        }

    }


    public function FreemoduleAddOnsEnable($name)
    {
        try {

            $module_tables = [];
            $module_tables_names = [];
            $dataPath = base_path('Modules/' . $name . '/' . $name . '.json');        // // Get the contents of the JSON file
            $strJsonFileContents = file_get_contents($dataPath);
            $array = json_decode($strJsonFileContents, true);
            $migrations = $array[$name]['migration'] ?? '';
            $names = $array[$name]['names'];


            $version = $array[$name]['versions'][0] ?? '';
            $url = $array[$name]['url'][0] ?? '';
            $notes = $array[$name]['notes'][0] ?? '';


            DB::beginTransaction();
            $s = InfixModuleManager::where('name', $name)->first();
            if (empty($s)) {
                $s = new InfixModuleManager();
            }
            $s->name = $name;
            $s->notes = $notes;
            $s->version = $version;
            $s->update_url = $url;
            $s->installed_domain = url('/');
            $s->activated_date = date('Y-m-d');
            $s->purchase_code = \Str::uuid();
            $s->checksum = \Str::uuid();
            $s->save();
            DB::commit();



            if (!empty($migrations) && count($migrations) != 0) {
                foreach ($migrations as $value) {
                    $module_tables[] = base_path('Modules/' . $name . '/Database/Migrations/' . $value);
                }
            }

            foreach ($names as $value) {
                $module_tables_names[] = $value;
            }

            $is_module_available = base_path('Modules/' . $name . '/Providers/' . $name . 'ServiceProvider.php');

            if (file_exists($is_module_available)) {

                try {

                    if (!empty($module_tables)) {
                        foreach ($module_tables as $table) {
                            $path = $table;
                            if (file_exists($path)) {
                                try {
                                    Artisan::call('migrate',
                                        array(
                                            '--path' => $path,
                                            '--force' => true));


                                } catch (\Exception $e) {
                                    Log::info($e->getMessage());

                                }
                            }
                        }
                    }


                    $moduleCheck = \Nwidart\Modules\Facades\Module::find($name);
                    $moduleCheck->enable();
                    $ModuleManage = Module::where('name', $name)->first();
                    Artisan::call("optimize:clear");

                } catch (\Exception $e) {
                    Log::info($e->getMessage());

                }
            } else {
                Log::info('module not found');
                DB::rollback();
            }


        } catch (\Exception $e) {

            Log::info($e->getMessage());
            DB::rollback();
        }

    }

    public function moduleMigration($module)
    {
        $dataPath = base_path('Modules/' . $module . '/' . $module . '.json');        // // Get the contents of the JSON file
        $strJsonFileContents = file_get_contents($dataPath);
        $array = json_decode($strJsonFileContents, true);
        $migrations = $array[$module]['migration'] ?? '';
        $module_tables = [];

        if (!empty($migrations) && count($migrations) != 0) {
            foreach ($migrations as $value) {
                $module_tables[] = base_path('Modules/' . $module . '/Database/Migrations/' . $value);
            }
        }


        $is_module_available = base_path('Modules/' . $module . '/Providers/' . $module . 'ServiceProvider.php');

        if (file_exists($is_module_available)) {
            try {

                if (!empty($module_tables)) {
                    foreach ($module_tables as $path) {

                        if (file_exists($path)) {
                            try {
                                $test = Artisan::call('migrate',
                                    array(
                                        '--path' => $path,
                                        '--force' => true));
                            } catch (\Exception $e) {
                                Log::info($e->getMessage());
                            }
                        }
                    }
                }

            } catch (\Exception $e) {
                Log::info($e->getMessage());

            }
        }


    }

}
