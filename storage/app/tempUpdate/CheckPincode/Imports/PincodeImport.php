<?php

namespace Modules\CheckPincode\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\CheckPincode\Entities\CheckPincode;

class PincodeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $userId = auth()->user()->id;
        
        return new CheckPincode([
            'user_id'          => $userId,
            'pincode'          => $row['pincode'],
            'city'             => $row['city'],
            'state'            => $row['state'],
            'delivery_days'    => $row['delivery_days']
        ]);
    }
}
