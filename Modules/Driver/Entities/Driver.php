<?php

namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'email',
        'is_active',
        'address',
        'login_otp',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'login_otp',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'otp_expires_at' => 'datetime',
    ];
}
