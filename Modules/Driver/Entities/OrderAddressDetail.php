<?php

namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderAddressDetail extends Model
{
    protected $table = 'order_address_details';

    protected $fillable = [
        'order_id',
        'customer_id',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_country_id',
        'shipping_state_id',
        'shipping_city_id',
        'shipping_postcode',
        'bill_to_same_address',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_address',
        'billing_country_id',
        'billing_state_id',
        'billing_city_id',
        'billing_postcode',
    ];

    protected $casts = [
        'bill_to_same_address' => 'boolean',
    ];

    // Relationship to Order
    public function order()
    {
        return $this->belongsTo(\Modules\Driver\Entities\DriverOrders::class, 'order_id');
    }

    // Billing Country relationship
    public function billingCountry()
    {
        return $this->belongsTo(Country::class, 'billing_country_id');
    }

    // Billing State relationship
    public function billingState()
    {
        return $this->belongsTo(State::class, 'billing_state_id');
    }

    // Billing City relationship
    public function billingCity()
    {
        return $this->belongsTo(City::class, 'billing_city_id');
    }

    // Shipping Country relationship
    public function shippingCountry()
    {
        return $this->belongsTo(Country::class, 'shipping_country_id');
    }

    // Shipping State relationship
    public function shippingState()
    {
        return $this->belongsTo(State::class, 'shipping_state_id');
    }

    // Shipping City relationship
    public function shippingCity()
    {
        return $this->belongsTo(City::class, 'shipping_city_id');
    }
}