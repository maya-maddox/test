<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrowdOxProductVariation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'SKU', 'crowd_ox_project_id', 'crowd_ox_product_id', 'raw_data', 'odoo_id',
    ];


    public function crowdOxProject()
    {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxProduct()
    {
        return $this->belongsTo(CrowdOxProduct::class);
    }

    public function crowdOxOrderSelections()
    {
        return $this->hasMany(CrowdOxOrderSelection::class);
    }


}
