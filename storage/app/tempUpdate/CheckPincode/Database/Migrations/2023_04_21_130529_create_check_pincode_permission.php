<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Modules\RolePermission\Entities\Permission;
use Modules\SidebarManager\Entities\Backendmenu;

class CreateCheckPincodePermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        {
            $permission = [
                ['id' => 751, 'module_id' => 54, 'parent_id' => null, 'module'=>'CheckPincode', 'name' => 'Check Pincode', 'route' => 'checkpincode.list', 'type' => 1],
                ['id' => 752, 'module_id' => 54, 'parent_id' => 751, 'module'=>'CheckPincode', 'name' => 'Pin Code List', 'route' => 'checkpincode.list', 'type' => 2],
                ['id' => 753, 'module_id' => 54, 'parent_id' => 751, 'module'=>'CheckPincode', 'name' => 'Add New Pincode', 'route' => 'checkpincode.create', 'type' => 2],
                ['id' => 754, 'module_id' => 54, 'parent_id' => 751, 'module'=>'CheckPincode', 'name' => 'Bulk Pincode Upload', 'route' => 'checkpincode.bulk_pincode_upload_page', 'type' => 2],
                ['id' => 755, 'module_id' => 54, 'parent_id' => 751, 'module'=>'CheckPincode', 'name' => 'Pincode Configuration', 'route' => 'checkpincode.system.config', 'type' => 2]
            ];
            try{
                DB::table('permissions')->insert($permission);

                if(Schema::hasTable('backendmenus')){
                    $sql = [
                        ['parent_id' => 53, 'is_admin' => 1,'is_seller' => 1, 'icon' =>'ti-settings', 'module'=>'CheckPincode','name' => 'checkpincode.check_pincode', 'route' => 'checkpincode.list', 'position' => 1, 'children'=>[
                            ['is_admin' => 1,'is_seller' => 1, 'icon' =>null, 'module'=>'CheckPincode','name' => 'checkpincode.pincode_list', 'route' => 'checkpincode.list', 'position' => 1],//Submenu
                            ['is_admin' => 1,'is_seller' => 1, 'icon' =>null, 'module'=>'CheckPincode','name' => 'checkpincode.add_new_pincode', 'route' => 'checkpincode.create', 'position' => 2],//Submenu
                            ['is_admin' => 1,'is_seller' => 1, 'icon' =>null, 'module'=>'CheckPincode','name' => 'checkpincode.bulk_upload', 'route' => 'checkpincode.bulk_pincode_upload_page', 'position' => 3],//Submenu
                            ['is_admin' => 1,'is_seller' => 0, 'icon' =>null, 'module'=>'CheckPincode','name' => 'checkpincode.pincode_config', 'route' => 'checkpincode.system.config', 'position' => 4],//Submenu
                        ]],
                    ]; 
                    foreach($sql as $menu){
                        $children = null;
                        if(array_key_exists('children',$menu)){
                            $children = $menu['children'];
                            unset( $menu['children']);
                        }
                        $parent = Backendmenu::create($menu);
                        if($children){
                            foreach($children as $menu){
                                $sub_children = null;
                                if(array_key_exists('children',$menu)){
                                    $sub_children = $menu['children'];
                                    unset( $menu['children']);
                                }
                                $menu['parent_id'] = $parent->id;
                                $parent_children = Backendmenu::create($menu);
                                if($sub_children){
                                    foreach($sub_children as $menu){
                                        $subsubmenu['parent_id'] = $parent_children->id;
                                        Backendmenu::create($subsubmenu);
                                    }
                                }
                            }
                        }
                    }
                }
            }catch(Exception $e){
            }            
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Permission::destroy([751,752,753,754,755]);
        Backendmenu::destroy([243,244,245,246,247]);
    }
}
