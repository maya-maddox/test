<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;



class CrowdOxProject extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'name', 'currency', 'identifier', 'crowd_ox_country_id', 'raw_data'
    ];



    /**
     * Get the crowdox link
     *
     * @return string
     */
    public function getCrowdOxLinkAttribute()
    {
        return "https://manage.crowdox.com/c/".config('crowdox-laravel.company_id')."/projects/".$this->crowd_ox_id."/";
    }

    public function crowdOxCountry() {
        return $this->belongsto(CrowdOxCountry::class);
    }

    public function crowdOxCustomers() {
        return $this->belongsToMany(CrowdOxCustomer::class);
    }

    public function crowdOxOrders() {
        return $this->hasMany(CrowdOxOrder::class);
    }

    public function crowdOxOrderAddresses() {
        return $this->hasMany(CrowdOxOrderAddress::class);
    }

    public function crowdOxOrderTags() {
        return $this->hasMany(CrowdOxOrderTag::class);
    }

    public function crowdOxOrderTransactions() {
        return $this->hasMany(CrowdOxOrderTransaction::class);
    }

    public function crowdOxOrderLines() {
        return $this->hasMany(CrowdOxOrderLine::class);
    }

    public function crowdOxOrderSelections() {
        return $this->hasMany(CrowdOxOrderSelection::class);
    }

    public function crowdOxProducts() {
        return $this->hasMany(CrowdOxProduct::class);
    }

    public function crowdOxProductVariations() {
        return $this->hasMany(CrowdOxProductVariation::class);
    }

    public function crowdOxProjectCustomFields() {
        return $this->hasMany(CrowdOxProjectCustomField::class);
    }

}
