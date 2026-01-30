<?php

namespace Modules\CheckPincode\Repositories;

use DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Modules\CheckPincode\Entities\CheckPincode;
use Modules\CheckPincode\Entities\PinCodeConfigurations;
use Modules\CheckPincode\Imports\PincodeImport;

class CheckPincodeRepository
{
    public function getPincodesData($type)
    {

        $userId = auth()->user()->id;
        if($type=='superadmin'){
            return CheckPincode::all();
        }else{
            return CheckPincode::where('user_id',$userId)->get();
        }
    }

    public function store($request)
    {
        CheckPincode::create([
            'user_id' => auth()->user()->id,
            'pincode' => $request['pincode'],
            'city' => $request['city'],
            'state' => $request['state'],
            'delivery_days' => $request['delivery_days']
        ]);
    }

    public function update($request)
    {
        $pincode = CheckPincode::findOrFail($request['id']);
        $pincode->update([
            'user_id' => auth()->user()->id,
            'pincode' => $request['pincode'],
            'city' => $request['city'],
            'state' => $request['state'],
            'delivery_days' => $request['delivery_days']
        ]);
    }

    public function destroy($id)
    {
        $pincode = CheckPincode::findOrFail($id);
        $pincode->delete();
    }

    public function updateCheckpincodeSystemConfig($data)
    {
        $checkPincodeSystem = PinCodeConfigurations::first();
        if($checkPincodeSystem){
            $checkPincodeSystem->pincode_check_system_status = isset($data['pincode_check_system_status']) ? $data['pincode_check_system_status']:0;
            $checkPincodeSystem->delivery_days_status = isset($data['delivery_days_status']) ? $data['delivery_days_status']:0;
            $checkPincodeSystem->save();
        }else{
            PinCodeConfigurations::create([
                "pincode_check_system_status" => isset($data['pincode_check_system_status']) ? $data['pincode_check_system_status']:0,
                "delivery_days_status" => isset($data['pincode_check_system_status']) ? $data['pincode_check_system_status']:0,
            ]);
        }

        return true;
    }

    public function updateCheckpincodeDeliveryConfig($status)
    {
        $checkPincodeSystem = PinCodeConfigurations::findOrFail(1);
        $checkPincodeSystem->delivery_days_status = $status;
        $checkPincodeSystem->save();
        return true;
    }

    public function csvUploadPincode($data)
    {
        Excel::import(new PincodeImport, $data['file']->store('temp'));
    }

    public function checkPincodeAvailablity($request)
    {
        return CheckPincode::where('user_id',$request['seller_id'])->where('pincode',$request['pin_code'])->first();
    }
}
