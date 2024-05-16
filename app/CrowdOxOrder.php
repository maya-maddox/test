<?php

namespace App;

use App\Events\CrowdOxOrderCreatedOrUpdated;
use App\Models\BoltOrder;
use App\Models\BoltOrderDispatch;
use App\Models\CrowdOxOrderOrder;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CrowdOxOrder extends Model
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
        'crowd_ox_customer_id',
        'co_created_at',
        'co_invited_at',
        'co_approved_at',
        'co_cancelled_at',
        'co_refused_at',
        'raw_data',
        'co_updated_at',
        'price_cents',
        'status',
        'notes',
        'authentication_token',
        'external_id',
        'odoo_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'co_updated_at' => "datetime",
        'co_created_at' => "datetime",
        'co_invited_at' => "datetime",
        'co_approved_at' => "datetime",
        'co_cancelled_at' => "datetime",
        'co_refused_at' => "datetime",
    ];

    public function crowdOxProject() {
        return $this->belongsTo(CrowdOxProject::class);
    }

    public function crowdOxProjectCustomFields() {
        return $this->belongsToMany(CrowdOxProjectCustomField::class)->withPivot('value');
    }

    public function crowdOxCustomer() {
        return $this->belongsTo(CrowdOxCustomer::class);
    }

    public function crowdOxOrderTags() {
        return $this->belongsToMany(CrowdOxOrderTag::class);
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

    public function crowdOxOrderAddress() {
        return $this->hasOne(CrowdOxOrderAddress::class)->withDefault();
    }

    public function zingtreeWarantyDatabase(){
        return $this->hasMany(WarrantyDatabase::class);
    }

    public function getCrowdOxManageLinkAttribute() {
        return "https://manage.crowdox.com/c/106169/projects/".$this->crowdOxProject->crowd_ox_id."/orders/".$this->crowd_ox_id;
    }
    public function getCrowdOxSurveyLinkAttribute() {
        return "https://survey.crowdox.com/confirm/106169/swytch-?order_id=".$this->crowd_ox_id."&token=".$this->authentication_token;
    }


    //morphable links
    public function invoices() { return $this->morphedByMany(XeroInvoice::class, 'crowd_ox_order_linkable'); }
    public function boltDispatches() { return $this->morphedByMany(BoltOrderDispatch::class, 'crowd_ox_order_linkable'); }
    public function floshipDispatches() { return $this->morphedByMany(FloshipDispatch::class, 'crowd_ox_order_linkable'); }
    public function vdepotDispatches() { return $this->morphedByMany(VdepotOrderDispatch::class, 'crowd_ox_order_linkable'); }
    public function horizonDispatches() { return $this->morphedByMany(DispatchHorizon::class, 'crowd_ox_order_linkable'); }
    public function restOfWorldDispatches() { return $this->morphedByMany(RestOfWorldDispatch::class, 'crowd_ox_order_linkable'); }
    public function tigersDispatches() { return $this->morphedByMany(TigersDispatches::class, 'crowd_ox_order_linkable'); }
    public function wefabDispatches() { return $this->morphedByMany(WefabDispatches::class, 'crowd_ox_order_linkable'); }
    public function zendeskTickets() { return $this->morphedByMany(ZendeskTicket::class, 'crowd_ox_order_linkable'); }

    public function getAllLinkedDispatches() {
        return $this->boltDispatches->merge(
            $this->floshipDispatches)->merge(
            $this->vdepotDispatches)->merge(
            $this->horizonDispatches)->merge(
            $this->restOfWorldDispatches)->merge(
            $this->tigersDispatches)->merge(
            $this->wefabDispatches);
    }

    public function __get($name) {
        if (substr($name, 0, strlen("custom_field.")) === "custom_field.")
        {

            $customField = $this->crowdOxProjectCustomFields->where('name', str_replace("custom_field.", "", $name))->first();
            if ($customField) { return $customField->pivot->value; }
        }
        return parent::__get($name);
    }

    public function getSwytchContainerAttribute() {
        return  SwytchContainer::where('name', $this->{"custom_field.Shipping Container Allocation (Reward)"})->first();
    }

    public function getSwytchContainerExtraKitAttribute() {
        return  SwytchContainer::where('name', $this->{"custom_field.Shipping Container Allocation (Extra Kit)"})->first();
    }

    public function getSwytchProductionBatchAttribute() {
        return  SwytchProductionBatch::where('production_batch', $this->{"custom_field.Production Batch"})->first();
    }

    public function order()
    {
        return $this->hasOneThrough(
            Order::class,
            CrowdOxOrderOrder::class,
            'crowd_ox_order_id',
            'id',
            'id',
            'order_id'
        );
    }
}
