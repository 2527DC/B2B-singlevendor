<?php
namespace Modules\Driver\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    
    protected $fillable = [
        'id',
        'name',
        'state_id',
        'country_id',
        'status'
    ];
    
    /**
     * Get state for this city
     */
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    
    /**
     * Get country for this city
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}