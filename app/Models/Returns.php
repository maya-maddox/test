<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Returns extends Model
{
    use HasFactory, SoftDeletes;

    public static function boot() {
        parent::boot();

        static::saving(function ($model) {
            $sc_count = Returns::where('service_center_id', $model->serviceCenter->id)->withTrashed()->count();
            if (!$model->internal_return_id) {
                $model->setAttribute('internal_return_id', $model->serviceCenter->code.sprintf('%06d', $sc_count+1));
            }

            if ($model->sku_id && $model->custom_sku) {
                throw new Exception("Can't have returns sku_id and custom_sku both set! {$model->sku_id} {$model->custom_sku}");
            }

            if (!$model->sku_id && !$model->custom_sku) {
                throw new Exception("Can't have sku_id and custom_sku both null!");
            }
        });
    }

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['serviceCenter'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'internal_return_id',
        'service_center_id',
        'supportsync_reference',
        'zendesk_reference',
        'other_reference',
        'recieved_date',
        'sku_id',
        'custom_sku',
        'check_in_user_id',
        'technician_id',
        'tested_date',
        'return_reason',
        'refund_type',
        'customer_aware',
        'all_checks',
        'completed_date',
        'notes'
    ];

    protected $casts = [
        'recieved_date' => 'datetime:Y-m-d H:i:s',
        'tested_date' => 'datetime:Y-m-d H:i:s',
        'completed_date' => 'datetime:Y-m-d H:i:s',
        'customer_aware' => 'boolean',
        'all_checks' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'sku_name',
        'return_reason_formatted', 
        'refund_type_formatted',
        'recieved_date_localized',
        'tested_date_localized',
        'completed_date_localized',
        'recieved_date_localized_formatted',
        'tested_date_localized_formatted',
        'completed_date_localized_formatted',
    ];


    public function getSkuNameAttribute()
    {
        return $this->sku ? $this->sku->sku : $this->custom_sku;
    }

    public function getReturnReasonFormattedAttribute()
    {
        return config('servicecenter.returnslog.return_reasons.'.$this->return_reason, $this->return_reason);
    }

    public function getRefundTypeFormattedAttribute()
    {
        return config('servicecenter.returnslog.refund_types.'.$this->refund_type, $this->refund_type);
    }

    public function getRecievedDateLocalizedAttribute()
    {
        return optional($this->recieved_date)->setTimezone($this->serviceCenter->timezone);
    }
    public function setRecievedDateLocalizedAttribute($value)
    {
        return $this->recieved_date = $value->setTimezone('UTC');
    }
    public function getRecievedDateLocalizedFormattedAttribute()
    {
        return optional($this->recieved_date_localized)->isoFormat('YYYY-MM-DD HH:mm:ss');
    }

    public function getTestedDateLocalizedAttribute()
    {
        return optional($this->tested_date)->setTimezone($this->serviceCenter->timezone);
    }
    public function setTestedDateLocalizedAttribute($value)
    {
        return $this->tested_date = $value->setTimezone('UTC');
    }
    public function getTestedDateLocalizedFormattedAttribute()
    {
        return optional($this->tested_date_localized)->isoFormat('YYYY-MM-DD HH:mm:ss');
    }

    public function getCompletedDateLocalizedAttribute()
    {
        return optional($this->completed_date)->setTimezone($this->serviceCenter->timezone);
    }
    public function setCompletedDateLocalizedAttribute($value)
    {
        return $this->completed_date = $value->setTimezone('UTC');
    }
    public function getCompletedDateLocalizedFormattedAttribute()
    {
        return optional($this->completed_date_localized)->isoFormat('YYYY-MM-DD HH:mm:ss');
    }
    

    public function serviceCenter()
    {
        return $this->belongsTo(ServiceCenter::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function checkInUser()
    {
        return $this->belongsTo(\App\User::class, 'check_in_user_id');
    }

    public function technician()
    {
        return $this->belongsTo(\App\User::class, 'technician_id');
    }

    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class);
    }
}
