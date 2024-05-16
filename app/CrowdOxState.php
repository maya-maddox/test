<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class CrowdOxState extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'name', 'crowd_ox_country_id', 'raw_data'
    ];

    public function crowdOxCountry() {
        return $this->belongsTo(CrowdOxCountry::class);
    }

    public function crowdOxOrderAddresses() {
        return $this->hasMany(CrowdOxOrderAddress::class);
    }
}
