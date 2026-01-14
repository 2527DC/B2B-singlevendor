<?php

namespace Modules\CheckPincode\Services;

use Modules\CheckPincode\Repositories\CheckPincodeRepository;

class CheckPincodeService{

    protected $checkPincodeRepository;


    public function __construct(CheckPincodeRepository  $checkPincodeRepository)
    {
        $this->checkPincodeRepository = $checkPincodeRepository;
    }

    public function getPincodesData($type){
        return $this->checkPincodeRepository->getPincodesData($type);
    }

    public function store($request)
    {
        return $this->checkPincodeRepository->store($request);
    }

    public function update($request)
    {
        return $this->checkPincodeRepository->update($request);
    }

    public function destroy($id){
        return $this->checkPincodeRepository->destroy($id);
    }

    public function updateCheckpincodeSystemConfig($data)
    {
        return $this->checkPincodeRepository->updateCheckpincodeSystemConfig($data);
    }

    public function updateCheckpincodeDeliveryConfig($status)
    {
        return $this->checkPincodeRepository->updateCheckpincodeDeliveryConfig($status);
    }

    public function csvUploadPincode($data)
    {
        return $this->checkPincodeRepository->csvUploadPincode($data);
    }

    public function checkPincodeAvailablity($request)
    {
        return $this->checkPincodeRepository->checkPincodeAvailablity($request);
    }
}
