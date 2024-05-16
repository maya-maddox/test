<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;



class CrowdOxOrderSelection extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'quantity', 'crowd_ox_project_id', 'crowd_ox_order_id', 'crowd_ox_order_line_id', 'crowd_ox_product_id', 'crowd_ox_product_variation_id', 'raw_data'
    ];

    public function crowdOxProject() {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxOrder() {
        return $this->belongsTo(CrowdOxOrder::class);
    }

    public function crowdOxOrderLine() {
        return $this->belongsTo(CrowdOxOrderLine::class);
    }

    public function crowdOxProduct() {
        return $this->belongsTo(CrowdOxProduct::class);
    }

    public function crowdOxProductVariation() {
        return $this->belongsTo(CrowdOxProductVariation::class);
    }
}
