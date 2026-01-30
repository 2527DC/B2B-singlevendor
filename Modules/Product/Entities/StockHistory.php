<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StockHistory extends Model
{
    protected $guarded = ['id'];
    
    protected $table = 'stock_histories';
    
    protected $casts = [
        'id' => 'integer',
        'product_sku_id' => 'integer',
        'quantity' => 'integer',
        'previous_stock' => 'integer',
        'new_stock' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product SKU that owns the stock history.
     */
    public function productSku()
    {
        return $this->belongsTo(ProductSku::class, 'product_sku_id');
    }

    /**
     * Get the user who made the stock change.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope to filter by type (in/out)
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
