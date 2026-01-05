<?php

namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'order_number',
        'customer_id',
        'delivery_type',
        'number_of_item',
        'number_of_package',

        'sub_total',
        'tax_amount',
        'shipping_total',
        'discount_total',
        'grand_total',

        'is_paid',
        'is_completed',
        'is_cancelled',

        'photo_proof',
        'signature_proof',

        'note',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'is_paid'       => 'boolean',
        'is_completed'  => 'boolean',
        'is_cancelled'  => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    /**
     * Relationships
     */

    // Address details (shipping & billing)
    public function addressDetails()
    {
        return $this->hasOne(OrderAddress::class, 'order_id');
    }

    // Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Accessors
     */

    public function getPhotoProofUrlAttribute()
    {
        return $this->photo_proof
            ? asset('storage/' . $this->photo_proof)
            : null;
    }

    public function getSignatureProofUrlAttribute()
    {
        return $this->signature_proof
            ? asset('storage/' . $this->signature_proof)
            : null;
    }
}
