<?php

namespace App;


use Illuminate\Database\Eloquent\Factories\HasFactory;
class CrowdOxProjectCustomField extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'name', 'key', 'type', 'crowd_ox_project_id', 'raw_data'
    ];


    public function crowdOxProject() {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxOrders() {
        return $this->belongsToMany(CrowdOxOrder::class)->withPivot('value');
    }

}
