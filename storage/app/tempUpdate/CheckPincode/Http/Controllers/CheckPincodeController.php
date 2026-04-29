<?php

namespace Modules\CheckPincode\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CheckPincode\Services\CheckPincodeService;
use Modules\UserActivityLog\Traits\LogActivity;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Modules\CheckPincode\Entities\CheckPincode;
use Modules\CheckPincode\Entities\PinCodeConfigurations;

class CheckPincodeController extends Controller
{
    private $checkPincodeService;

    public function __construct(CheckPincodeService $checkPincodeService)
    {
        $this->middleware('maintenance_mode');
        $this->checkPincodeService = $checkPincodeService;
    }

    public function index()
    {
        return view('checkpincode::index');
    }

    public function getPincodesData()
    {
        $user = auth()->user();

        $checkPincodes = $this->checkPincodeService->getPincodesData($user->role->type);

        $type = $user->role->type;
        return DataTables::of($checkPincodes)
            ->addIndexColumn()
            ->editColumn('pincode', function ($checkPincodes) {
                return $checkPincodes->pincode ?? '';
            })
            ->editColumn('city', function ($checkPincodes) {
                return $checkPincodes->city ?? '';
            })
            ->addColumn('state', function ($checkPincodes) {
                return $checkPincodes->state ?? '';
            })
            ->addColumn('delivery_days', function ($checkPincodes) {
                return getNumberTranslate($checkPincodes->delivery_days ?? 0)." days";
            })
            ->addColumn('created_at', function ($checkPincodes) {
                return getNumberTranslate(date("d-M-Y",strtotime($checkPincodes->created_at)));
            })
            ->addColumn('action', function ($checkPincodes) {
                return view('checkpincode::component._projectPincodeAction', compact('checkPincodes'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('checkpincode::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'delivery_days' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $this->checkPincodeService->store($request->except('_token'));
            DB::commit();
            Toastr::success(__('common.created_successfully'), __('common.success'));
            LogActivity::successLog('Pin Code Created Successfully.');
            return redirect(route('checkpincode.list'));
        }catch(Exception $e){
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('checkpincode::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $checkPincode = CheckPincode::findOrFail($id);
        return view('checkpincode::edit', compact('checkPincode'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request)
    {
        $request->validate([
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
            'delivery_days' => 'required',
        ]);

        DB::beginTransaction();
        try{
            $this->checkPincodeService->update($request->except('_token'));
            DB::commit();
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            LogActivity::successLog('Pin Code updated Successfully.');
            return redirect(route('checkpincode.list'));
        }catch(Exception $e){
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.error'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        try{
            $this->checkPincodeService->destroy($request->id);
            LogActivity::successLog('Pin Code deleted Successfully.');
            return $this->loadTableData();
        }catch(Exception $e){
            LogActivity::errorLog($e->getMessage());
        }
    }

    public function checkPincodeConfig()
    {
        $checkPincodeConfig = PinCodeConfigurations::first();
        return view('checkpincode::pincode_check_config', compact('checkPincodeConfig'));
    }

    public function updateCheckpincodeSystemConfig(Request $request)
    {
        $data = $request->all();
        $update = $this->checkPincodeService->updateCheckpincodeSystemConfig($data);
        if($update){
            Toastr::success("Operation Successful",'Success');
            return back();
        }
        Toastr::error("Something went wrong",'Error');
        return back();
    }

    public function updateCheckpincodeDeliveryConfig(Request $request)
    {
        $status = $request->status;
        $this->checkPincodeService->updateCheckpincodeDeliveryConfig($status);

        return response()->json([
            'success' => true,
        ]);
    }

    public function bulk_pincode_upload_page()
    {
        return view('checkpincode::bulk_upload');
    }

    public function bulk_pincode_store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xls,xlsx|max:2048'
        ]);
        ini_set('max_execution_time', 0);
        DB::beginTransaction();
        try {
            $this->checkPincodeService->csvUploadPincode($request->except("_token"));
            DB::commit();
            Toastr::success(__('common.uploaded_successfully'), __('common.success'));
            LogActivity::successLog('bulk pincode upload successful.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == 23000) {
                Toastr::error(__('common.duplicate_entry_is_exist_in_your_file'));
            } else {
                Toastr::error(__('common.error_message'));
            }
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function checkPincodeAvailablity(Request $request)
    {
        $pinCodeAbailability = $this->checkPincodeService->checkPincodeAvailablity($request->except('_token'));
        $pinConfig = PinCodeConfigurations::first();
        return response()->json([
            'success' => true,
            'data' => $pinCodeAbailability,
            'pinConfig' => $pinConfig
        ]);
    }
}
