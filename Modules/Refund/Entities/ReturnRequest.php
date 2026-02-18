<?php

namespace Modules\Refund\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReturnRequest extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }

    public function package()
    {
        return $this->belongsTo(\App\Models\OrderPackageDetail::class, 'package_id');
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
    }

    public function seller()
    {
        return $this->belongsTo(\App\Models\User::class, 'seller_id');
    }

    public function driver()
    {
        return $this->belongsTo(\Modules\Driver\Entities\Driver::class, 'driver_id');
    }
}
