<?php

namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    
    protected $fillable = [
        'id',
        'name',
        'code',
        'country_id',
        'status'
    ];
    
    /**
     * Get country for this state
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    
    /**
     * Get cities for this state
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }
}