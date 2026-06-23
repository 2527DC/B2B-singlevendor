<?php

namespace Modules\Seller\Entities;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariations;
use Modules\Product\Entities\ProductSku;
use Modules\WholeSale\Entities\WholesalePrice;
use Znck\Eloquent\Traits\BelongsToThrough;

class SellerProductSKU extends Model
{
    use HasFactory, BelongsToThrough ;
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'product_id' => 'integer',
        'product_sku_id' => 'string',
        'product_stock' => 'integer',
        'purchase_price' => 'double',
        'selling_price' => 'double',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $temp_status;
    public $temp_product_stock;

    public function newEloquentBuilder($query)
    {
        return new SellerProductSKUBuilder($query);
    }

    public function getStatusAttribute()
    {
        $warehouse_id = session('active_warehouse_id');
        $query = \DB::table('warehouse_product_stocks')
            ->where('seller_product_sku_id', $this->id);

        if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
            $query->where('warehouse_id', $warehouse_id);
        }

        return $query->where('is_active', 1)->exists() ? 1 : 0;
    }

    public function setStatusAttribute($value)
    {
        $this->temp_status = $value;
        if ($this->exists) {
            $warehouse_id = session('active_warehouse_id');
            $query = \DB::table('warehouse_product_stocks')
                ->where('seller_product_sku_id', $this->id);
            if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                $query->where('warehouse_id', $warehouse_id);
            }
            $query->update(['is_active' => $value]);
        }
    }

    public function getProductStockAttribute()
    {
        $warehouse_id = session('active_warehouse_id');
        $query = \DB::table('warehouse_product_stocks')
            ->where('seller_product_sku_id', $this->id);

        if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
            $query->where('warehouse_id', $warehouse_id);
        }

        return (int)$query->sum('stock');
    }

    public function setProductStockAttribute($value)
    {
        $this->temp_product_stock = $value;
        if ($this->exists) {
            $warehouse_id = session('active_warehouse_id');
            $query = \DB::table('warehouse_product_stocks')
                ->where('seller_product_sku_id', $this->id);
            if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                $query->where('warehouse_id', $warehouse_id);
            }
            $query->update(['stock' => $value]);
        }
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });
        self::updated(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });
        self::deleted(function ($model) {
            Cache::forget('MegaMenu');
            Cache::forget('HeaderSection');
        });

        self::saved(function ($model) {
            $warehouse_id = session('active_warehouse_id');

            // Handle status
            if (isset($model->temp_status)) {
                $statusVal = $model->temp_status;
                unset($model->temp_status);

                $query = \DB::table('warehouse_product_stocks')
                    ->where('seller_product_sku_id', $model->id);
                if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                    $query->where('warehouse_id', $warehouse_id);
                    $exists = $query->exists();
                    if ($exists) {
                        $query->update(['is_active' => $statusVal]);
                    } else {
                        \DB::table('warehouse_product_stocks')->insert([
                            'seller_product_sku_id' => $model->id,
                            'warehouse_id' => $warehouse_id,
                            'is_active' => $statusVal,
                            'stock' => 0
                        ]);
                    }
                } else {
                    $exists = $query->exists();
                    if ($exists) {
                        $query->update(['is_active' => $statusVal]);
                    } else {
                        $warehouses = \DB::table('warehouses')->pluck('id');
                        if ($warehouses->isEmpty()) {
                            \DB::table('warehouse_product_stocks')->insert([
                                'seller_product_sku_id' => $model->id,
                                'warehouse_id' => 1,
                                'is_active' => $statusVal,
                                'stock' => 0
                            ]);
                        } else {
                            foreach ($warehouses as $whId) {
                                \DB::table('warehouse_product_stocks')->insert([
                                    'seller_product_sku_id' => $model->id,
                                    'warehouse_id' => $whId,
                                    'is_active' => $statusVal,
                                    'stock' => 0
                                ]);
                            }
                        }
                    }
                }
            }

            // Handle product_stock
            if (isset($model->temp_product_stock)) {
                $stockVal = $model->temp_product_stock;
                unset($model->temp_product_stock);

                $query = \DB::table('warehouse_product_stocks')
                    ->where('seller_product_sku_id', $model->id);
                if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                    $query->where('warehouse_id', $warehouse_id);
                    $exists = $query->exists();
                    if ($exists) {
                        $query->update(['stock' => $stockVal]);
                    } else {
                        \DB::table('warehouse_product_stocks')->insert([
                            'seller_product_sku_id' => $model->id,
                            'warehouse_id' => $warehouse_id,
                            'is_active' => 1,
                            'stock' => $stockVal
                        ]);
                    }
                } else {
                    $exists = $query->exists();
                    if ($exists) {
                        $query->update(['stock' => $stockVal]);
                    } else {
                        $warehouses = \DB::table('warehouses')->pluck('id');
                        if ($warehouses->isEmpty()) {
                            \DB::table('warehouse_product_stocks')->insert([
                                'seller_product_sku_id' => $model->id,
                                'warehouse_id' => 1,
                                'is_active' => 1,
                                'stock' => $stockVal
                            ]);
                        } else {
                            \DB::table('warehouse_product_stocks')->insert([
                                'seller_product_sku_id' => $model->id,
                                'warehouse_id' => $warehouses->first(),
                                'is_active' => 1,
                                'stock' => $stockVal
                            ]);
                            foreach ($warehouses as $whId) {
                                if ($whId != $warehouses->first()) {
                                    \DB::table('warehouse_product_stocks')->insert([
                                        'seller_product_sku_id' => $model->id,
                                        'warehouse_id' => $whId,
                                        'is_active' => 1,
                                        'stock' => 0
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        });
    }

    protected $guarded = ['id'];
    protected $table = 'seller_product_s_k_us';


    public function product(){
        return $this->belongsTo(SellerProduct::class,'product_id','id');
    }

    public function mainProduct(){
        return $this->belongsToThrough(Product::class, SellerProduct::class,
            null,
            '',
            [SellerProduct::class => 'product_id']
        );
    }

    public function sku(){
        return $this->belongsTo(ProductSku::class,'product_sku_id');
    }

    public function product_variations(){
        return $this->hasMany(ProductVariations::class,'product_sku_id','product_sku_id');
    }

    public function seller(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cartProducts(){
        return $this->hasMany(Cart::class,'product_id', 'id')->where('product_type', 'product');
    }

    public function wholeSalePrices(){
        return $this->hasMany(WholesalePrice::class,'sku_id','id');
    }
    public function products(){
        return $this->belongsTo(SellerProduct::class,'product_id','id');
    }
    public function mainProducts(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function getSellPriceAttribute(){
        if (app('general_setting')->price_with_vat) {
            return $this->attributes['selling_price'] + ($this->product->tax ?? 0);
        }else{
            return $this->attributes['selling_price'];
        }
    }
}

class SellerProductSKUBuilder extends \Illuminate\Database\Eloquent\Builder
{
    protected function isStatusColumn($column)
    {
        if (!is_string($column)) {
            return false;
        }
        $col = strtolower($column);
        return $col === 'status' || str_ends_with($col, '.status');
    }

    protected function isStockColumn($column)
    {
        if (!is_string($column)) {
            return false;
        }
        $col = strtolower($column);
        return $col === 'product_stock' || str_ends_with($col, '.product_stock');
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and')
    {
        if ($column instanceof \Closure) {
            return parent::where($column, $operator, $value, $boolean);
        }

        if (is_array($column)) {
            foreach ($column as $key => $val) {
                if (is_numeric($key) && is_array($val)) {
                    $col = $val[0] ?? null;
                    $op = isset($val[2]) ? $val[1] : '=';
                    $v = isset($val[2]) ? $val[2] : ($val[1] ?? null);
                    $bool = $val[3] ?? 'and';
                    
                    if ($this->isStatusColumn($col)) {
                        $this->applyStatusFilter($op, $v, $bool);
                    } elseif ($this->isStockColumn($col)) {
                        $this->applyStockFilter($op, $v, $bool);
                    } else {
                        parent::where([$val], null, null, $boolean);
                    }
                } else {
                    if ($this->isStatusColumn($key)) {
                        $this->applyStatusFilter('=', $val, $boolean);
                    } elseif ($this->isStockColumn($key)) {
                        $this->applyStockFilter('=', $val, $boolean);
                    } else {
                        parent::where($key, '=', $val, $boolean);
                    }
                }
            }
            return $this;
        }

        if ($this->isStatusColumn($column)) {
            if (func_num_args() === 2) {
                $value = $operator;
                $operator = '=';
            }
            return $this->applyStatusFilter($operator, $value, $boolean);
        }

        if ($this->isStockColumn($column)) {
            if (func_num_args() === 2) {
                $value = $operator;
                $operator = '=';
            }
            return $this->applyStockFilter($operator, $value, $boolean);
        }

        return parent::where($column, $operator, $value, $boolean);
    }

    protected function applyStatusFilter($operator, $value, $boolean)
    {
        $table = $this->model->getTable();
        $warehouse_id = session('active_warehouse_id');
        
        if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
            return $this->whereExists(function ($query) use ($table, $operator, $value, $warehouse_id) {
                $query->select(\DB::raw(1))
                    ->from('warehouse_product_stocks')
                    ->whereRaw("warehouse_product_stocks.seller_product_sku_id = {$table}.id")
                    ->where('warehouse_id', $warehouse_id)
                    ->where('is_active', $operator, $value);
            }, $boolean);
        } else {
            return $this->whereExists(function ($query) use ($table, $operator, $value) {
                $query->select(\DB::raw(1))
                    ->from('warehouse_product_stocks')
                    ->whereRaw("warehouse_product_stocks.seller_product_sku_id = {$table}.id")
                    ->where('is_active', $operator, $value);
            }, $boolean);
        }
    }

    protected function applyStockFilter($operator, $value, $boolean)
    {
        $table = $this->model->getTable();
        $warehouse_id = session('active_warehouse_id');

        if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
            return $this->whereRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id and warehouse_id = ?) {$operator} ?", [$warehouse_id, $value], $boolean);
        } else {
            return $this->whereRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id) {$operator} ?", [$value], $boolean);
        }
    }

    public function whereIn($column, $values, $boolean = 'and', $not = false)
    {
        if ($this->isStatusColumn($column)) {
            $table = $this->model->getTable();
            $warehouse_id = session('active_warehouse_id');
            
            return $this->whereExists(function ($query) use ($table, $values, $warehouse_id, $not) {
                $query->select(\DB::raw(1))
                    ->from('warehouse_product_stocks')
                    ->whereRaw("warehouse_product_stocks.seller_product_sku_id = {$table}.id");
                if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                    $query->where('warehouse_id', $warehouse_id);
                }
                if ($not) {
                    $query->whereNotIn('is_active', $values);
                } else {
                    $query->whereIn('is_active', $values);
                }
            }, $boolean);
        }

        if ($this->isStockColumn($column)) {
            $table = $this->model->getTable();
            $warehouse_id = session('active_warehouse_id');
            $op = $not ? 'NOT IN' : 'IN';
            $placeholders = implode(',', array_fill(0, count($values), '?'));
            
            if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                $bindings = array_merge([$warehouse_id], $values);
                return $this->whereRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id and warehouse_id = ?) {$op} ({$placeholders})", $bindings, $boolean);
            } else {
                return $this->whereRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id) {$op} ({$placeholders})", $values, $boolean);
            }
        }

        return parent::whereIn($column, $values, $boolean, $not);
    }

    public function whereNull($column, $boolean = 'and', $not = false)
    {
        if ($this->isStatusColumn($column)) {
            $table = $this->model->getTable();
            $warehouse_id = session('active_warehouse_id');
            
            return $this->whereExists(function ($query) use ($table, $warehouse_id, $not) {
                $query->select(\DB::raw(1))
                    ->from('warehouse_product_stocks')
                    ->whereRaw("warehouse_product_stocks.seller_product_sku_id = {$table}.id");
                if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                    $query->where('warehouse_id', $warehouse_id);
                }
                if ($not) {
                    $query->whereNotNull('is_active');
                } else {
                    $query->whereNull('is_active');
                }
            }, $boolean, $not);
        }

        if ($this->isStockColumn($column)) {
            $table = $this->model->getTable();
            $warehouse_id = session('active_warehouse_id');
            $op = $not ? 'IS NOT NULL' : 'IS NULL';
            
            if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                return $this->whereRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id and warehouse_id = ?) {$op}", [$warehouse_id], $boolean);
            } else {
                return $this->whereRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id) {$op}", [], $boolean);
            }
        }

        return parent::whereNull($column, $boolean, $not);
    }

    public function orderBy($column, $direction = 'asc')
    {
        if ($this->isStockColumn($column)) {
            $table = $this->model->getTable();
            $warehouse_id = session('active_warehouse_id');
            if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                return $this->orderByRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id and warehouse_id = ?) {$direction}", [$warehouse_id]);
            } else {
                return $this->orderByRaw("(select COALESCE(SUM(stock), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id) {$direction}");
            }
        }

        if ($this->isStatusColumn($column)) {
            $table = $this->model->getTable();
            $warehouse_id = session('active_warehouse_id');
            if ($warehouse_id && $warehouse_id !== 'all' && $warehouse_id !== 'select') {
                return $this->orderByRaw("(select COALESCE(SUM(is_active), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id and warehouse_id = ?) {$direction}", [$warehouse_id]);
            } else {
                return $this->orderByRaw("(select COALESCE(SUM(is_active), 0) from warehouse_product_stocks where seller_product_sku_id = {$table}.id) {$direction}");
            }
        }

        return parent::orderBy($column, $direction);
    }
}
