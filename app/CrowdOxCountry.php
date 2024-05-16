<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class CrowdOxCountry extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'name', 'iso2', 'raw_data'
    ];

    public function crowdOxStates() {
        return $this->hasMany(CrowdOxState::class);
    }

    public function crowdOxOrderAddresses() {
        return $this->hasMany(CrowdOxOrderAddress::class);
    }

    public function crowdOxProjects() {
        return $this->hasMany(crowdOxProject::class);
    }
}
