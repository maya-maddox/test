<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnItem extends Model
{
    use HasFactory, SoftDeletes;


    public static function boot() {
        parent::boot();

        static::saving(function ($model) {
            if ($model->sku_id && $model->custom_sku) {
                throw new Exception("Can't have returns sku_id and custom_sku both set! {$model->sku_id} {$model->custom_sku}");
            }
            if (!$model->sku_id && !$model->custom_sku) {
                throw new Exception("Can't have sku_id and custom_sku both null!");
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'returns_id',
        'sku_id',
        'custom_sku',
        'serial_number',
        'outcome',
        'return_item_diagnosis_id',
        'custom_diagnosis',
        'pass',
        'notes'
    ];

    protected $casts = [
        'pass' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'sku_name',
        'diagnosis'
    ];

    public function getSkuNameAttribute()
    {
        return $this->sku ? $this->sku->sku : $this->custom_sku;
    }

    public function getDiagnosisAttribute()
    {
        return $this->return_item_diagnosis_id ? $this->returnItemDiagnosis->diagnosis : $this->custom_diagnosis;
    }

    public function returns()
    {
        return $this->belongsTo(Returns::class);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public function returnItemDiagnosis()
    {
        return $this->belongsTo(ReturnItemDiagnosis::class);
    }
}
