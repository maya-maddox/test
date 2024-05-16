<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class CrowdOxOrderTransaction extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id',
        'crowd_ox_project_id',
        'crowd_ox_order_id',
        'amount_cents',
        'shipping_amount_cents',
        'currency',
        'confirmed',
        'paid_at',
        'raw_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        "paid_at" => "datetime",
    ];


    public function crowdOxProject() {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxOrders() {
        return $this->belongsToMany(CrowdOxOrder::class);
    }


}
