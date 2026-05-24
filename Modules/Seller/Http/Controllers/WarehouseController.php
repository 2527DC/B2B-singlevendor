<?php

namespace Modules\Seller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Seller\Entities\SellerWarehouseAddress;
use Modules\Setup\Entities\Country;
use Modules\Setup\Entities\State;
use Modules\Setup\Entities\City;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\UserActivityLog\Traits\LogActivity;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('maintenance_mode');
    }

    public function index()
    {
        try {
            $is_admin = auth()->user()->role->type != 'seller';
            if ($is_admin) {
                // Admin handles all warehouses, load related users to display owners
                $warehouses = SellerWarehouseAddress::with(['country', 'state', 'city'])->get();
            } else {
                // Sellers handle only their own warehouses
                $warehouses = SellerWarehouseAddress::with(['country', 'state', 'city'])
                    ->where('user_id', auth()->id())
                    ->get();
            }
            return view('seller::warehouses.index', compact('warehouses', 'is_admin'));
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function create()
    {
        try {
            $is_admin = auth()->user()->role->type != 'seller';
            $countries = Country::where('status', 1)->orderBy('name')->get();
            $users = [];
            
            if ($is_admin) {
                // Allow admins to assign the warehouse to themselves or a seller
                $users = User::whereHas('role', function($q) {
                    $q->whereIn('type', ['superadmin', 'admin', 'seller']);
                })->orderBy('first_name')->get();
            }

            return view('seller::warehouses.create', compact('countries', 'users', 'is_admin'));
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function store(Request $request)
    {
        $is_admin = auth()->user()->role->type != 'seller';
        
        $validator = Validator::make($request->all(), [
            'warehouse_name' => 'required|string|max:255',
            'warehouse_address' => 'required|string|max:255',
            'warehouse_phone' => 'required|string|max:20',
            'warehouse_country' => 'required|integer',
            'warehouse_state' => 'required|integer',
            'warehouse_city' => 'required|integer',
            'warehouse_postcode' => 'required|string|max:20',
            'user_id' => $is_admin ? 'required|exists:users,id' : 'nullable'
        ]);

        if ($validator->fails()) {
            Toastr::error(__('common.operation_failed'));
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $request->only([
                'warehouse_name',
                'warehouse_address',
                'warehouse_phone',
                'warehouse_country',
                'warehouse_state',
                'warehouse_city',
                'warehouse_postcode'
            ]);

            $data['user_id'] = $is_admin ? $request->user_id : auth()->id();

            SellerWarehouseAddress::create($data);
            DB::commit();

            LogActivity::successLog('New warehouse added successfully.');
            Toastr::success(__('common.added_successfully'), __('common.success'));

            return $is_admin 
                ? redirect()->route('admin.warehouses.index') 
                : redirect()->route('seller.warehouses.index');

        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $is_admin = auth()->user()->role->type != 'seller';
            
            if ($is_admin) {
                $warehouse = SellerWarehouseAddress::findOrFail($id);
            } else {
                $warehouse = SellerWarehouseAddress::where('user_id', auth()->id())->findOrFail($id);
            }

            $countries = Country::where('status', 1)->orderBy('name')->get();
            $states = State::where('country_id', $warehouse->warehouse_country)->get();
            $cities = City::where('state_id', $warehouse->warehouse_state)->get();
            
            $users = [];
            if ($is_admin) {
                $users = User::whereHas('role', function($q) {
                    $q->whereIn('type', ['superadmin', 'admin', 'seller']);
                })->orderBy('first_name')->get();
            }

            return view('seller::warehouses.edit', compact('warehouse', 'countries', 'states', 'cities', 'users', 'is_admin'));
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $is_admin = auth()->user()->role->type != 'seller';
        
        $validator = Validator::make($request->all(), [
            'warehouse_name' => 'required|string|max:255',
            'warehouse_address' => 'required|string|max:255',
            'warehouse_phone' => 'required|string|max:20',
            'warehouse_country' => 'required|integer',
            'warehouse_state' => 'required|integer',
            'warehouse_city' => 'required|integer',
            'warehouse_postcode' => 'required|string|max:20',
            'user_id' => $is_admin ? 'required|exists:users,id' : 'nullable'
        ]);

        if ($validator->fails()) {
            Toastr::error(__('common.operation_failed'));
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            if ($is_admin) {
                $warehouse = SellerWarehouseAddress::findOrFail($id);
            } else {
                $warehouse = SellerWarehouseAddress::where('user_id', auth()->id())->findOrFail($id);
            }

            $data = $request->only([
                'warehouse_name',
                'warehouse_address',
                'warehouse_phone',
                'warehouse_country',
                'warehouse_state',
                'warehouse_city',
                'warehouse_postcode'
            ]);

            if ($is_admin) {
                $data['user_id'] = $request->user_id;
            }

            $warehouse->update($data);
            DB::commit();

            LogActivity::successLog('Warehouse updated successfully.');
            Toastr::success(__('common.updated_successfully'), __('common.success'));

            return $is_admin 
                ? redirect()->route('admin.warehouses.index') 
                : redirect()->route('seller.warehouses.index');

        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $is_admin = auth()->user()->role->type != 'seller';
            
            if ($is_admin) {
                $warehouse = SellerWarehouseAddress::findOrFail($id);
            } else {
                $warehouse = SellerWarehouseAddress::where('user_id', auth()->id())->findOrFail($id);
            }

            $warehouse->delete();
            DB::commit();

            LogActivity::successLog('Warehouse deleted successfully.');
            Toastr::success(__('common.deleted_successfully'), __('common.success'));

            return $is_admin 
                ? redirect()->route('admin.warehouses.index') 
                : redirect()->route('seller.warehouses.index');

        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    public function setDefault($id)
    {
        DB::beginTransaction();
        try {
            $is_admin = auth()->user()->role->type != 'seller';
            
            if ($is_admin) {
                $warehouse = SellerWarehouseAddress::findOrFail($id);
            } else {
                $warehouse = SellerWarehouseAddress::where('user_id', auth()->id())->findOrFail($id);
            }

            // Unset current defaults for this user
            SellerWarehouseAddress::where('user_id', $warehouse->user_id)->update(['is_default' => 0]);
            
            // Set the new default
            $warehouse->is_default = 1;
            $warehouse->save();

            DB::commit();

            LogActivity::successLog('Default warehouse updated successfully.');
            Toastr::success(__('common.updated_successfully'), __('common.success'));

            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }
}
