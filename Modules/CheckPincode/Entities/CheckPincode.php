<?php

namespace Modules\CheckPincode\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckPincode extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','pincode','city','state','delivery_days','cash_on_delivery','created_at','updated_at'];
    
    protected static function newFactory()
    {
        return \Modules\CheckPincode\Database\factories\CheckPincodeFactory::new();
    }
}
