<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Seller\Entities\SellerWarehouseAddress;

class Salesman extends Model
{
    protected $table = 'salesmen';

    protected $fillable = [
        'seller_id',
        'salesman_id',
        'name',
        'phone_number',
        'warehouse_id',
    ];

    /**
     * Get the warehouse this salesman belongs to.
     */
    public function warehouse()
    {
        return $this->belongsTo(SellerWarehouseAddress::class, 'warehouse_id');
    }

    /**
     * Auto-generate a unique 6-character alphanumeric salesman_id on creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($salesman) {
            if (empty($salesman->salesman_id)) {
                $salesman->salesman_id = self::generateUniqueSalesmanId();
            }
        });
    }

    /**
     * Generate a unique 6-character alphanumeric ID.
     */
    public static function generateUniqueSalesmanId(): string
    {
        do {
            $id = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        } while (self::where('salesman_id', $id)->exists());

        return $id;
    }

    /**
     * Get the customers mapped to this salesman (decoupled via salesman_id string).
     */
    public function customers()
    {
        return \App\Models\User::where('salesman_id', $this->salesman_id)->get();
    }
}
