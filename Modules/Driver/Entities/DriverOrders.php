<?php

namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DriverOrders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'order_number',
        'driver_id',
        'customer_id',
        'total_amount',
        'payment_type',
        'is_confirmed',
        'order_status',
        'pickup_address',
        'delivery_address',
        'delivery_date',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'is_confirmed' => 'boolean',
        'delivery_date' => 'date',
    ];

    /* ==============================
       Relationships
       ============================== */

    // Driver assigned to order


    // Customer (registered user)
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id');
    }

    // Order packages
    public function packages()
    {
        return $this->hasMany(\App\Models\OrderPackageDetail::class, 'order_id');
    }

    // Order address details
    public function addressDetails()
    {
        return $this->hasOne(\App\Models\OrderAddressDetail::class, 'order_id');
    }

    // Order delivery states (tracking/history)
    public function deliveryStates()
    {
        return $this->hasMany(\App\Models\OrderDeliveryState::class, 'order_id');
    }

    // Order package details (if different from packages() method)
    public function packageDetails()
    {
        return $this->hasOne(\App\Models\OrderPackageDetail::class, 'order_id');
    }

    // Order payments
    public function payment()
    {
        return $this->hasOne(\App\Models\OrderPayment::class, 'order_id');
    }

    // Order product details
    public function productDetails()
    {
        return $this->hasMany(\App\Models\OrderProductDetail::class, 'order_id');
    }

    /* ==============================
       Scopes (Very useful for API)
       ============================== */

    // Only confirmed orders
    public function scopeConfirmed($query)
    {
        return $query->where('is_confirmed', 1);
    }
}