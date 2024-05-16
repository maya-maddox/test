<?php

namespace App;

use App\Models\CrowdOxOrderTagTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrowdOxOrderTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'name', 'crowd_ox_project_id', 'raw_data', 'odoo_id',
    ];


    public function crowdOxProject()
    {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxOrders()
    {
        return $this->belongsToMany(CrowdOxOrder::class);
    }

    public function tags()
    {
        return $this->hasManyThrough(
            Tag::class,
            CrowdOxOrderTagTag::class,
            'crowd_ox_order_tag_id',
            'id',
            'id',
            'tag_id'
        );
    }
}
