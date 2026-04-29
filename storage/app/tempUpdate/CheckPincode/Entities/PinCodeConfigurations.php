<?php

namespace Modules\CheckPincode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PinCodeConfigurations extends Model
{
    use HasFactory;

    protected $fillable = ['pincode_check_system_status','delivery_days_status'];
    
    protected static function newFactory()
    {
        return \Modules\CheckPincode\Database\factories\PinCodeConfigurationsFactory::new();
    }
}
