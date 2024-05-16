<?php

namespace App;

use App\Models\CrowdOxProductProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CrowdOxProduct extends Model
{
    
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'type', 'crowd_ox_project_id', 'name', 'description', 'raw_data'
    ];

    public function crowdOxProject() {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxOrderLines() {
        return $this->hasMany(CrowdOxOrderLine::class);
    }

    public function crowdOxProductVariations() {
        return $this->hasMany(CrowdOxProductVariation::class);
    }

    public function crowdOxOrderSelections() {
        return $this->hasMany(CrowdOxOrderSelection::class);
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            CrowdOxProductProduct::class,
            'crowd_ox_product_id',
            'id',
            'id',
            'product_id'
        );
    }
}
