<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Seller\Entities\SellerProductSKU;
use Modules\Shipping\Entities\ShippingMethod;
use Modules\GiftCard\Entities\GiftCard;
use Carbon\Carbon;

class Cart extends Model
{
    protected $guarded = ['id'];
    use HasFactory;

    protected $casts = ['qty' => 'integer','price' => 'double','total_price' => 'double','is_select' => 'integer'];

    public function product()
    {
        return $this->belongsTo(SellerProductSKU::class,'product_id','id');
    }
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class,'shipping_method_id','id');
    }
    public function giftCard()
    {
        return $this->belongsTo(GiftCard::class,'product_id','id');
    }

    public function scopeTotalCart($query, $type)
    {
        $year = Carbon::now()->year;
        if ($type == "today") {
            return $query->whereBetween('created_at', [Carbon::now()->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get()->count();
        }
        if ($type == "week") {
            return $query->whereBetween('created_at', [Carbon::now()->subDays(7)->format('y-m-d')." 00:00:00", Carbon::now()->format('y-m-d')." 23:59:59"])->get()->count();
        }
        if ($type == "month") {
            $month = Carbon::now()->month;
            $date_1 = Carbon::create($year, $month)->startOfMonth()->format('Y-m-d')." 00:00:00";
            return $query->whereBetween('created_at', [$date_1, Carbon::now()->format('y-m-d')." 23:59:59"])->get()->count();
        }
        if ($type == "year") {
            $date_1 = Carbon::create($year, 1)->startOfMonth()->format('Y-m-d')." 00:00:00";
            return $query->whereBetween('created_at', [$date_1, Carbon::now()->format('y-m-d')." 23:59:59"])->get()->count();
        }

    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(User::class,'user_id', 'id')->withDefault();
    }

    public function getPriceAttribute()
    {
        if ($this->product_type == 'product') {
            $sku = $this->product;
            if (!$sku) {
                return (double)($this->getRawOriginal('price') ?? 0.0);
            }

            $qty = $this->qty;
            $price = 0;

            if (isModuleActive('WholeSale')) {
                if ($sku->wholeSalePrices && $sku->wholeSalePrices->count()) {
                    foreach ($sku->wholeSalePrices as $wholesale_price) {
                        if ($wholesale_price->min_qty <= $qty && $wholesale_price->max_qty >= $qty) {
                            $price = selling_price($wholesale_price->sell_price, @$sku->product->hasDeal ? $sku->product->hasDeal->discount_type : $sku->product->discount_type, @$sku->product->hasDeal ? $sku->product->hasDeal->discount : $sku->product->discount);
                        } elseif ($wholesale_price->max_qty < $qty) {
                            $price = selling_price($wholesale_price->sell_price, @$sku->product->hasDeal ? $sku->product->hasDeal->discount_type : $sku->product->discount_type, @$sku->product->hasDeal ? $sku->product->hasDeal->discount : $sku->product->discount);
                        }
                    }
                }
            }

            if ($price == 0) {
                if ($sku->product && $sku->product->hasDeal) {
                    $price = selling_price(@$sku->sell_price, @$sku->product->hasDeal->discount_type, @$sku->product->hasDeal->discount);
                } else {
                    if ($sku->product && $sku->product->hasDiscount == 'yes') {
                        $price = selling_price(@$sku->sell_price, @$sku->product->discount_type, @$sku->product->discount);
                    } else {
                        $price = @$sku->sell_price;
                    }
                }
            }

            return (double)$price;
        } elseif ($this->product_type == 'gift_card') {
            if ($this->gift_card_type) {
                $addGiftCard = \Modules\GiftCard\Entities\AddGiftCard::find($this->gift_card_sku);
                if ($addGiftCard) {
                    if ($addGiftCard->hasDiscount()) {
                        return (double)selling_price($addGiftCard->gift_selling_price, $addGiftCard->gift_discount_type, $addGiftCard->gift_discount_amount);
                    } else {
                        return (double)$addGiftCard->gift_selling_price;
                    }
                }
                return (double)($this->getRawOriginal('price') ?? 0.0);
            } else {
                $sku = \Modules\GiftCard\Entities\GiftCard::where('id', $this->product_id)->first();
                if ($sku) {
                    if ($sku->hasDiscount()) {
                        return (double)selling_price($sku->sell_price, $sku->discount_type, $sku->discount);
                    } else {
                        return (double)$sku->sell_price;
                    }
                }
                return (double)($this->getRawOriginal('price') ?? 0.0);
            }
        }

        return (double)($this->getRawOriginal('price') ?? 0.0);
    }

    public function getTotalPriceAttribute()
    {
        return (double)($this->price * $this->qty);
    }
}
