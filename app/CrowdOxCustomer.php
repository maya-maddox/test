<?php

namespace App;

use App\Models\CrowdOxCustomerCustomer;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CrowdOxCustomer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crowd_ox_id', 'name', 'email', 'raw_data', 'odoo_id',
    ];

    public function crowdOxProject() {
        return $this->belongsToMany(CrowdOxProject::class);
    }

    public function crowdOxOrders() {
        return $this->hasMany(CrowdOxOrder::class);
    }

    public function zendeskTickets()
    {
        return $this->belongsToMany(ZendeskTicket::class, 'crowd_ox_customer_zendesk_ticket', 'crowd_ox_customer_id', 'zendesk_ticket_id');
    }

    public function customers()
    {
        return $this->hasManyThrough(
            Customer::class,
            CrowdOxCustomerCustomer::class,
            'crowd_ox_customer_id',
            'id',
            'id',
            'customer_id'
        );
    }

}
