<?php

namespace Modules\Driver\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'email',
        'is_active',
        'login_otp',
        'otp_expires_at',
        'vehicle_number',
        'seller_id',
    ];

    protected $hidden = [
        'password',
        'login_otp',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'otp_expires_at' => 'datetime',
    ];

    public function seller()
    {
        return $this->belongsTo(\App\Models\User::class, 'seller_id');
    }
}
