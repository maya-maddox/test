<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrowdOxOrderAddress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "crowd_ox_id",
        "name",
        "address_1",
        "address_2",
        "city",
        "state",
        "postal_code",
        "phone_number",
        "crowd_ox_project_id",
        "crowd_ox_order_id",
        "crowd_ox_country_id",
        "crowd_ox_state_id",
        "raw_data",
        "odoo_id",
    ];

    public function crowdOxProject()
    {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxOrder()
    {
        return $this->belongsTo(CrowdOxOrder::class);
    }

    public function crowdOxCountry()
    {
        return $this->belongsTo(CrowdOxCountry::class)->withDefault();
    }

    public function crowdOxState()
    {
        return $this->belongsTo(CrowdOxState::class);
    }


}
