<?php
namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = [
        'id',
        'name',
        'code',
        'phonecode',
        'currency',
        'currency_symbol',
        'status'
    ];
    
    /**
     * Get states for this country
     */
    public function states()
    {
        return $this->hasMany(State::class, 'country_id');
    }
}